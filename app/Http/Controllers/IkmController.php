<?php

namespace App\Http\Controllers;

use App\Models\IkmResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IkmController extends Controller
{
    /** 9 unsur pelayanan (Permenpan RB No. 14 Tahun 2017). */
    private const UNSUR = [
        1 => 'Persyaratan',
        2 => 'Sistem, Mekanisme, dan Prosedur',
        3 => 'Waktu Penyelesaian',
        4 => 'Biaya/Tarif',
        5 => 'Produk Spesifikasi Jenis Pelayanan',
        6 => 'Kompetensi Pelaksana',
        7 => 'Perilaku Pelaksana',
        8 => 'Penanganan Pengaduan, Saran dan Masukan',
        9 => 'Sarana dan Prasarana',
    ];

    /**
     * Kolom di tabel ikm_responses untuk tiap unsur.
     * Unsur 1 dan 2 punya dua pernyataan, nilainya dirata-rata dulu.
     */
    private const UNSUR_KOLOM = [
        1 => ['u1_a', 'u1_b'],
        2 => ['u2_a', 'u2_b'],
        3 => ['u3'],
        4 => ['u4'],
        5 => ['u5'],
        6 => ['u6'],
        7 => ['u7'],
        8 => ['u8'],
        9 => ['u9'],
    ];

    // =========================================================================
    // 1. BAGIAN PUBLIK (Untuk Halaman Depan / Masyarakat)
    // =========================================================================

    public function index(Request $request)
    {
        if ($request->boolean('ulang')) {
            session()->forget('ikm_sukses');
        }

        [$tahun, $daftar_tahun, $jumlah, $nrr, $ikm] = $this->hitungStatistik($request);

        return view('galery.ikm.index', [
            'tahun' => $tahun,
            'daftar_tahun' => $daftar_tahun,
            'unsur' => self::UNSUR,
            'jumlah' => $jumlah,
            'nrr' => $nrr,
            'ikm' => $ikm,
            'mutu' => $this->mutu($ikm),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return redirect()->route('ikm.index')
                ->withFragment('survei')
                ->with('ikm_sukses', 'Terima kasih, survei Anda telah terkirim.');
        }

        $rules = [
            'tanggal_layanan' => ['required', 'date', 'before_or_equal:today'],
            'pendidikan' => ['required', Rule::in(IkmResponse::PENDIDIKAN)],
            'usia' => ['required', 'integer', 'between:18,100'],
            'pekerjaan' => ['required', Rule::in(IkmResponse::PEKERJAAN)],
            'disabilitas' => ['nullable', 'boolean'],
            'kritik_saran' => ['required', 'string', 'max:1000'],
            'kepercayaan_pusat' => ['required', 'integer', 'between:1,10'],
            'kepercayaan_daerah' => ['required', 'integer', 'between:1,10'],
        ];

        $messages = [
            'usia.between' => 'Usia responden minimal 18 tahun (antara 18 hingga 100 tahun).',
            'usia.min' => 'Usia responden minimal 18 tahun.',
        ];

        foreach (IkmResponse::kolomPenilaian() as $field) {
            $rules[$field] = ['required', 'integer', Rule::in(array_keys(IkmResponse::SKALA))];
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('ikm.index')
                ->withFragment('survei')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['disabilitas'] = $request->boolean('disabilitas');
        $data['ip_address'] = $request->ip();

        IkmResponse::create($data);

        return redirect()->route('ikm.index')
            ->withFragment('survei')
            ->with('ikm_sukses', 'Terima kasih, survei Anda berhasil dikirim.');
    }

    // =========================================================================
    // 2. BAGIAN INTERNAL (Untuk Dashboard Operator / Admin)
    // =========================================================================

    public function indexInternal(Request $request)
    {
        [$tahun, $daftar_tahun, $jumlah, $nrr, $ikm] = $this->hitungStatistik($request);

        $cari = trim((string) $request->query('q', ''));
        $pekerjaan = $request->query('pekerjaan', '');

        $responden = IkmResponse::query()
            ->whereYear('tanggal_layanan', $tahun)
            ->when($cari !== '', function ($q) use ($cari) {
                $q->where(function ($sub) use ($cari) {
                    $sub->where('kritik_saran', 'like', "%{$cari}%")
                        ->orWhere('pekerjaan', 'like', "%{$cari}%")
                        ->orWhere('pendidikan', 'like', "%{$cari}%");
                });
            })
            ->when($pekerjaan !== '', fn ($q) => $q->where('pekerjaan', $pekerjaan))
            ->orderByDesc('tanggal_layanan')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('internal.operator.kelola_ikm', [
            'tahun' => $tahun,
            'daftar_tahun' => $daftar_tahun,
            'unsur' => self::UNSUR,
            'jumlah' => $jumlah,
            'nrr' => $nrr,
            'ikm' => $ikm,
            'mutu' => $this->mutu($ikm),
            'responden' => $responden,
            'cari' => $cari,
            'pekerjaan' => $pekerjaan,
        ]);
    }

    public function destroy($id)
    {
        $responden = IkmResponse::findOrFail($id);
        $responden->delete();

        return redirect()->back()->with('success', 'Data survei dan saran responden berhasil dihapus!');
    }

    // =========================================================================
    // 3. HELPER PERHITUNGAN IKM
    // =========================================================================

    private function hitungStatistik(Request $request): array
    {
        $daftar_tahun = IkmResponse::query()
            ->selectRaw('YEAR(tanggal_layanan) AS th')
            ->distinct()
            ->pluck('th')
            ->push((int) date('Y'))
            ->map(fn ($t) => (int) $t)
            ->unique()
            ->sortDesc()
            ->values()
            ->all();

        $tahun = (int) $request->query('tahun', date('Y'));
        if (! in_array($tahun, $daftar_tahun, true)) {
            $tahun = (int) date('Y');
        }

        $kolom = collect(self::UNSUR_KOLOM)
            ->map(fn ($cols, $i) => 'AVG(('.implode(' + ', $cols).') / '.count($cols).") AS n{$i}")
            ->implode(', ');

        $hasil = IkmResponse::query()
            ->whereYear('tanggal_layanan', $tahun)
            ->selectRaw("COUNT(*) AS jumlah, {$kolom}")
            ->first();

        $jumlah = (int) ($hasil->jumlah ?? 0);

        $nrr = [];
        $ikm = 0.0;

        if ($jumlah > 0) {
            $total = 0.0;
            foreach (array_keys(self::UNSUR) as $i) {
                $rata = (float) $hasil->{"n{$i}"};
                $nrr[$i] = round($rata, 2);
                $total += $rata;
            }
            $ikm = round(($total / count(self::UNSUR)) * 25, 2);
        }

        return [$tahun, $daftar_tahun, $jumlah, $nrr, $ikm];
    }

    private function mutu(float $ikm): array
    {
        return match (true) {
            $ikm >= 88.31 => ['kode' => 'A', 'nama' => 'Sangat baik'],
            $ikm >= 76.61 => ['kode' => 'B', 'nama' => 'Baik'],
            $ikm >= 65.00 => ['kode' => 'C', 'nama' => 'Kurang baik'],
            default => ['kode' => 'D', 'nama' => 'Tidak baik'],
        };
    }
}

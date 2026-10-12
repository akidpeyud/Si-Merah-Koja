<?php

namespace App\Http\Controllers;

use App\Models\IkmResponden;
use Illuminate\Http\Request;

class IkmController extends Controller
{
    /** Halaman publik IKM: hasil survei + formulir survei */
    public function index(Request $request)
    {
        $daftar_tahun = IkmResponden::selectRaw('YEAR(created_at) as tahun')
            ->distinct()->orderByDesc('tahun')->pluck('tahun')->map(fn ($t) => (int) $t)->all();

        $tahun = (int) ($request->query('tahun') ?: ($daftar_tahun[0] ?? now()->year));

        $kolom = array_map(fn ($i) => "u{$i}", range(1, 9));
        $select = 'COUNT(*) as jumlah, ' . implode(', ', array_map(fn ($k) => "AVG({$k}) as {$k}", $kolom));
        $agg = IkmResponden::whereYear('created_at', $tahun)->selectRaw($select)->first();

        $jumlah = (int) ($agg->jumlah ?? 0);
        $nrr = [];
        $ikm = null;
        $mutu = null;

        if ($jumlah > 0) {
            foreach (range(1, 9) as $i) {
                $nrr[$i] = round((float) $agg->{"u{$i}"}, 2);
            }
            // IKM = jumlah (NRR x bobot 1/9) x 25  -> skala 25 - 100
            $ikm = round((array_sum($nrr) / 9) * 25, 2);
            $mutu = $this->mutu($ikm);
        }

        return view('galery.ikm.index', [
            'unsur'        => IkmResponden::UNSUR,
            'jenis_layanan' => IkmResponden::JENIS_LAYANAN,
            'jumlah'       => $jumlah,
            'nrr'          => $nrr,
            'ikm'          => $ikm,
            'mutu'         => $mutu,
            'tahun'        => $tahun,
            'daftar_tahun' => $daftar_tahun,
        ]);
    }

    /** Simpan jawaban survei */
    public function store(Request $request)
    {
        // Honeypot anti-spam: bot biasanya mengisi kolom ini
        if ($request->filled('website')) {
            return redirect()->route('ikm.index');
        }

        $aturan = [
            'nama'          => ['nullable', 'string', 'max:100'],
            'jenis_layanan' => ['required', 'string', 'max:100'],
            'saran'         => ['nullable', 'string', 'max:1000'],
        ];
        foreach (range(1, 9) as $i) {
            $aturan["u{$i}"] = ['required', 'integer', 'between:1,4'];
        }

        $data = $request->validate($aturan, [
            'required' => 'Mohon lengkapi semua penilaian.',
        ]);

        IkmResponden::create($data);

        return redirect(route('ikm.index') . '#hasil')
            ->with('success', 'Terima kasih! Penilaian Anda sudah kami terima.');
    }

    /** Konversi nilai IKM ke mutu pelayanan */
    private function mutu(float $ikm): array
    {
        if ($ikm >= 88.31) return ['kode' => 'A', 'nama' => 'Sangat baik'];
        if ($ikm >= 76.61) return ['kode' => 'B', 'nama' => 'Baik'];
        if ($ikm >= 65.00) return ['kode' => 'C', 'nama' => 'Kurang baik'];
        return ['kode' => 'D', 'nama' => 'Tidak baik'];
    }
}
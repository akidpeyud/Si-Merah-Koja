<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SapraHomeController extends Controller
{
    private $petaPos = null;

    // Kolom nama di tabel pos_pemadam (dicari otomatis)
    private function kolomNamaPos(): string
    {
        $kolom = Schema::getColumnListing('pos_pemadam');

        return collect($kolom)->first(fn ($c) => str_contains($c, 'nama')) ?? 'id_pos';
    }

    // Peta id_pos => nama pos
    private function petaPos(): array
    {
        if ($this->petaPos !== null) {
            return $this->petaPos;
        }
        if (! Schema::hasTable('pos_pemadam')) {
            return $this->petaPos = [];
        }

        return $this->petaPos = DB::table('pos_pemadam')
            ->pluck($this->kolomNamaPos(), 'id_pos')->all();
    }

    // Info pos: nama pos => [alamat, kode_map]  (urutan sesuai id_pos)
    private function infoPos(): array
    {
        if (! Schema::hasTable('pos_pemadam')) {
            return [];
        }
        $namaKol = $this->kolomNamaPos();
        $adaAlamat = Schema::hasColumn('pos_pemadam', 'alamat');
        $adaMap = Schema::hasColumn('pos_pemadam', 'kode_map');

        $info = [];
        foreach (DB::table('pos_pemadam')->orderBy('id_pos')->get() as $p) {
            $p = (array) $p;
            $info[(string) ($p[$namaKol] ?? '')] = [
                'alamat' => $adaAlamat ? ($p['alamat'] ?? null) : null,
                'kode_map' => $adaMap ? ($p['kode_map'] ?? null) : null,
            ];
        }

        return $info;
    }

    // Ambil isi tabel; kalau tabel belum ada, kembalikan koleksi kosong (tidak error)
    private function ambil(string $tabel, ?string $urut = null)
    {
        if (! Schema::hasTable($tabel)) {
            return collect();
        }
        $q = DB::table($tabel);
        if ($urut && Schema::hasColumn($tabel, $urut)) {
            $q->orderBy($urut, 'asc');
        }
        $peta = $this->petaPos();

        return $q->get()->map(function ($r) use ($peta) {
            // Kalau tabel punya id_pos, tambahkan kolom "pos" berisi nama pos-nya
            if (property_exists($r, 'id_pos')) {
                $r->pos = $peta[$r->id_pos] ?? '-';
            }
            // Buang semua kolom STNK dari data publik
            foreach (array_keys((array) $r) as $k) {
                if (stripos($k, 'stnk') !== false) {
                    unset($r->$k);
                }
            }

            return $r;
        });
    }

    // /sarpras/sarana
    public function sarana()
    {
        $tabs = [
            'pemadam' => [
                'label' => 'Sarana Pemadam',
                'ico' => 'fa-fire-extinguisher',
                'data' => $this->ambil('sarana_kebakaran', 'id_sarana'),
            ],
            'penyelamatan' => [
                'label' => 'Sarana Penyelamatan',
                'ico' => 'fa-life-ring',
                'data' => $this->ambil('sarana_penyelamatan'),
            ],
            'pemeriksaan' => [
                'label' => 'Sarana Pemeriksaan',
                'ico' => 'fa-magnifying-glass',
                'data' => $this->ambil('sarana_pemeriksaan'),
            ],
        ];

        // Buang kolom 'jumlah' untuk tampilan publik pada semua sarana (cukup internal saja)
        foreach ($tabs as $key => $tab) {
            $tabs[$key]['data'] = $tab['data']->map(function ($r) {
                unset($r->jumlah);

                return $r;
            });
        }

        $infoPos = $this->infoPos();

        return view('sapra_home.sarana', compact('tabs', 'infoPos'));
    }

    // /sarpras/prasarana
    public function prasarana()
    {
        $sumberAir = Schema::hasTable('prasaranas')
            ? DB::table('prasaranas')
                ->whereIn('kategori', ['Hidrant Pilar', 'Hidrant Gedung', 'Embung', 'Danau'])
                ->orderBy('kategori')->orderBy('no_urut')->get()
            : collect();

        $tabs = [
            'pemadam' => [
                'label' => 'Prasarana Pemadam',
                'ico' => 'fa-building',
                'data' => $this->ambil('prasarana', 'id_prasarana'),
            ],
            'sumber-air' => [
                'label' => 'Sumber Air',
                'ico' => 'fa-droplet',
                'data' => $sumberAir,
            ],
            'hidrant' => [
                'label' => 'Data Hidrant Kota',
                'ico' => 'fa-map-location-dot',
                'data' => $this->ambil('hidran_kota', 'id'),
            ],
        ];

        $infoPos = $this->infoPos();

        return view('sapra_home.prasarana', compact('tabs', 'infoPos'));
    }
}

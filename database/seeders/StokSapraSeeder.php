<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StokSapra;

class StokSapraSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['jenis_barang' => 'Apar 12 kg', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Apar 12 kg (Baru)', 'jumlah' => 4, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Apar 6 kg', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Baju Rescue UK L', 'jumlah' => 4, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Baju Rescue UK M', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Baju Rescue UK XXL', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Baju Sefty Tawon', 'jumlah' => 7, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Baju Tahan Api ', 'jumlah' => 2, 'kondisi' => 'Rusak', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Baju Tahan Panas Biru Uk L', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Lambang Kebalik 2'],
            ['jenis_barang' => 'Baju Tahan Panas Biru Uk XlL ', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Baju Tahan Panas Merah ', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Baju Tahan Panas Oren ', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Body Harness', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Bracket Hanger APAR', 'jumlah' => 13, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Celana tahan panas', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Cuma ada celana & Bekas'],
            ['jenis_barang' => 'Double Pulley', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Filter Masker / Catridge', 'jumlah' => 87, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Filter Masker Biru', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Fire Blanket', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Helm Panjat Tebing ', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Helm Pemadam ', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Jumar', 'jumlah' => 6, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Kaca Mata Rescue', 'jumlah' => 20, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Kampas Rem ', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Karabiner', 'jumlah' => 10, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Kepala Nozel Jet 1 1/2', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Kepala Nozel Spray 1 1/2', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Kunci Hidrant ', 'jumlah' => 7, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Kunci Tekiro 1 Set', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Lampu LED Sorot', 'jumlah' => 8, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Lampur Mobil', 'jumlah' => 4, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Macino 1 1/2 Kuning', 'jumlah' => 18, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Macino 1 1/2 Kuning Jantan', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Tidak Komplit'],
            ['jenis_barang' => 'Macino 1 1/2 Putih ', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Macino 2 1/2 in Jantan Kuning', 'jumlah' => 6, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Tidak Komplit'],
            ['jenis_barang' => 'Macino Kuning 2 1/2 in', 'jumlah' => 9, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Macino Putih 2 1/2 in', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Masker  Coklat', 'jumlah' => 3, 'kondisi' => 'Rusak', 'tahun_anggaran' => null, 'keterangan' => 'Rusak'],
            ['jenis_barang' => 'Masker Baru', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Masker Biru', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Nozel Foam', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Nozel Gun 1 1/2', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Nozel Jet 1 1/2', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Nozel Spray 1 1/2', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Obeng Ketok 1 set Merk Lumos ', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Obeng Ketok 1 Set Merk Tekiro  ', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Pulley Kuning', 'jumlah' => 3, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Pulley Silver', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Sarung Tangan Rescue', 'jumlah' => 9, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Selang 1 1/2 Merah', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Selang 2 1/2 Merah', 'jumlah' => 4, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Senter Kepala ', 'jumlah' => 18, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Senter Super Jumbo ', 'jumlah' => 7, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Sentral Rem Armada 04', 'jumlah' => 2, 'kondisi' => 'Rusak', 'tahun_anggaran' => null, 'keterangan' => 'Rusak'],
            ['jenis_barang' => 'Sepatu Boot Safty Uk 40', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Sepatu Boot Safty Uk 40', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Stik Ular ', 'jumlah' => 2, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Stik Ular ', 'jumlah' => 2, 'kondisi' => 'Rusak', 'tahun_anggaran' => null, 'keterangan' => 'Bekas'],
            ['jenis_barang' => 'Tali Karamantel Hitam 14 ml', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Tali Karamantel Putih 12 ml', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Tandu', 'jumlah' => 1, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
            ['jenis_barang' => 'Y- Conection', 'jumlah' => 4, 'kondisi' => 'Baik', 'tahun_anggaran' => null, 'keterangan' => null],
        ];

        foreach ($data as $item) {
            StokSapra::create($item);
        }
    }
}
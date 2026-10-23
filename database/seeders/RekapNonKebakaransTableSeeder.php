<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RekapNonKebakaransTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rekap_non_kebakarans')->delete();
        
        \DB::table('rekap_non_kebakarans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tahun' => 2023,
                'bulan' => 'JANUARI',
                'bulan_angka' => 1,
                'total_kejadian' => 40,
            'rincian_bencana' => '{"Pohon Tumbang": 9, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 30, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 4, "Kota Baru": 13, "Paal Merah": 2, "Pelayangan": 0, "Alam Barajo": 7, "Danau Sipin": 0, "Danau Teluk": 1, "Jambi Timur": 4, "Pasar Jambi": 2, "Telanaipura": 1, "Jambi Selatan": 5, "Perbatasan (Muaro Jambi)": 1}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            1 => 
            array (
                'id' => 2,
                'tahun' => 2023,
                'bulan' => 'FEBRUARI',
                'bulan_angka' => 2,
                'total_kejadian' => 26,
            'rincian_bencana' => '{"Pohon Tumbang": 4, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 22, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 7, "Kota Baru": 4, "Paal Merah": 1, "Pelayangan": 0, "Alam Barajo": 5, "Danau Sipin": 3, "Danau Teluk": 0, "Jambi Timur": 0, "Pasar Jambi": 1, "Telanaipura": 2, "Jambi Selatan": 2, "Perbatasan (Muaro Jambi)": 1}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            2 => 
            array (
                'id' => 3,
                'tahun' => 2023,
                'bulan' => 'MARET',
                'bulan_angka' => 3,
                'total_kejadian' => 26,
            'rincian_bencana' => '{"Pohon Tumbang": 8, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 18, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 6, "Kota Baru": 4, "Paal Merah": 0, "Pelayangan": 0, "Alam Barajo": 5, "Danau Sipin": 1, "Danau Teluk": 0, "Jambi Timur": 1, "Pasar Jambi": 0, "Telanaipura": 4, "Jambi Selatan": 3, "Perbatasan (Muaro Jambi)": 2}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            3 => 
            array (
                'id' => 4,
                'tahun' => 2023,
                'bulan' => 'APRIL',
                'bulan_angka' => 4,
                'total_kejadian' => 33,
            'rincian_bencana' => '{"Pohon Tumbang": 15, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 17, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 1, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 3, "Kota Baru": 8, "Paal Merah": 0, "Pelayangan": 1, "Alam Barajo": 4, "Danau Sipin": 8, "Danau Teluk": 0, "Jambi Timur": 0, "Pasar Jambi": 0, "Telanaipura": 6, "Jambi Selatan": 2, "Perbatasan (Muaro Jambi)": 1}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            4 => 
            array (
                'id' => 5,
                'tahun' => 2023,
                'bulan' => 'MEI',
                'bulan_angka' => 5,
                'total_kejadian' => 28,
            'rincian_bencana' => '{"Pohon Tumbang": 4, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 22, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 2, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 3, "Kota Baru": 6, "Paal Merah": 0, "Pelayangan": 0, "Alam Barajo": 3, "Danau Sipin": 4, "Danau Teluk": 0, "Jambi Timur": 0, "Pasar Jambi": 1, "Telanaipura": 6, "Jambi Selatan": 5, "Perbatasan (Muaro Jambi)": 0}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            5 => 
            array (
                'id' => 6,
                'tahun' => 2023,
                'bulan' => 'JUNI',
                'bulan_angka' => 6,
                'total_kejadian' => 35,
            'rincian_bencana' => '{"Pohon Tumbang": 7, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 28, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 5, "Kota Baru": 6, "Paal Merah": 0, "Pelayangan": 1, "Alam Barajo": 6, "Danau Sipin": 3, "Danau Teluk": 0, "Jambi Timur": 0, "Pasar Jambi": 0, "Telanaipura": 10, "Jambi Selatan": 4, "Perbatasan (Muaro Jambi)": 0}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            6 => 
            array (
                'id' => 7,
                'tahun' => 2023,
                'bulan' => 'JULI',
                'bulan_angka' => 7,
                'total_kejadian' => 41,
            'rincian_bencana' => '{"Pohon Tumbang": 6, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 34, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 6, "Kota Baru": 9, "Paal Merah": 1, "Pelayangan": 0, "Alam Barajo": 6, "Danau Sipin": 4, "Danau Teluk": 0, "Jambi Timur": 1, "Pasar Jambi": 1, "Telanaipura": 5, "Jambi Selatan": 6, "Perbatasan (Muaro Jambi)": 2}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            7 => 
            array (
                'id' => 8,
                'tahun' => 2023,
                'bulan' => 'AGUSTUS',
                'bulan_angka' => 8,
                'total_kejadian' => 31,
            'rincian_bencana' => '{"Pohon Tumbang": 6, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 25, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 3, "Kota Baru": 8, "Paal Merah": 2, "Pelayangan": 0, "Alam Barajo": 5, "Danau Sipin": 3, "Danau Teluk": 0, "Jambi Timur": 0, "Pasar Jambi": 0, "Telanaipura": 5, "Jambi Selatan": 3, "Perbatasan (Muaro Jambi)": 2}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            8 => 
            array (
                'id' => 9,
                'tahun' => 2023,
                'bulan' => 'SEPTEMBER',
                'bulan_angka' => 9,
                'total_kejadian' => 32,
            'rincian_bencana' => '{"Pohon Tumbang": 7, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 24, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 1, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 2, "Kota Baru": 4, "Paal Merah": 2, "Pelayangan": 0, "Alam Barajo": 6, "Danau Sipin": 3, "Danau Teluk": 4, "Jambi Timur": 2, "Pasar Jambi": 0, "Telanaipura": 4, "Jambi Selatan": 3, "Perbatasan (Muaro Jambi)": 2}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            9 => 
            array (
                'id' => 10,
                'tahun' => 2023,
                'bulan' => 'OKTOBER',
                'bulan_angka' => 10,
                'total_kejadian' => 48,
            'rincian_bencana' => '{"Pohon Tumbang": 8, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 40, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 0, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 6, "Kota Baru": 9, "Paal Merah": 7, "Pelayangan": 1, "Alam Barajo": 3, "Danau Sipin": 4, "Danau Teluk": 2, "Jambi Timur": 1, "Pasar Jambi": 1, "Telanaipura": 5, "Jambi Selatan": 4, "Perbatasan (Muaro Jambi)": 5}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            10 => 
            array (
                'id' => 11,
                'tahun' => 2023,
                'bulan' => 'NOVEMBER',
                'bulan_angka' => 11,
                'total_kejadian' => 56,
            'rincian_bencana' => '{"Pohon Tumbang": 10, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 45, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 1, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 4, "Kota Baru": 6, "Paal Merah": 9, "Pelayangan": 0, "Alam Barajo": 10, "Danau Sipin": 4, "Danau Teluk": 2, "Jambi Timur": 4, "Pasar Jambi": 0, "Telanaipura": 11, "Jambi Selatan": 3, "Perbatasan (Muaro Jambi)": 3}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            11 => 
            array (
                'id' => 12,
                'tahun' => 2023,
                'bulan' => 'DESEMBER',
                'bulan_angka' => 12,
                'total_kejadian' => 51,
            'rincian_bencana' => '{"Pohon Tumbang": 14, "Tanah Longsor": 0, "Bangunan Runtuh": 0, "Beda Ketinggian": 0, "Operasi Lainnya": 0, "Angin Puting Beliung": 0, "Percobaan Bunuh Diri": 0, "Animal Rescue (Hewan)": 0, "Kecelakaan Transportasi": 0, "Pelepasan Cincin/Anting": 36, "Meninggal Tertimpa Pohon": 0, "Water Rescue (Tenggelam)": 0, "Meninggal Tersambar Petir": 0, "Rumah Roboh / Rumah Retak": 0, "Meninggal Kesetrum Listrik": 1, "Meninggal Korban Kebakaran": 0}',
            'rincian_kecamatan' => '{"Jelutung": 2, "Kota Baru": 8, "Paal Merah": 7, "Pelayangan": 1, "Alam Barajo": 10, "Danau Sipin": 3, "Danau Teluk": 3, "Jambi Timur": 6, "Pasar Jambi": 0, "Telanaipura": 5, "Jambi Selatan": 5, "Perbatasan (Muaro Jambi)": 1}',
                'created_at' => '2026-10-23 09:45:50',
                'updated_at' => '2026-10-23 09:58:28',
            ),
            12 => 
            array (
                'id' => 13,
                'tahun' => 2024,
                'bulan' => 'JANUARI',
                'bulan_angka' => 1,
                'total_kejadian' => 49,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 1, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 40, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 5, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 1, "WATER RESCUE (TENGGELAM)": 2, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 7, "KOTA BARU": 13, "PAAL MERAH": 3, "PELAYANGAN": 3, "ALAM BARAJO": 7, "DANAU SIPIN": 1, "DANAU TELUK": 4, "JAMBI TIMUR": 4, "PASAR JAMBI": 0, "TELANAI PURA": 3, "JAMBI SELATAN": 4, "PERBATASAN (MUARO JAMBI)": 0}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            13 => 
            array (
                'id' => 14,
                'tahun' => 2024,
                'bulan' => 'FEBRUARI',
                'bulan_angka' => 2,
                'total_kejadian' => 29,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 25, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 4, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 2, "KOTA BARU": 5, "PAAL MERAH": 6, "PELAYANGAN": 0, "ALAM BARAJO": 8, "DANAU SIPIN": 1, "DANAU TELUK": 0, "JAMBI TIMUR": 3, "PASAR JAMBI": 0, "TELANAI PURA": 1, "JAMBI SELATAN": 2, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            14 => 
            array (
                'id' => 15,
                'tahun' => 2024,
                'bulan' => 'MARET',
                'bulan_angka' => 3,
                'total_kejadian' => 57,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 50, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 6, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 1, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 3, "KOTA BARU": 8, "PAAL MERAH": 13, "PELAYANGAN": 2, "ALAM BARAJO": 7, "DANAU SIPIN": 1, "DANAU TELUK": 2, "JAMBI TIMUR": 2, "PASAR JAMBI": 3, "TELANAI PURA": 9, "JAMBI SELATAN": 5, "PERBATASAN (MUARO JAMBI)": 2}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            15 => 
            array (
                'id' => 16,
                'tahun' => 2024,
                'bulan' => 'APRIL',
                'bulan_angka' => 4,
                'total_kejadian' => 50,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 35, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 15, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 5, "KOTA BARU": 10, "PAAL MERAH": 8, "PELAYANGAN": 1, "ALAM BARAJO": 8, "DANAU SIPIN": 2, "DANAU TELUK": 1, "JAMBI TIMUR": 1, "PASAR JAMBI": 1, "TELANAI PURA": 5, "JAMBI SELATAN": 5, "PERBATASAN (MUARO JAMBI)": 3}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            16 => 
            array (
                'id' => 17,
                'tahun' => 2024,
                'bulan' => 'MEI',
                'bulan_angka' => 5,
                'total_kejadian' => 57,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 2, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 47, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 8, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 2, "KOTA BARU": 19, "PAAL MERAH": 5, "PELAYANGAN": 0, "ALAM BARAJO": 6, "DANAU SIPIN": 2, "DANAU TELUK": 3, "JAMBI TIMUR": 9, "PASAR JAMBI": 0, "TELANAI PURA": 4, "JAMBI SELATAN": 5, "PERBATASAN (MUARO JAMBI)": 2}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            17 => 
            array (
                'id' => 18,
                'tahun' => 2024,
                'bulan' => 'JUNI',
                'bulan_angka' => 6,
                'total_kejadian' => 56,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 50, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 6, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 5, "KOTA BARU": 12, "PAAL MERAH": 7, "PELAYANGAN": 0, "ALAM BARAJO": 11, "DANAU SIPIN": 5, "DANAU TELUK": 2, "JAMBI TIMUR": 7, "PASAR JAMBI": 0, "TELANAI PURA": 2, "JAMBI SELATAN": 3, "PERBATASAN (MUARO JAMBI)": 2}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            18 => 
            array (
                'id' => 19,
                'tahun' => 2024,
                'bulan' => 'JULI',
                'bulan_angka' => 7,
                'total_kejadian' => 66,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 1, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 53, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 12, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 3, "KOTA BARU": 11, "PAAL MERAH": 11, "PELAYANGAN": 3, "ALAM BARAJO": 14, "DANAU SIPIN": 3, "DANAU TELUK": 0, "JAMBI TIMUR": 8, "PASAR JAMBI": 0, "TELANAI PURA": 6, "JAMBI SELATAN": 6, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            19 => 
            array (
                'id' => 20,
                'tahun' => 2024,
                'bulan' => 'AGUSTUS',
                'bulan_angka' => 8,
                'total_kejadian' => 61,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 1, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 1, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 56, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 3, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 3, "KOTA BARU": 11, "PAAL MERAH": 9, "PELAYANGAN": 1, "ALAM BARAJO": 12, "DANAU SIPIN": 1, "DANAU TELUK": 3, "JAMBI TIMUR": 4, "PASAR JAMBI": 0, "TELANAI PURA": 10, "JAMBI SELATAN": 7, "PERBATASAN (MUARO JAMBI)": 0}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            20 => 
            array (
                'id' => 21,
                'tahun' => 2024,
                'bulan' => 'SEPTEMBER',
                'bulan_angka' => 9,
                'total_kejadian' => 56,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 1, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 42, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 13, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 3, "KOTA BARU": 11, "PAAL MERAH": 5, "PELAYANGAN": 1, "ALAM BARAJO": 8, "DANAU SIPIN": 3, "DANAU TELUK": 3, "JAMBI TIMUR": 4, "PASAR JAMBI": 0, "TELANAI PURA": 11, "JAMBI SELATAN": 6, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            21 => 
            array (
                'id' => 22,
                'tahun' => 2024,
                'bulan' => 'OKTOBER',
                'bulan_angka' => 10,
                'total_kejadian' => 58,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 4, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 48, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 6, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 6, "KOTA BARU": 13, "PAAL MERAH": 4, "PELAYANGAN": 1, "ALAM BARAJO": 9, "DANAU SIPIN": 5, "DANAU TELUK": 1, "JAMBI TIMUR": 4, "PASAR JAMBI": 2, "TELANAI PURA": 5, "JAMBI SELATAN": 6, "PERBATASAN (MUARO JAMBI)": 2}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            22 => 
            array (
                'id' => 23,
                'tahun' => 2024,
                'bulan' => 'NOVEMBER',
                'bulan_angka' => 11,
                'total_kejadian' => 56,
            'rincian_bencana' => '{"BANJIR": 1, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 1, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 46, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 8, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 5, "KOTA BARU": 10, "PAAL MERAH": 3, "PELAYANGAN": 1, "ALAM BARAJO": 12, "DANAU SIPIN": 5, "DANAU TELUK": 1, "JAMBI TIMUR": 5, "PASAR JAMBI": 0, "TELANAI PURA": 8, "JAMBI SELATAN": 2, "PERBATASAN (MUARO JAMBI)": 4}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            23 => 
            array (
                'id' => 24,
                'tahun' => 2024,
                'bulan' => 'DESEMBER',
                'bulan_angka' => 12,
                'total_kejadian' => 50,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 42, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 8, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 6, "KOTA BARU": 6, "PAAL MERAH": 7, "PELAYANGAN": 0, "ALAM BARAJO": 9, "DANAU SIPIN": 7, "DANAU TELUK": 1, "JAMBI TIMUR": 0, "PASAR JAMBI": 0, "TELANAI PURA": 7, "JAMBI SELATAN": 6, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:29',
                'updated_at' => '2026-10-23 10:25:29',
            ),
            24 => 
            array (
                'id' => 25,
                'tahun' => 2026,
                'bulan' => 'JANUARI',
                'bulan_angka' => 1,
                'total_kejadian' => 117,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 3, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 101, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 11, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 2, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 9, "KOTA BARU": 23, "PAAL MERAH": 15, "PELAYANGAN": 2, "ALAM BARAJO": 16, "DANAU SIPIN": 9, "DANAU TELUK": 6, "JAMBI TIMUR": 5, "PASAR JAMBI": 3, "TELANAI PURA": 14, "JAMBI SELATAN": 11, "PERBATASAN (MUARO JAMBI)": 4}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            25 => 
            array (
                'id' => 26,
                'tahun' => 2026,
                'bulan' => 'FEBRUARI',
                'bulan_angka' => 2,
                'total_kejadian' => 109,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 4, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 99, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 6, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 16, "KOTA BARU": 14, "PAAL MERAH": 10, "PELAYANGAN": 1, "ALAM BARAJO": 23, "DANAU SIPIN": 7, "DANAU TELUK": 7, "JAMBI TIMUR": 6, "PASAR JAMBI": 2, "TELANAI PURA": 15, "JAMBI SELATAN": 7, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            26 => 
            array (
                'id' => 27,
                'tahun' => 2026,
                'bulan' => 'MARET',
                'bulan_angka' => 3,
                'total_kejadian' => 103,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 3, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 90, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 10, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 10, "KOTA BARU": 17, "PAAL MERAH": 15, "PELAYANGAN": 0, "ALAM BARAJO": 20, "DANAU SIPIN": 5, "DANAU TELUK": 1, "JAMBI TIMUR": 8, "PASAR JAMBI": 1, "TELANAI PURA": 11, "JAMBI SELATAN": 12, "PERBATASAN (MUARO JAMBI)": 3}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            27 => 
            array (
                'id' => 28,
                'tahun' => 2026,
                'bulan' => 'APRIL',
                'bulan_angka' => 4,
                'total_kejadian' => 122,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 7, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 108, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 7, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 11, "KOTA BARU": 20, "PAAL MERAH": 16, "PELAYANGAN": 0, "ALAM BARAJO": 34, "DANAU SIPIN": 6, "DANAU TELUK": 2, "JAMBI TIMUR": 9, "PASAR JAMBI": 2, "TELANAI PURA": 12, "JAMBI SELATAN": 10, "PERBATASAN (MUARO JAMBI)": 0}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            28 => 
            array (
                'id' => 29,
                'tahun' => 2026,
                'bulan' => 'MEI',
                'bulan_angka' => 5,
                'total_kejadian' => 120,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 13, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 98, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 9, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 11, "KOTA BARU": 26, "PAAL MERAH": 17, "PELAYANGAN": 0, "ALAM BARAJO": 23, "DANAU SIPIN": 7, "DANAU TELUK": 4, "JAMBI TIMUR": 7, "PASAR JAMBI": 5, "TELANAI PURA": 13, "JAMBI SELATAN": 7, "PERBATASAN (MUARO JAMBI)": 0}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            29 => 
            array (
                'id' => 30,
                'tahun' => 2026,
                'bulan' => 'JUNI',
                'bulan_angka' => 6,
                'total_kejadian' => 123,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 17, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 90, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 16, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 16, "KOTA BARU": 30, "PAAL MERAH": 14, "PELAYANGAN": 0, "ALAM BARAJO": 20, "DANAU SIPIN": 11, "DANAU TELUK": 2, "JAMBI TIMUR": 5, "PASAR JAMBI": 1, "TELANAI PURA": 15, "JAMBI SELATAN": 6, "PERBATASAN (MUARO JAMBI)": 3}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            30 => 
            array (
                'id' => 31,
                'tahun' => 2026,
                'bulan' => 'JULI',
                'bulan_angka' => 7,
                'total_kejadian' => 127,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 12, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 103, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 12, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 13, "KOTA BARU": 27, "PAAL MERAH": 18, "PELAYANGAN": 1, "ALAM BARAJO": 21, "DANAU SIPIN": 8, "DANAU TELUK": 1, "JAMBI TIMUR": 5, "PASAR JAMBI": 1, "TELANAI PURA": 19, "JAMBI SELATAN": 12, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            31 => 
            array (
                'id' => 32,
                'tahun' => 2026,
                'bulan' => 'AGUSTUS',
                'bulan_angka' => 8,
                'total_kejadian' => 132,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 37, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 87, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 8, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 12, "KOTA BARU": 45, "PAAL MERAH": 8, "PELAYANGAN": 0, "ALAM BARAJO": 20, "DANAU SIPIN": 7, "DANAU TELUK": 2, "JAMBI TIMUR": 7, "PASAR JAMBI": 3, "TELANAI PURA": 11, "JAMBI SELATAN": 15, "PERBATASAN (MUARO JAMBI)": 2}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            32 => 
            array (
                'id' => 33,
                'tahun' => 2026,
                'bulan' => 'SEPTEMBER',
                'bulan_angka' => 9,
                'total_kejadian' => 102,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 13, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 82, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 7, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 7, "KOTA BARU": 21, "PAAL MERAH": 11, "PELAYANGAN": 0, "ALAM BARAJO": 26, "DANAU SIPIN": 8, "DANAU TELUK": 0, "JAMBI TIMUR": 8, "PASAR JAMBI": 1, "TELANAI PURA": 8, "JAMBI SELATAN": 11, "PERBATASAN (MUARO JAMBI)": 1}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            33 => 
            array (
                'id' => 34,
                'tahun' => 2026,
                'bulan' => 'OKTOBER',
                'bulan_angka' => 10,
                'total_kejadian' => 92,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 6, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 72, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 14, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 7, "KOTA BARU": 17, "PAAL MERAH": 15, "PELAYANGAN": 0, "ALAM BARAJO": 20, "DANAU SIPIN": 5, "DANAU TELUK": 2, "JAMBI TIMUR": 7, "PASAR JAMBI": 1, "TELANAI PURA": 9, "JAMBI SELATAN": 7, "PERBATASAN (MUARO JAMBI)": 2}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            34 => 
            array (
                'id' => 35,
                'tahun' => 2026,
                'bulan' => 'NOVEMBER',
                'bulan_angka' => 11,
                'total_kejadian' => 0,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 0, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 0, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 0, "KOTA BARU": 0, "PAAL MERAH": 0, "PELAYANGAN": 0, "ALAM BARAJO": 0, "DANAU SIPIN": 0, "DANAU TELUK": 0, "JAMBI TIMUR": 0, "PASAR JAMBI": 0, "TELANAI PURA": 0, "JAMBI SELATAN": 0, "PERBATASAN (MUARO JAMBI)": 0}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
            35 => 
            array (
                'id' => 36,
                'tahun' => 2026,
                'bulan' => 'DESEMBER',
                'bulan_angka' => 12,
                'total_kejadian' => 0,
            'rincian_bencana' => '{"BANJIR": 0, "POHON TUMBANG": 0, "TANAH LONGSOR": 0, "BANGUNAN RUNTUH": 0, "BEDA KETINGGIAN": 0, "OPERASI LAINNYA": 0, "ANGIN PUTING BELIUNG": 0, "PERCOBAAN BUNUH DIRI": 0, "ANIMAL RESCUE (HEWAN)": 0, "KECELAKAAN TRANSPORTASI": 0, "PELEPASAN CINCIN/ANTING": 0, "MENINGGAL TERTIMPA POHON": 0, "RUMAH ROBOH/ RUMAH RETAK": 0, "WATER RESCUE (TENGGELAM)": 0, "MENINGGAL TERSAMBAR PETIR": 0, "MENINGGAL KESETRUM LISTRIK": 0, "MENINGGAL KORBAN KEBAKARAN": 0}',
            'rincian_kecamatan' => '{"JELUTUNG": 0, "KOTA BARU": 0, "PAAL MERAH": 0, "PELAYANGAN": 0, "ALAM BARAJO": 0, "DANAU SIPIN": 0, "DANAU TELUK": 0, "JAMBI TIMUR": 0, "PASAR JAMBI": 0, "TELANAI PURA": 0, "JAMBI SELATAN": 0, "PERBATASAN (MUARO JAMBI)": 0}',
                'created_at' => '2026-10-23 10:25:39',
                'updated_at' => '2026-10-23 10:25:39',
            ),
        ));
        
        
    }
}
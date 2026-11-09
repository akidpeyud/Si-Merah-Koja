<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class KunjunganEdukasiSeeder extends Seeder
{
    /**
     * Isi data Kunjungan dan Edukasi (ke Damkar) tahun 2025 (59 kunjungan) dan 2026 (24 kunjungan).
     */
    public function run(): void
    {
        if (! Schema::hasTable('sosialisasi_edukasi') || ! Schema::hasColumn('sosialisasi_edukasi', 'nama_instansi')) {
            return;
        }

        $now = now();

        /**
         * Format tiap baris:
         * [no_tanggal_surat_permohonan, nama_instansi, tempat_pelaksanaan, alamat, tanggal_pelaksanaan, jumlah_peserta, nama_penanggung_jawab, no_telepon, surat_perintah_tugas?]
         *
         * @var array<int, array{0: string|null, 1: string, 2: string, 3: string, 4: string, 5: int, 6: string|null, 7: string|null, 8?: string|null}>
         */
        $rows = [
            // =========================================================
            // TAHUN 2025 (59 Kunjungan - 4.868 Peserta)
            // =========================================================
            ['47/TK-YB/X-2024 dan 03 Oktober 2024', 'TK Baiturrahim', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-04', 37, 'SUTIHAT,S.Ag', '081366295650'],
            ['-', 'TK Pembina 2', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-05', 79, null, null],
            ['04/TKIT-MH/JBI/I/2025 dan 10 Januari 2025', 'TK Mutiara Hati', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-06', 60, 'RIDA', '082285643165'],
            ['31/YBR-RABR/X/2024 dan Oktober 2024', 'TK Baitulrahman', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-10', 25, 'RA BAITURAHMAH', '085186860204'],
            ['75/TK.AS/XI/2024 dan 14 November 2024', 'TK As Salam', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-11', 40, 'TK AS-SALAM', '081366471408'],
            ['041/YNY/I/2025 dan 24 Januari 2025', 'TK Nurul Yakin', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-12', 55, 'NURUL YAQIN', '085282648895'],
            ['-', 'TK Aksan', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-13', 40, null, null],
            ['20 Januari 2025', 'TK RA Al Irsyad', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-17', 44, 'MARIA ULFA', '082282261661'],
            ['421.2/110/SDN.63/2024 dan 30 Januari 2025', 'SDN 63', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-18', 43, 'ERNI', null],
            ['RA-AL/XII/2024 dan 23 Desember 2025', 'TK Al Hikmah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-19', 68, 'AL HIKMAH', '081356158589'],
            ['26/TK.ABA.I/D/X/2024 dan 29 Oktober 2024', 'TK Bustanul Aiyayah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-20', 46, 'TK BUSTANUL', '081278469042'],
            ['22/SP/HHK/I/2025 dan 30 Januari 2025', 'TK Holly Kids', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-02-21', 40, 'MASULIN', '085273832221'],
            ['035/TK-AS/XII/2024 dan 23 Desember 2025', 'TK As Shofa', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-17', 86, 'As-Shofa', '081356158589'],
            ['24/RA.AL-IK/II/2025 dan Februari 2025', 'TK AL Ikhlas', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-21', 55, 'TK AL IKLAS', '081274708495'],
            ['19/TKI-AF/JBI/IV/2025 dan 10 April 2025', 'TK Al Falah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-22', 131, 'TK AL FALAH', '0741670039'],
            ['06/TKIT-NI.2/II/2025 dan 13 Februari 2025', 'TK Nurul Ilmi 2', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-23', 120, 'TK NURUL ILMI', '0741669476'],
            ['S18/03/TKNP/I/2025 dan 14 Februari 2025', 'TK Pembinan 1', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-28', 86, 'TK PEMBINA 1', '074160454'],
            ['025/TKAI/IV/2025 dan 12 April 2025', 'TK Al Ikhlas Sebapo', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-29', 78, 'SRI NURJANAH', '081366241642'],
            ['421.8/13/SLBN.SS/I/2025 dan 23 Januari 2025', 'SLB Provinsi Jambi', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-04-30', 55, 'SLB PROV', '074161879'],
            ['032/SL/CERIBEL/05-2025 dan 02 Mei 2025', 'Ceria Bimbel', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-05-15', 54, 'UUN FATUR', '081398500370'],
            ['-', 'TK Najihan', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-05-20', 54, null, null],
            ['06/TKIT-NI.2/II/2025 dan 13 Februari 2025', 'TK Nurul Ilmi 2', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-05-21', 58, 'TK NURUL ILMI', '0741669476'],
            ['013/TKIT-NI/IV/2025 dan 16 April 2025', 'TK Nurul Ilmi 1', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-05-22', 68, 'TK NURUL ILMI', '0741669476'],
            ['01/KB.I.AW/ok/I/2025 dan April 2025', 'Al wardah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-05-27', 18, 'DESMAWATI', '085294108369'],
            ['005/KBTKRU/05/2025 dan 05 Mei 2025', 'Rumah Umi', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-05-27', 13, 'DEWI KURNIATI', '088272464235'],
            ['012/KB-KH/V/2025 dan 20 Mei 2025', 'Kidshouse', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-06-03', 24, 'WIRDA NINGSIH', null],
            ['015/TK.HP/V/2025 dan 05 Mei 2025', 'Harapan Bunda', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-06-04', 36, 'ERLINA', '087824456863'],
            ['421.2/342/SD-KCK/X/2025 dan 30 Oktober 2025', 'Kartika II -25', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-06-05', 66, 'Fenny', '0896285045453'],
            ['018 dan 07 Mei 2025', 'AR Rahman', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-06-27', 56, 'SUSILANA,S.Pd', null],
            ['800/171/SMAN5/2025 dan 10 Juli 2025', 'SMA 5', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-07-18', 550, 'SMAN 5', '07413064057'],
            ['14 Juli 2025', 'SMA 8', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-07-19', 151, 'RAYHAN', '089667690002'],
            ['2/SPM-HUMDIV/RZ/VII/2025 dan 21 Juli 2025', 'SMP Syifa', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-07-25', 57, 'AL RAZI', '081573001555'],
            ['042.1/009/TK-US/VIII/2025 dan 05 Agustus 2025', 'TK Unggul Sakti', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-08-13', 100, 'MARTA', '081366221719'],
            ['116/SLBN2-KJ/VII/2025 dan 11 Agustus 2025', 'SLB N 2 Prov Jambi', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-08-26', 99, 'SLB 2', '08117449191'],
            ['05/Paudlokomotif/XVIII/V/2025 dan 22 Agustus 2025', 'Paud Lokomotif', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-08-28', 23, 'EVA HARYATI', '08218043864'],
            ['042.1/009/TK-US/VIII/2025 dan 05 Agustus 2025', 'TK Unggul sakti', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-10', 50, 'MARTA', '081366221719'],
            ['042.1/009/TK-US/VIII/2025 dan 05 Agustus 2025', 'TK Unggul sakti', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-10', 58, 'MARTA', '081366221719'],
            ['101/VIII/TK-GM/2025 dan 28 Agustus 2025', 'Akar Dharma Yu lin (GUANG MING)', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-16', 50, 'GUANG MING', '07417555583'],
            ['101/VIII/TK-GM/2025 dan 28 Agustus 2025', 'Akar Dharma Yu lin (GUANG MING)', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-18', 50, 'GUANG MING', '07417555583'],
            ['421.1/114/SDS-IAF.2/09.2025 dan 3 September 2025', 'Alfalah 2', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-22', 56, 'SUNANTI,S.Pd,Gr', '089628319243'],
            ['421.1/114/SDS-IAF.2/09.2025 dan 3 September 2025', 'Alfalah 2', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-23', 57, 'SUNANTI,S.Pd,Gr', '089628319243'],
            ['96/MI.YTI/08/2025 dan 29 Agustus 2025', 'MI Ta\'awuniyah Ikhlas', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-24', 55, null, null],
            ['074/SMA/X.1/S.4/IX/2025', 'SMA XAVERIUS 1', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-26', 206, null, null],
            ['999/LP/CBC.MW/IX/2025 dan 11 september 2025', 'PAUD CBC Mawaddah Warahmah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-09-30', 46, null, null],
            ['999/LP/CBC.MW/IX/2025 dan 11 september 2025', 'PAUD CBC Mawaddah Warahmah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-01', 64, null, null],
            ['421.4/102/LPSHSJBI/IX/2025 dan 26 September 2025', 'Suria Harapan School', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-01', 84, 'SURIA', '085381807016'],
            ['04 September 2025', 'Mcd Kids', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-02', 46, 'JULIANA PUTRI', '081113012011'],
            ['22/TKIA-JMB/IX/2025 dan 24 September 2025', 'TK Islam Ahsan', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-07', 49, 'ROSLAINI', '085271013190'],
            ['422.1/241/SDN204/2025 dan 17 September 2025', 'SDN 204 /IV Kota Jambi', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-08', 132, 'RITA', '085266859337'],
            ['038/B/Sket-SMPITAN-NAHL/I/2025 dan 18 Sepetember 2025', 'SMP IT An-Nahl Percikan Iman Jambi', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-14', 43, 'SMP IT An-Nahl', '07416416'],
            ['038/B/Sket-SMPITAN-NAHL/I/2025 dan 18 Sepetember 2025', 'SMP IT An-Nahl Percikan Iman Jambi', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-10-17', 38, 'SMP IT An-Nahl', '07416416'],
            ['189/S-PVE/SDIT ANNUR/X/2025 dan 27 Oktober 2025', 'SD IT Annur', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-11-06', 103, 'SDIT ANNUR', '085767172582'],
            ['818.30/TK-ALH/VIII/2025 dan 25 Agustus 2025', 'TK PKP Al-Hidayah', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-11-24', 42, 'WARDAH', '082380080775'],
            ['246/A-7/SMKTIJ/XI-2025 dan 13 November 2025', 'SMK Taruna Indonesia', 'SMK Taruna Indonesia', 'Jalan manda surya darma KM.7 kenali Asam Bawah Kota Baru', '2025-11-27', 92, 'Eka Yuni Wulandari', '085274747481'],
            ['228/I.10/I.4/TKNP2/2025 dan 13 Oktober 2025', 'TK Pembina 2', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-12-02', 103, 'ERNI YUSNITA', '074143316'],
            ['12/SP/TK-KRN/X/2025 dan 14 Oktober 2025', 'TK Kirana', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-12-10', 83, 'TK KIRANA', '082352371624'],
            ['S-607/SMAN.14/XII/2025 dan 09 Desember 2025', 'SMA Negeri 14', 'Lapangan Futsal CitraLand NGK Jambi', 'Jl. Ismail Malik, Mayang Mangurai, Kec. Kota Baru, Kota Jambi', '2025-12-11', 623, 'Drs.H Syaipudin.M.Kom', null],
            ['016/KB/CI.st/X/2025 dan 30 Oktober 2025', 'KB Cendikia The First', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-12-16', 65, 'Ana', '08117401979'],
            ['422/19/YPP.PTW.II/XI/2025 dan 06 November 2025', 'TK Pertiwi II', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2025-12-17', 58, 'Rama', '082371445523'],

            // =========================================================
            // TAHUN 2026 (24 Kunjungan - 1.806 Peserta)
            // =========================================================
            ['No. 56/TK_IM/2025 dan 09 Oktober 2025', 'TK ISLAM MUSLIMAT', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-01-14', 73, 'Munir', '081366559566'],
            ['No.95/P/SDIT-JISc/X/2025 dan 27 Oktober 2025', 'SD IT JAMBI ISLAMIC SCHOOL', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-01-27', 77, 'SDIT JIS', '082373314394'],
            ['No.45/RA AL-IK/I/2026 dan 09 Januari 2026', 'TK RA AL-IKHLASH', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-01-29', 81, 'Yuniwati,S.Pd', '081274708495'],
            ['No.95/TK.NV/X/2025 dan 28 Oktober 2025', 'TK NOVA', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-02-03', 52, 'Debi', '081273580402'],
            ['No. 88/SK/RA-Nsy/Jbi/I/2026 dan 12 Januari 2026', 'RA & MI NURUSSIBIYAN', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-04-29', 47, 'Depi Fitriyani,S.Pd', '081367775045'],
            ['No.01/12/AI-IR/2025 dan 23 Desember 2025', 'RA AL-IRSYAD', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-05', 75, 'Maria Ulfa', '082282261661'],
            ['001/IV/Tk-Ilham/2026 dan 30 April 2026', 'TK ILHAM', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-07', 25, 'Wilia Wardayanti, S.Pi', '081265822899'],
            ['No.421.2/001/TKTQ ASH-SHIDDIIQI/I/2026 dan 06 mei 2026', 'TK ASH SHIDDIIQI 2 (PEMAYUNG)', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-12', 29, 'Zahira Ulfa', '081366716661'],
            ['No. 023/TKTJ/I/2026 dan 28 april 2026', 'TK TELKOM', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-13', 46, 'Jamiatul Saadiah', '085156719756'],
            ['No. 051/TK KTK II-25 /IV/2026 dan 28 April 2026', 'TK KARTIKA II-25', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-19', 41, 'Merlissa,S.Pd', '082285572244'],
            ['No. 022/TK.AS/I/2026 dan 13 Januari 2026', 'TK AS-SALAM', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-20', 71, 'Roza Linda,S.Pd', '082376675040'],
            ['No.07/IV.4.AU/A/2025 dan 13 mei 2026', 'SD AHMAD DAHLAN', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-25', 26, 'Fera', '085369492068'],
            ['025/YMA/TK-KB-AS/I/2026 dan 13 Januari 2026', 'TK AS-SHOFA', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-05-26', 63, 'Nurhayati,S.Pd', '082185047238'],
            ['No.010/YMA/RA-KB-AL/IV/2025 dan 16 desember 2025', 'TK AL-HIKMAH', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-06-03', 64, 'Kiki Wulandari', '085337795050'],
            ['No. 034/TK-MI/VI/2026 dan 04 Juni 2026', 'TK MUTIARA IBU', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-06-10', 44, 'Lasmita,S.Pd', '082185074977'],
            ['No. 017/KB-GSIII/II/2026 dan 27 Februari 2026', 'TK GODEN STAR JAMBI', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-06-17', 96, 'Nurlely S.R,S.Pd', '085266786658'],
            ['-', 'RUMAH QURAN RAJAWALI', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-07-07', 84, 'Susila Hayati', '088747848896'],
            ['No.004/RA.TAFIQURRAHMAN/VIII/2026', 'TK RA TAUFIQURRAHMAN', 'MAKO DAMKARTAN KOTA JAMBI', 'JL. Hos Cokroaminoto No. 113', '2026-08-19', 14, 'Sulastri,S.P', '085273821786'],
            ['No.101/VIII/TK-GM/2025 dan 20 Januari 2026', 'SMPS SINAR BIJAKSANA GUANG MING', 'YAYASAN AKAR DHARMA YU LIN (GUANG MING)', 'Jl.Haji Badar No.48 A RT.22 Kel.Pasir Putih Kec.Jambi Selatan Kota Jambi', '2026-01-28', 178, 'Faz', '081368613218'],
            ['-', 'SMK NEGERI 1 KOTA JAMBI', 'SMK NEGERI 1 KOTA JAMBI', 'Jl. A. Thalib Kelurahan Simpang IV Sipin Kecamatan Telanaipura', '2026-02-02', 150, 'Repre', '081373542300'],
            ['-', 'MADRASAH ALIYAH LABORATORIUM', 'MADRASAH ALIYAH LABORATORIUM', 'Jl. Arif Rahman Hakim No.111 Kel. Simpang IV Sipin Kec. Telanaipura', '2026-07-15', 110, 'Man Labor', '085268550900'],
            ['No.016/PAN-VGT/VII/2026 dan 24 Juli 2026', 'SMA YADIKA KOTA JAMBI', 'SMA YADIKA KOTA JAMBI', 'Lorong Anggrek Kel. Lingkar Selatan Kec. Jambi Sel Kota Jambi', '2026-07-30', 30, 'Cahaya RS.S.Pd', '08973399329'],
            ['No.421.2/002/SMPIT-NI.2/VII/2026 dan 06 Juli 2026', 'SMP IT NURUL ILMI 2 KOTA JAMBI', 'SMP IT NURUL ILMI 2 KOTA JAMBI', 'Jl. Syech Mahmud RT 16 Kel. Simpang Rimbo Kec. Alam Barajo Kota Jambi', '2026-08-10', 130, 'Arif Fadillah,M.Pd', '08117482597'],
            ['146/SPm/10-061.10-062/XI/2026 dan 04 November 2026', 'SMAN 11 KOTA JAMBI', 'SMAN 11 KOTA JAMBI', 'Jl.Sersan Anwar Bay Kel.Simpang Rimbo Kec. Alam Barajo', '2026-11-06', 200, 'Novi Dwi Setyaningsih', '083870971399'],
        ];

        $targetDir = public_path('uploads/sosialisasi');
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $sourceDir = storage_path('app/public/seed-files/sosialisasi');
        if (! File::exists($sourceDir)) {
            $sourceDir = public_path('storage/seed-files/sosialisasi');
        }

        $payload = [];
        foreach ($rows as $row) {
            $sptFile = $row[8] ?? null;

            if ($sptFile !== null) {
                $sourcePath = $sourceDir.DIRECTORY_SEPARATOR.$sptFile;
                $destPath = $targetDir.DIRECTORY_SEPARATOR.$sptFile;

                if (File::exists($sourcePath)) {
                    File::copy($sourcePath, $destPath);
                }
            }

            $payload[] = [
                'jenis_kegiatan' => 'Dalam',
                'no_tanggal_surat_permohonan' => $row[0],
                'nama_instansi' => $row[1],
                'tempat_pelaksanaan' => $row[2],
                'alamat' => $row[3],
                'tanggal_pelaksanaan' => $row[4],
                'jumlah_peserta' => $row[5],
                'nama_penanggung_jawab' => $row[6],
                'no_telepon' => $row[7],
                'surat_perintah_tugas' => $sptFile,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('sosialisasi_edukasi')->where('jenis_kegiatan', 'Dalam')->delete();
        DB::table('sosialisasi_edukasi')->insert($payload);
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\PencegahanTemplateExport;
use App\Imports\Pencegahan\PencegahanDynamicImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PencegahanImportController extends Controller
{
    private const MODUL_LABELS = [
        'diksar' => 'DIKSAR',
        'diklat-f1' => 'DIKLAT F1 (Pemadam I)',
        'diklat-f2' => 'DIKLAT F2 (Pemadam II)',
        'diklat-rescue' => 'DIKLAT RESCUE',
        'diklat-mfr' => 'DIKLAT MFR',
        'diklat-operator' => 'DIKLAT OPERATOR',
        'diklat-inspektur' => 'DIKLAT INSPEKTUR',
        'diklat-ppl' => 'DIKLAT PPL',
        'inspeksi-bangunan' => 'Inspeksi Bangunan Gedung & Lingkungan',
        'fire-drill' => 'Fire Drill',
        'pks' => 'Perjanjian Kerjasama (PKS)',
        'sosialisasi' => 'Sosialisasi & Edukasi',
        'kunjungan-sekolah' => 'Kunjungan Sekolah',
        'pelatihan-keluarga' => 'Pelatihan Keluarga Tanggap Kebakaran',
        'edukasi' => 'Data Edukasi',
        'redkar' => 'Data Redkar',
        'rpkbgl' => 'Data RPPKBGL',
        'skk' => 'Data SKK',
    ];

    public function import(Request $request, string $modul): RedirectResponse
    {
        $modulKey = $this->resolveModul($modul, $request->input('jenis_diklat'));
        if ($modulKey === null) {
            return redirect()->back()->with('error', 'Modul impor tidak dikenali.');
        }

        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ], [
            'file_excel.required' => 'Pilih file Excel/CSV terlebih dahulu.',
            'file_excel.mimes' => 'Format file harus .xlsx, .xls, atau .csv.',
            'file_excel.max' => 'Ukuran file maksimal 10 MB.',
        ]);

        try {
            $importer = new PencegahanDynamicImport($modulKey);
            Excel::import($importer, $request->file('file_excel'));

            $label = self::MODUL_LABELS[$modulKey];
            if ($importer->insertedCount === 0) {
                return redirect()->back()->with(
                    'error',
                    "Tidak ada data {$label} yang berhasil diimpor. Pastikan nama kolom sesuai template Excel."
                );
            }

            $pesan = "Berhasil mengimpor {$importer->insertedCount} data {$label}.";
            if ($importer->skippedCount > 0) {
                $pesan .= " ({$importer->skippedCount} baris dilewati karena tidak lengkap/duplikat.)";
            }

            return redirect()->back()->with('success', $pesan);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor file Excel: '.$e->getMessage());
        }
    }

    public function template(string $modul): BinaryFileResponse
    {
        $modulKey = $this->resolveModul($modul);
        abort_if($modulKey === null, 404);

        $slug = strtoupper(str_replace('-', '_', Str::slug($modulKey)));

        return Excel::download(new PencegahanTemplateExport($modulKey), "Template_Import_{$slug}.xlsx");
    }

    private function resolveModul(string $modul, ?string $overrideDiklat = null): ?string
    {
        $key = strtolower(trim($modul));
        if ($key === 'diklat' && $overrideDiklat) {
            $key = strtolower(trim($overrideDiklat));
        }

        return array_key_exists($key, self::MODUL_LABELS) ? $key : null;
    }
}

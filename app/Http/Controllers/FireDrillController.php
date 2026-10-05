<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FireDrill;

class FireDrillController extends Controller
{
    public function cetak()
    {
        $data = FireDrill::orderBy('tanggal_pelaksanaan', 'desc')->get();

        return view('internal.pencegahan.cetak_pdf_fire_drill', compact('data'));
    }

    public function cetakExcelFireDrill()
    {
        $data = FireDrill::orderBy('tanggal_pelaksanaan', 'desc')->get();
        $filename = "Data_Fire_Drill_" . date('Ymd') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NO', 'NAMA INSTANSI', 'TAHUN', 'TANGGAL PELAKSANAAN', 'TEMPAT PELAKSANAAN', 'PESERTA LAKI-LAKI', 'PESERTA PEREMPUAN', 'TOTAL PESERTA'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama_instansi ?? '-',
                    $row->tahun ?? '-',
                    $row->tanggal_pelaksanaan ?? '-',
                    $row->tempat_pelaksanaan ?? '-',
                    $row->peserta_laki_laki ?? '0',
                    $row->peserta_perempuan ?? '0',
                    $row->total_peserta ?? '0'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function excel(Request $request)
    {
        $query = FireDrill::query();

        // Opsional: ...?tahun=2025
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $data = $query->orderBy('tahun', 'desc')
                      ->orderBy('tanggal_pelaksanaan', 'desc')
                      ->get();

        $html = view('internal.pencegahan.excel_fire_drill', compact('data'))->render();

        $filename = 'Data_Fire_Drill_' . date('Y-m-d') . '.xls';

        return response($html, 200, [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control'       => 'max-age=0',
        ]);
    }
}
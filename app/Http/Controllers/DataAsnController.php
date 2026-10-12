<?php

namespace App\Http\Controllers;

use App\Models\DataAsn;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware; 

class DataAsnController extends Controller implements HasMiddleware
{
    /**
     * Mendefinisikan middleware untuk controller ini (Standar Laravel 11+)
     */
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::class . ':asn-list|asn-create|asn-edit|asn-delete', only: ['index','show']),
            new Middleware(PermissionMiddleware::class . ':asn-create', only: ['create','store']),
            new Middleware(PermissionMiddleware::class . ':asn-edit', only: ['edit','update']),
            new Middleware(PermissionMiddleware::class . ':asn-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $dataAsn = DataAsn::all();
        $totalPns = $dataAsn->sum('pns');
        $totalPppk = $dataAsn->sum('pppk');
        $totalSeluruh = $totalPns + $totalPppk;

        // Disesuaikan dengan asumsi folder view berada di dalam folder "internal"
        return view('internal.kepegawaian.data-asn.index', compact('dataAsn', 'totalPns', 'totalPppk', 'totalSeluruh'));
    }

    public function create()
    {
        return view('internal.kepegawaian.data-asn.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'pns' => 'required|integer|min:0',
            'pppk' => 'required|integer|min:0',
        ]);

        DataAsn::create($request->all());

        return redirect()->route('data-asn.index')
                        ->with('success', 'Data ASN berhasil ditambahkan.');
    }

    // FUNGSI EDIT CUKUP SATU KALI SAJA
    public function edit(DataAsn $dataAsn)
    {
        return view('internal.kepegawaian.data-asn.edit', compact('dataAsn'));
    }

    public function update(Request $request, DataAsn $dataAsn)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'pns' => 'required|integer|min:0',
            'pppk' => 'required|integer|min:0',
        ]);

        $dataAsn->update($request->all());

        return redirect()->route('data-asn.index')
                        ->with('success', 'Data ASN berhasil diperbarui.');
    }

    public function destroy(DataAsn $dataAsn)
    {
        $dataAsn->delete();

        return redirect()->route('data-asn.index')
                        ->with('success', 'Data ASN berhasil dihapus.');
    }
}
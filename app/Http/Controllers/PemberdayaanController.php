<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemberdayaanController extends Controller
{
    public function create()
    {
        // Mengarahkan ke file view form tambah data
        return view('internal.pencegahan.create_pemberdayaan');
    }

    public function store(Request $request)
    {
        // Tempat untuk logika insert data ke database nanti
    }
}
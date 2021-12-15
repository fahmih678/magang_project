<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function index()
    {
        return view('pages.admin.barang.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk    = Product::count();
        $totalKategori  = Category::count();
        $totalKlik      = Product::sum('clicks');

        return view('dashboard', [
            'totalProduk'   => $totalProduk,
            'totalKategori' => $totalKategori,
            'totalKlik'     => $totalKlik,
        ]);
    }
}

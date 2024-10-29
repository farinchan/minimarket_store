<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PemesananItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'menu' => 'home',
            'submenu' => '',

            'latest_products' => Produk::latest()->limit(8)->get(),
            'top_products' => Produk::select('produk.*', DB::raw('sum(pemesanan_item.jumlah) as total_penjualan'))
                ->leftJoin('pemesanan_item', 'produk.id_produk', '=', 'pemesanan_item.produk_id')
                ->groupBy('produk.id_produk')
                ->orderBy('total_penjualan', 'desc')
                ->limit(8)
                ->get(),
        ];
        // dd($data);
        return view('front.pages.home.index', $data);
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;
        $data = [
            'title' => 'Produk',
            'menu' => 'produk',
            'submenu' => '',

            'list_produk' => Produk::where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('harga', 'like', '%' . $search . '%');
            })->paginate(12),
        ];
        return view('front.pages.produk.index', $data);
    }
}

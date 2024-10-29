<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function detail($id)
    {
        $produk = Produk::find($id);
        $data = [
            'title' => 'Detail Produk',
            'menu' => 'produk',
            'submenu' => '',

            'produk' => $produk,
            'produk_terkait' => Produk::where('kategori_produk_id', $produk->kategori_produk_id)->where('id_produk', '!=', $produk->id_produk)->inRandomOrder()->limit(4)->get(),
        ];
        return view('front.pages.produk.detail', $data);
    }

    public function category()
    {
        $id = request()->cat;
        if (!$id) {
            return redirect()->route('produk');
        }
        $kategori = KategoriProduk::where('id_kategori_produk', $id)->first();
        if (!$kategori) {
            Alert::error('Kategori tidak ditemukan');
            return redirect()->route('produk');
        }
        $data = [
            'title' => 'Produk',
            'menu' => 'produk',
            'submenu' => '',
            'kategori' => $kategori,
            'list_kategori' => KategoriProduk::all(),
            'list_produk' => $kategori->produk()->paginate(12),
        ];
        return view('front.pages.produk.category', $data);
    }
}

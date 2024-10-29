<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $data = [
            'title' => 'Cart',
            'description' => 'Cart page description',
            'keywords' => 'Cart page keywords',
        ];
        return view('front.pages.produk.cart', $data);
    }
    public function cartApi()
    {
        $userCart = Keranjang::where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->with('produk')->get();
        $userCart->map(function ($item) {
            $item->produk->image = $item->produk->getGambar();
            return $item;
        });
        $userCart->map(function ($item) {
            $item->total_price = number_format($item->produk->harga * $item->jumlah ,0,',','.');
        });
        $userCart->map(function ($item) {
            $item->produk->harga = number_format($item->produk->harga ,0,',','.');
            return $item;
        });

        $userCartCount = Keranjang::where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->count();
        $userCartTotal = Keranjang::where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->sum('jumlah');
        $userCartTotalPrice = Keranjang::where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->with('produk')->get()->sum(function ($item) {
            return $item->produk->harga * $item->jumlah;
        });

        return response()->json([
            'userCart' => $userCart,
            'userCartCount' => $userCartCount,
            'userCartTotal' => $userCartTotal,
            'userCartTotalPrice' => $userCartTotalPrice,
        ]);
    }

    public function removeCart($id)
    {
        $userCart = Keranjang::find($id);
        if (!$userCart) {
            return response()->json(['error' => 'Cart not found']);
        }
        $userCart->delete();
        return response()->json(['success' => 'Cart has been removed']);
    }


    public function addToCart(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'jumlah' => 'required',
        ]);

        $product = Produk::find($request->produk_id);
        if (!$product) {
            return response()->json(['error' => 'Product not found']);
        }

        $userCart = Keranjang::where('produk_id', $request->produk_id)->where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->first();
        if ($userCart) {
            $userCart->jumlah = $userCart->jumlah + $request->jumlah;
            $userCart->save();
        } else {
            $userCart = new Keranjang();
            $userCart->produk_id = $request->produk_id;
            $userCart->jumlah = $request->jumlah;
            $userCart->pembeli_id = Auth::user()->pembeli?->id_pembeli;
            $userCart->save();
        }
        return response()->json(['success' => 'Product has been added to cart']);
    }
}

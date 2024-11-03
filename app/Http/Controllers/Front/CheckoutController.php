<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {

        $data = [
            'title' => 'Checkout',
            'menu' => 'checkout',
            'submenu' => '',

            'list_keranjang' => Keranjang::where('pembeli_id', Auth::user()->pembeli->id_pembeli)->with('produk')->get(),
            'subtotal' => Keranjang::where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->with('produk')->get()->sum(function ($item) {
                return $item->produk->harga * $item->jumlah;
            }),
            'metode_pembayaran' => ['Transfer Bank', 'E-Wallet', 'Cash']
        ];
        // dd($data);
        return view('front.pages.checkout.index', $data);
    }
}

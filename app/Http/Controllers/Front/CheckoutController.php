<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'berat_total' => Keranjang::where('pembeli_id', Auth::user()->pembeli?->id_pembeli)->with('produk')->get()->sum(function ($item) {
                return $item->produk->berat * $item->jumlah;
            }),
            'list_metode_pembayaran' => MetodePembayaran::all()
        ];
        // dd($data);
        return view('front.pages.checkout.index', $data);
    }

    public function checkoutProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'metode_pembayaran' => 'required|exists:metode_pembayaran,id',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required',
            'no_hp' => 'required',
        ], [
            'metode_pembayaran.required' => 'Pilih metode pembayaran',
            'metode_pembayaran.exists' => 'Metode pembayaran tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'kota.required' => 'Kota wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'kode_pos.required' => 'Kode pos wajib diisi',
            'no_hp.required' => 'No HP wajib diisi',
        ]);
}

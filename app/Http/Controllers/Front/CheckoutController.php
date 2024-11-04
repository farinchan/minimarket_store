<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
            'total_harga_produk' => 'required|numeric',
            'pengiriman_provinsi' => 'required|string',
            'pengiriman_kota' => 'required|string',
            'pengiriman_alamat' => 'required|string',
            'pengiriman_kurir' => 'required|string',
            'pengiriman_ongkir' => 'required|numeric',
            'total_harga' => 'required|numeric',
            'metode_pembayaran_id' => 'required|exists:metode_pembayaran,id',
        ], [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
            'string' => ':attribute harus berupa huruf',
            'exists' => ':attribute tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Data tidak valid');
            return back()->withErrors($validator)->withInput();
        }

        $pemesanan = new Pemesanan();
        $pemesanan->pembeli_id = Auth::user()->pembeli->id_pembeli;
        $pemesanan->total_harga_produk = $request->total_harga_produk;
        $pemesanan->pengiriman_provinsi = $request->pengiriman_provinsi;
        $pemesanan->pengiriman_kota = $request->pengiriman_kota;
        $pemesanan->pengiriman_alamat = $request->pengiriman_alamat;
        $pemesanan->pengiriman_kurir = $request->pengiriman_kurir;
        $pemesanan->pengiriman_ongkir = $request->pengiriman_ongkir;
        $pemesanan->total_harga = $request->total_harga;
        $pemesanan->metode_pembayaran_id = $request->metode_pembayaran_id;
        $pemesanan->save();

        Keranjang::where('pembeli_id', Auth::user()->pembeli->id_pembeli)->delete();

        Alert::success('Success', 'Pemesanan berhasil');
        return redirect()->route('home');

    }
}

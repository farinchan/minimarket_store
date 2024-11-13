<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\KasirTransaksi;
use App\Models\KasirTransaksiItem;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kasir',
            'menu' => 'kasir',
            'submenu' => '',
            'list_kategori_produk' => KategoriProduk::all(),
        ];
        return view('back.pages.kasir.index', $data);
    }

    public function transaksiProcessAjax(Request $request)
    {
        $data = $request->data;

        $Kasir_transaksi = new KasirTransaksi();
        $Kasir_transaksi->kasir_id = Auth::user()->pegawai->id_pegawai;
        $Kasir_transaksi->total_harga = $data['total'];
        $Kasir_transaksi->bayar = $data['bayar'];
        $Kasir_transaksi->kembalian = $data['kembalian'];

        $Kasir_transaksi->save();

        foreach ($data['data'] as $produk) {
            $Kasir_transaksi_item = new KasirTransaksiItem();
            $Kasir_transaksi_item->kasir_transaksi_id = $Kasir_transaksi->id_transaksi;
            $Kasir_transaksi_item->produk_id = $produk['id_produk'];
            $Kasir_transaksi_item->jumlah = $produk['jumlah'];
            $Kasir_transaksi_item->harga = $produk['harga'];
            $Kasir_transaksi_item->total_harga = $produk['total_harga'];
            $Kasir_transaksi_item->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil disimpan',
        ]);
    }
}

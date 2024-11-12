<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pesanan',
            'menu' => 'pesanan',
            'submenu' => '',
            'list_pesanan' => Pemesanan::where('pembeli_id', Auth::user()->pembeli->id_pembeli)->get()
        ];
        return view('front.pages.pesanan.index', $data);
    }

    public function batalPesanan($id)
    {
        $pesanan = Pemesanan::find($id);
        if (!$pesanan) {
            Alert::error('Error', 'Pesanan tidak ditemukan');
            return redirect()->route('pesanan-saya')->with('error', 'Pesanan tidak ditemukan');
        }
        if ($pesanan->status != 'belum bayar') {
            Alert::error('Error', 'Pesanan tidak dapat dibatalkan');
            return redirect()->route('pesanan-saya')->with('error', 'Pesanan tidak dapat dibatalkan');
        }
        $pesanan->status = 'dibatalkan';
        $pesanan->save();
        Alert::success('Success', 'Pesanan berhasil dibatalkan');
        return redirect()->route('pesanan-saya')->with('success', 'Pesanan berhasil dibatalkan');
    }
}

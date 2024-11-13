<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function konfirmasiPembayaran(Request $request){
        $search = $request->input('q');
        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'menu' => 'Transaksi',
            'submenu' => 'Konfirmasi Pembayaran',
            'list_transaksi' => Pemesanan::with(['pembeli', 'metodePembayaran', 'pemesananItem', 'pembayaran'])->where('status', 'belum bayar')->whereHas('pembeli', function($query) use ($search){
                $query->where('nama', 'like', '%'.$search.'%');
            })->latest()->paginate(10)
        ];

        return view('back.pages.pemesanan.pembayaran', $data);
    }

    public function cancelPembayaran($id){
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update([
            'status' => 'dibatalkan'
        ]);

        Alert::success('Konfirmasi Pembayaran', 'Pembayaran dibatalkan');
        return redirect()->back();
    }

    public function konfirmasiPembayaranApprove($id_pembayaran){
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pembayaran->update([
            'status' => 'success'
        ]);

        $pemesanan = Pemesanan::findOrFail($pembayaran->pemesanan_id);
        $pemesanan->update([
            'status' => 'sedang diproses'
        ]);

        Alert::success('Konfirmasi Pembayaran', 'Pembayaran berhasil dikonfirmasi');
        return redirect()->back();
    }

    public function konfirmasiPembayaranReject($id_pembayaran){
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pembayaran->update([
            'status' => 'failed'
        ]);

        $pemesanan = Pemesanan::findOrFail($pembayaran->pemesanan_id);
        $pemesanan->update([
            'status' => 'belum bayar'
        ]);

        Alert::success('Konfirmasi Pembayaran', 'Pembayaran berhasil ditolak');
        return redirect()->back();
    }
}

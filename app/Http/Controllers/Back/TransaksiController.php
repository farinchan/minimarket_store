<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function konfirmasiPembayaran(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'menu' => 'Transaksi',
            'submenu' => 'Konfirmasi Pembayaran',
            'list_transaksi' => Pemesanan::with(['pembeli', 'metodePembayaran', 'pemesananItem', 'pembayaran'])->where('status', 'belum bayar')->whereHas('pembeli', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->latest()->paginate(10)
        ];

        return view('back.pages.pemesanan.pembayaran', $data);
    }

    public function cancelPembayaran($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update([
            'status' => 'dibatalkan'
        ]);

        Alert::success('Pembayaran', 'Pembayaran dibatalkan');
        return redirect()->back();
    }

    public function konfirmasiPembayaranApprove($id_pembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pembayaran->update([
            'status' => 'success'
        ]);

        $pemesanan = Pemesanan::findOrFail($pembayaran->pemesanan_id);
        $pemesanan->update([
            'status' => 'sedang diproses'
        ]);

        Alert::success('Pembayaran', 'Pembayaran berhasil dikonfirmasi');
        return redirect()->back();
    }

    public function konfirmasiPembayaranReject($id_pembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pembayaran->update([
            'status' => 'failed'
        ]);

        $pemesanan = Pemesanan::findOrFail($pembayaran->pemesanan_id);
        $pemesanan->update([
            'status' => 'belum bayar'
        ]);

        Alert::success('Pembayaran', 'Pembayaran berhasil ditolak');
        return redirect()->back();
    }

    public function diproses(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'Transaksi Diproses',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Diproses',
            'list_transaksi' => Pemesanan::with(['pembeli', 'metodePembayaran', 'pemesananItem', 'pembayaran'])->where('status', 'sedang diproses')->whereHas('pembeli', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->latest()->paginate(10)
        ];

        return view('back.pages.pemesanan.diproses', $data);
    }

    public function diprosesKirim(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'resi_pengiriman' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error('Pemesanan', 'Resi pengiriman harus diisi');
            return redirect()->back();
        }

        $pemesanan->update([
            'status' => 'dikirim',
            'resi_pengiriman' => $request->resi_pengiriman
        ]);

        Alert::success('Pemesanan', 'Pemesanan berhasil dikirim');
        return redirect()->back();
    }

    public function dikirim(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'Transaksi Dikirim',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Dikirim',
            'list_transaksi' => Pemesanan::with(['pembeli', 'metodePembayaran', 'pemesananItem', 'pembayaran'])->where('status', 'dikirim')->whereHas('pembeli', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->latest()->paginate(10)
        ];

        return view('back.pages.pemesanan.dikirim', $data);
    }

    public function dikirimSelesai($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update([
            'status' => 'selesai'
        ]);

        Alert::success('Pemesanan', 'Pemesanan berhasil diselesaikan');
        return redirect()->back();
    }

    public function selesai(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'Transaksi Selesai',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Selesai',
            'list_transaksi' => Pemesanan::with(['pembeli', 'metodePembayaran', 'pemesananItem', 'pembayaran'])->where('status', 'selesai')->whereHas('pembeli', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->latest()->paginate(10)
        ];

        return view('back.pages.pemesanan.selesai', $data);
    }

    public function dibatalkan(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'Transaksi Dibatalkan',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Dibatalkan',
            'list_transaksi' => Pemesanan::with(['pembeli', 'metodePembayaran', 'pemesananItem', 'pembayaran'])->where('status', 'dibatalkan')->whereHas('pembeli', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->latest()->paginate(10)
        ];

        return view('back.pages.pemesanan.dibatalkan', $data);
    }
}

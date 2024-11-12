<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pesanan',
            'menu' => 'pesanan',
            'submenu' => '',
            'list_pesanan' => Pemesanan::where('pembeli_id', Auth::user()->pembeli->id_pembeli)->latest()->paginate(5),
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

    public function cetakInvoice($id)
    {
        $pesanan = Pemesanan::find($id);
        if (!$pesanan) {
            Alert::error('Error', 'Pesanan tidak ditemukan');
            return redirect()->route('pesanan-saya')->with('error', 'Pesanan tidak ditemukan');
        }
        $data = [
            'title' => 'Invoice',
            'menu' => 'pesanan',
            'submenu' => '',
            'pesanan' => $pesanan
        ];
        $pdf = Pdf::loadView('front.pages.pesanan.invoice_pdf', $data);

        // return $pdf->stream();

        return $pdf->download('invoice-#' . $pesanan->id_pemesanan .' (' . Auth::user()->pembeli?->nama . ').pdf');
    }

    public function pembayaranStore($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diisi',
            'bukti_pembayaran.image' => 'Bukti pembayaran harus berupa gambar',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berformat jpg, jpeg, png',
            'bukti_pembayaran.max' => 'Bukti pembayaran maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        $pesanan = Pemesanan::find($id);
        if (!$pesanan) {
            Alert::error('Error', 'Pesanan tidak ditemukan');
            return redirect()->route('pesanan-saya')->with('error', 'Pesanan tidak ditemukan');
        }

        if ($pesanan->status != 'belum bayar') {
            Alert::error('Error', 'Pesanan tidak dapat dibayar');
            return redirect()->route('pesanan-saya')->with('error', 'Pesanan tidak dapat dibayar');
        }

        $file = $request->file('bukti_pembayaran');
        $file_name = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file_path =  $file->storeAs('bukti_pembayaran', $file_name, 'public');

        $pembayaran = new Pembayaran();
        $pembayaran->pemesanan_id = $pesanan->id_pemesanan;
        $pembayaran->metode_pembayaran = "transfer";
        $pembayaran->bukti_pembayaran = $file_path;
        $pembayaran->status = 'pending';
        $pembayaran->save();

        Alert::success('Success', 'Terimakasih, bukti pembayaran berhasil diupload, silahkan tunggu konfirmasi dari admin');
        return redirect()->route('pesanan-saya')->with('success', 'Bukti pembayaran berhasil diupload');

    }
}

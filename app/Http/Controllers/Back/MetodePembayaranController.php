<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Metode Pembayaran',
            'menu' => 'Manajemen Pembayaran',
            'submenu' => 'Metode Pembayaran',
            'metode_pembayaran'=> MetodePembayaran::all(),
        ];
        // dd($data);
        return view('back.pages.metode_pembayaran.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rek' => 'required',
            'no_rek' => 'required',
            'bank' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak lengkap');
            return redirect()->back();
        }

        $metode_pembayaran = new MetodePembayaran();
        $metode_pembayaran->nama_rek = $request->nama_rek;
        $metode_pembayaran->no_rek = $request->no_rek;
        $metode_pembayaran->bank = $request->bank;
        $metode_pembayaran->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->back();

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_rek' => 'required',
            'no_rek' => 'required',
            'bank' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak lengkap');
            return redirect()->back();
        }

        $metode_pembayaran = MetodePembayaran::find($id);
        $metode_pembayaran->nama_rek = $request->nama_rek;
        $metode_pembayaran->no_rek = $request->no_rek;
        $metode_pembayaran->bank = $request->bank;
        $metode_pembayaran->save();

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $metode_pembayaran = MetodePembayaran::find($id);
        $metode_pembayaran->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }
}

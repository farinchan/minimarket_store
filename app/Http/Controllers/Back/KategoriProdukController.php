<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Produk',
            'menu' => 'Produk',
            'submenu' => 'Kategori',
            'list_kategori' => KategoriProduk::all(),
        ];
        // dd($data);
        return view('back.pages.produk.kategori', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak lengkap');
            return redirect()->back();
        }

        $kategori = new KategoriProduk();
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak lengkap');
            return redirect()->back();
        }

        $kategori = KategoriProduk::find($id);
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->save();

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $kategori = KategoriProduk::find($id);
        $kategori->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }
}

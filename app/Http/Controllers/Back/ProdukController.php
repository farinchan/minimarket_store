<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Produk',
            'menu' => 'Produk',
            'submenu' => '',
            'list_produk' => Produk::all(),
        ];

        return view('back.pages.produk.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'menu' => 'Produk',
            'submenu' => '',
            'kategori_produk' => KategoriProduk::all(),
        ];

        return view('back.pages.produk.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'kategori_produk_id' => 'required',
        ],[
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute harus berupa angka',
            'max' => ':attribute maksimal :max karakter',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format jpeg, png, jpg, gif, atau svg',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak lengkap');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->berat = $request->berat;
        $produk->kategori_produk_id = $request->kategori_produk_id;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filePath = $file->storeAs('produk', time() . '.' . $file->getClientOriginalExtension(), 'public');
            $produk->gambar = $filePath;
        }

        $produk->save();

        Alert::success('Berhasil', 'Produk berhasil disimpan');
        return redirect()->route('back.produk.index');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Produk',
            'menu' => 'Produk',
            'submenu' => '',
            'produk' => Produk::find($id),
            'kategori_produk' => KategoriProduk::all(),

        ];

        return view('back.pages.produk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'kategori_produk_id' => 'required',
        ],[
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute harus berupa angka',
            'max' => ':attribute maksimal :max karakter',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format jpeg, png, jpg, gif, atau svg',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak lengkap');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produk = Produk::find($id);
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->berat = $request->berat;
        $produk->kategori_produk_id = $request->kategori_produk_id;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filePath = $file->storeAs('produk', time() . '.' . $file->getClientOriginalExtension(), 'public');
            $produk->gambar = $filePath;
        }

        $produk->save();

        Alert::success('Berhasil', 'Produk berhasil diubah');
        return redirect()->route('back.produk.index');
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        Storage::delete('public/' . $produk->gambar);
        $produk->delete();

        Alert::success('Berhasil', 'Produk berhasil dihapus');
        return redirect()->back();
    }
}

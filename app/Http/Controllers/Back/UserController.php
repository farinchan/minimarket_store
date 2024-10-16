<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembeli;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function Pembeli()
    {
        $data = [
            'title' => 'Daftar Pengguna Biasa',
            'menu' => 'Manajemen Pengguna',
            'submenu' => 'Pengguna Biasa',
            'users' => User::with('pembeli')->has('pembeli')->latest()->get(),
        ];
        // dd($data);
        // return response()->json($data);
        return view('back.pages.pengguna.pembeli', $data);
    }

    public function pembeliStore(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'alamat' => 'nullable',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'unique' => ':attribute sudah terdaftar',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berformat jpeg, png, jpg, gif, svg',
            'max' => ':attribute maksimal 2MB',
            'min' => ':attribute minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back()->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $pembeli = new Pembeli();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filePath = $file->storeAs('uploads/pengguna/', time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension(), 'public');
            $pembeli->foto = $filePath;
        }
        $pembeli->nama = $request->name;
        $pembeli->jenis_kelamin = $request->jenis_kelamin;
        $pembeli->no_telp = $request->no_telp;
        $pembeli->alamat = $request->alamat;
        $pembeli->user_id = $user->id;
        $pembeli->save();

        Alert::success('Berhasil', 'Pengguna berhasil ditambahkan');
        return redirect()->route('back.pengguna.pembeli');

    }

    public function pembeliUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'alamat' => 'nullable',
            'password' => 'nullable|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'unique' => ':attribute sudah terdaftar',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berformat jpeg, png, jpg, gif, svg',
            'max' => ':attribute maksimal 2MB',
            'min' => ':attribute minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back()->withInput()->withErrors($validator);
        }

        $user = User::find($id);
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $pembeli = $user->Pembeli;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filePath = $file->storeAs('uploads/pengguna/', time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension(), 'public');
            $pembeli->foto = $filePath;
        }
        $pembeli->nama = $request->name;
        $pembeli->jenis_kelamin = $request->jenis_kelamin;
        $pembeli->no_telp = $request->no_telp;
        $pembeli->alamat = $request->alamat;
        $pembeli->save();

        Alert::success('Berhasil', 'Pengguna berhasil diubah');
        return redirect()->route('back.pengguna.pembeli')->with('success', 'Pengguna berhasil diubah');
    }

    public function pembeliDestroy($id)
    {
        $user = User::find($id);
        pembeli::where('user_id', $id)->delete();
        $user->delete();

        Alert::success('Berhasil', 'Pengguna berhasil dihapus');
        return redirect()->route('back.pengguna.pembeli')->with('success', 'Pengguna berhasil dihapus');
    }

    public function pegawai()
    {
        $data = [
            'title' => 'Daftar Pegawai',
            'menu' => 'Manajemen Pengguna',
            'submenu' => 'Pegawai',
            'users' => User::with('pegawai')->has('pegawai')->latest()->get(),
        ];
        return view('back.pages.pengguna.pegawai', $data);
    }

    public function pegawaiStore(Request $request)
    {
        // dd($request->all());
        $validator= Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'jenis_kelamin' => 'required',
            'no_telp' => 'nullable',
            'alamat' => 'nullable',
            'jabatan' => 'nullable',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'unique' => ':attribute sudah terdaftar',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berformat jpeg, png, jpg, gif, svg',
            'max' => ':attribute maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back()->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if($request->role_pegawai){
            $user->assignRole('pegawai');
        }

        if($request->role_admin_kepegawaian){
            $user->assignRole('admin kepegawaian');
        }

        if($request->role_admin_super){
            $user->assignRole('admin super');
        }

        if($request->role_admin_jual_beli){
            $user->assignRole('admin jual beli');
        }


        $pegawai = new Pegawai();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filePath = $file->storeAs('uploads/pengguna/', time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension(), 'public');
            $pegawai->foto = $filePath;
        }
        $pegawai->nama = $request->name;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->user_id = $user->id;
        $pegawai->save();

        Alert::success('Berhasil', 'Pegawai berhasil ditambahkan');
        return redirect()->route('back.pengguna.pegawai');
    }

    public function pegawaiUpdate(Request $request, $id)
    {
        $validator= Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'jenis_kelamin' => 'required',
            'no_telp' => 'nullable',
            'alamat' => 'nullable',
            'jabatan' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'unique' => ':attribute sudah terdaftar',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berformat jpeg, png, jpg, gif, svg',
            'max' => ':attribute maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back()->withInput()->withErrors($validator);
        }

        $user = User::find($id);
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if($request->role_pegawai){
            $user->assignRole('pegawai');
        }else{
            $user->removeRole('pegawai');
        }

        if($request->role_admin_kepegawaian){
            $user->assignRole('admin kepegawaian');
        }else{
            $user->removeRole('admin kepegawaian');
        }

        if($request->role_admin_super){
            $user->assignRole('admin super');
        }else{
            $user->removeRole('admin super');
        }

        if($request->role_admin_jual_beli){
            $user->assignRole('admin jual beli');
        }else{
            $user->removeRole('admin jual beli');
        }

        $pegawai = $user->pegawai;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filePath = $file->storeAs('uploads/pengguna/', time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension(), 'public');
            $pegawai->foto = $filePath;
        }
        $pegawai->nama = $request->name;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->save();

        Alert::success('Berhasil', 'Pegawai berhasil diubah');
        return redirect()->route('back.pengguna.pegawai');
    }

    public function pegawaiDestroy($id)
    {
        $user = User::find($id);
        Pegawai::where('user_id', $id)->delete();
        $user->delete();

        Alert::success('Berhasil', 'Pegawai berhasil dihapus');
        return redirect()->route('back.pengguna.pegawai');
    }
}

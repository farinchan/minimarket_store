<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\KasirTransaksi;
use App\Models\KasirTransaksiItem;
use App\Models\Pegawai;
use App\Models\Pembeli;
use App\Models\Pemesanan;
use App\Models\PemesananItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'submenu' => '',
            'pembeli_count' => Pembeli::count(),
            'pembeli_all' => Pembeli::latest()->limit(8)->get(),
            'transaksi_online' => Pemesanan::where('status', '!=', 'belum bayar')->where('status', '!=', 'dibatalkan')->sum('total_harga_produk'),
            'transaksi_offline' => KasirTransaksi::sum('total_harga'),
            'transaksi_item_count' => PemesananItem::whereHas('pemesanan', function ($query) {
                $query->where('status', '!=', 'belum bayar')->where('status', '!=', 'dibatalkan');
            })->sum('jumlah') + KasirTransaksiItem::sum('jumlah'),

        ];
        return view('back.pages.dashboard.index', $data);
    }

    public function ajaxDashboard()
    {
        $data = [
            'mingguan' => [
                'transaksi_online' => Pemesanan::where('status', '!=', 'belum bayar')->where('status', '!=', 'dibatalkan')
                    ->selectRaw('sum(total_harga_produk) as total, DAYNAME(created_at) as day')
                    ->orderBy('day', 'asc')
                    ->groupBy('day')
                    ->get()
                    ->keyBy('day')
                    ->union(collect([
                        (object)['day' => 'Monday', 'total' => 0],
                        (object)['day' => 'Tuesday', 'total' => 0],
                        (object)['day' => 'Wednesday', 'total' => 0],
                        (object)['day' => 'Thursday', 'total' => 0],
                        (object)['day' => 'Friday', 'total' => 0],
                        (object)['day' => 'Saturday', 'total' => 0],
                        (object)['day' => 'Sunday', 'total' => 0],
                    ])->keyBy('day'))
                    ->values(),
                'transaksi_offline' => KasirTransaksi::selectRaw('sum(total_harga) as total, DAYNAME(created_at) as day')
                    ->orderBy('day', 'asc')
                    ->groupBy('day')
                    ->get()
                    ->keyBy('day')
                    ->union(collect([
                        (object)['day' => 'Monday', 'total' => 0],
                        (object)['day' => 'Tuesday', 'total' => 0],
                        (object)['day' => 'Wednesday', 'total' => 0],
                        (object)['day' => 'Thursday', 'total' => 0],
                        (object)['day' => 'Friday', 'total' => 0],
                        (object)['day' => 'Saturday', 'total' => 0],
                        (object)['day' => 'Sunday', 'total' => 0],
                    ])->keyBy('day'))
                    ->values(),
            ],
            'transaksi_online_bulanan' => Pemesanan::where('status', '!=', 'belum bayar')->where('status', '!=', 'dibatalkan')
                ->selectRaw('sum(total_harga_produk) as total, DATE(created_at) as date')
                ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),
            'item_online_bulanan' => PemesananItem::whereHas('pemesanan', function ($query) {
                $query->where('status', '!=', 'belum bayar')->where('status', '!=', 'dibatalkan');
            })->selectRaw('sum(jumlah) as total, DATE(created_at) as date')
                ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),
            'transaksi_offline_bulanan' => KasirTransaksi::selectRaw('sum(total_harga) as total, DATE(created_at) as date')
                ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),
            'item_offline_bulanan' => KasirTransaksiItem::selectRaw('sum(jumlah) as total, DATE(created_at) as date')
                ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),
        ];
        return response()->json($data);
    }

    public function profileEdit()
    {

        $data = [
            'title' => 'Edit Profile',
            'menu' => 'Profile',
            'submenu' => '',
        ];

        return view('back.pages.dashboard.profile_edit', $data);
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            // 'tempat_lahir' => 'required|string|max:255',
            // 'tanggal_lahir' => 'required|date',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|string|min:8',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter',
            'in' => ':attribute harus L atau P',
            'date' => ':attribute harus tanggal',
            'email' => ':attribute harus email',
            'unique' => ':attribute sudah terdaftar',
            'image' => ':attribute harus gambar',
            'mimes' => ':attribute harus berformat jpg, jpeg, png',
            'min' => ':attribute minimal :min karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal diperbarui');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $pegawai = Pegawai::where('user_id', Auth::user()->id)->first();
        $pegawai->nama = $request->nama;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        // $pegawai->tempat_lahir = $request->tempat_lahir;
        // $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filePath = $foto->storeAs('uploads/pengguna/', time() . '_' . Str::slug($request->nama) . '.' . $foto->getClientOriginalExtension(), 'public');
            $pegawai->foto = $filePath;
        }
        $pegawai->save();


        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->back();
    }
}

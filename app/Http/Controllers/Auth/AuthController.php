<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;



class AuthController extends Controller
{
    public function login()
    {
        return view('front.pages.auth.login');
    }

    public function loginProcess(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'string' => ':attribute harus berupa string'
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('pembeli')) {
                Alert::success('Selamat datang', 'Selamat datang ' . Auth::user()->pembeli->nama);
                return redirect()->route('home');
            }else{
                return redirect()->route('back.dashboard');
            }
        }

        Alert::error('Error', 'Email atau password salah');
        return back();
    }

    public function register()
    {
        return view('front.pages.auth.register');
    }

    public function registerProcess(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'unique' => ':attribute sudah terdaftar',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berformat jpg, jpeg, png',
            'max' => ':attribute maksimal 2MB',
            'in' => ':attribute harus Laki-laki atau Perempuan'
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back()->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole('pembeli');

        $pembeli = Pembeli::create([
            'nama' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->storeAs('foto_pembeli', $user->id . "-" . Str::slug($request->name) . '.' . $request->file('foto')->getClientOriginalExtension(), 'public') : null,
            'user_id' => $user->id
        ]);


        Auth::loginUsingId($user->id);

        Mail::send('email.register_mail', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Registrasi Berhasil');
        });

        Alert::success('Success', 'Registrasi berhasil, selamat datang ' . $pembeli->nama);
        return redirect()->route('home');

    }
    public function forgetPasswordProcess(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ],[
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid'
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back();
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            $token = Uuid::uuid4();
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token
            ]);
            Mail::send('email.forget_password', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            Alert::success('Success', 'Email reset password telah dikirim');
            return back();
        }
        Alert::error('Error', 'Email tidak ditemukan');
        return back();
    }

    public function resetPassword($token)
    {
        $cekToken = DB::table('password_reset_tokens')->where('token', '=', $token)->first();

        if ($cekToken) {
            $data = [
                'user' => User::where('email', $cekToken->email)->firstOrFail(),
                'token' => $token
            ];
            return view('front.pages.auth.reset_password', $data);
        }
        return redirect()->route('home');
    }

    public function resetPasswordProcess(Request $request, $token)
    {
        $updatePassword = DB::table('password_reset_tokens')->where(['token' => $token])->first();
        if (!$updatePassword) {
            Alert::error('Error', 'Token tidak valid');
            return redirect()->route('home');
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ], [
            'required' => ':attribute harus diisi'
        ]);

        if ($validator->fails()) {
            Alert::error('Validator Error', $validator->errors()->all());
            return back();
        }

        User::where('email', $updatePassword->email)->update([
            'password' => bcrypt($request->password)
        ]);
        DB::table('password_reset_tokens')->where(['token' => $token])->delete();
        Alert::success('Success', 'Password berhasil direset');
        return redirect()->route('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use App\Models\Pegawai;
use App\Models\Pembeli;
use App\Models\Produk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'admin super']);
        Role::create(['name' => 'admin jual beli']);
        Role::create(['name' => 'admin kepegawaian']);
        Role::create(['name' => 'pegawai']);
        Role::create(['name' => 'pembeli']);

        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'email' => "pembeli" . $i . "@example.com",
                'password' => bcrypt('password'),
            ]);

            $user->assignRole('pembeli');

            pembeli::factory()->create([
                'user_id' => $user->id,
            ]);
        }



        $user = User::create([
            'email' => 'fajri@gariskode.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin super');
        $user->assignRole('pegawai');

        Pegawai::create([
            'nama' => 'Fajri Rinaldi Chan',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Garuda No. 1',
            'no_telp' => '081234567890',
            'jabatan' => 'Chief Executive Officer',
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'email' => 'adminjualbeli@gariskode.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin jual beli');
        $user->assignRole('pegawai');

        Pegawai::create([
            'nama' => 'Fulan bin Fulan',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Garuda No. 2',
            'no_telp' => '081234567891',
            'jabatan' => 'Marketing Manager',
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'email' => 'adminkepegawaian@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin kepegawaian');
        $user->assignRole('pegawai');

        Pegawai::create([
            'nama' => 'Fulanah binti Fulan',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jl. Garuda No. 3',
            'no_telp' => '081234567892',
            'jabatan' => 'Human Resource Development',
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'email' => 'pegawai1@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('pegawai');

        Pegawai::create([
            'nama' => 'Pegawai 1',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Garuda No. 4',
            'no_telp' => '081234567893',
            'jabatan' => 'Staff Marketing',
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'email' => 'pegawai2@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('pegawai');

        Pegawai::create([
            'nama' => 'Pegawai 2',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jl. Garuda No. 5',
            'no_telp' => '081234567894',
            'jabatan' => 'Staff Marketing',
            'user_id' => $user->id,
        ]);

        KategoriProduk::create(['nama' => 'Makanan Ringan', 'deskripsi' => 'Makanan yang biasa disantap di waktu senggang']);
        KategoriProduk::create(['nama' => 'Minuman', 'deskripsi' => 'Minuman yang menyegarkan']);
        KategoriProduk::create(['nama' => 'Deterjen', 'deskripsi' => 'Pembersih pakaian']);
        KategoriProduk::create(['nama' => 'Sabun Mandi', 'deskripsi' => 'Pembersih tubuh']);
        KategoriProduk::create(['nama' => 'Sabun Cuci Piring', 'deskripsi' => 'Pembersih peralatan makan']);
        KategoriProduk::create(['nama' => 'Pasta Gigi', 'deskripsi' => 'Pembersih gigi']);
        KategoriProduk::create(['nama' => 'Shampoo', 'deskripsi' => 'Pembersih rambut']);
        KategoriProduk::create(['nama' => 'Pembersih Lantai', 'deskripsi' => 'Pembersih lantai']);
        KategoriProduk::create(['nama' => 'Pembersih Kamar Mandi', 'deskripsi' => 'Pembersih kamar mandi']);

        Produk::create([
            'nama' => 'Chitato Rasa Ayam Bakar 50gr',
            'deskripsi' => 'Makanan ringan berbentuk keripik',
            'harga' => 5000,
            'stok' => 100,
            'berat' => 50,
            'kategori_produk_id' => 1,
        ]);

        Produk::create([
            'nama' => 'Teh Botol Sosro 500ml',
            'deskripsi' => 'Minuman teh dalam botol',
            'harga' => 5000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 2,
        ]);

        Produk::create([
            'nama' => 'Sunsilk Hijab 70ml',
            'deskripsi' => 'Shampoo untuk rambut',
            'harga' => 1000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 7,
        ]);

        Produk::create([
            'nama' => 'Lifebuoy 100gr',
            'deskripsi' => 'Sabun mandi',
            'harga' => 4000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 4,
        ]);

        Produk::create([
            'nama' => 'Sensodyne 50gr',
            'deskripsi' => 'Pasta gigi untuk gigi sensitif',
            'harga' => 8000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 6,
        ]);

        Produk::create([
            'nama' => 'Rinso 100gr',
            'deskripsi' => 'Deterjen untuk pakaian',
            'harga' => 1000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 3,
        ]);

        Produk::create([
            'nama' => 'Sunlight 100gr',
            'deskripsi' => 'Sabun cuci piring',
            'harga' => 3000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 5,
        ]);

        Produk::create([
            'nama' => 'Mr. Muscle 100gr',
            'deskripsi' => 'Pembersih lantai',
            'harga' => 5000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 8,
        ]);

        Produk::create([
            'nama' => 'Harpic 100gr',
            'deskripsi' => 'Pembersih kamar mandi',
            'harga' => 5000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 9,
        ]);

        Produk::create([
            'nama' => 'Pepsodent 50gr',
            'deskripsi' => 'Pasta gigi',
            'harga' => 5000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 6,
        ]);

        Produk::create([
            'nama' => 'Dove 100gr',
            'deskripsi' => 'Sabun mandi',
            'harga' => 1000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 4,
        ]);

        Produk::create([
            'nama' => 'Kapal Api 50gr',
            'deskripsi' => 'Kopi instan',
            'harga' => 2000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 2,
        ]);

        Produk::create([
            'nama' => 'Kratingdaeng 250ml',
            'deskripsi' => 'Minuman energi',
            'harga' => 8000,
            'stok' => 100,
            'berat' => 500,
            'kategori_produk_id' => 2,
        ]);

    }
}

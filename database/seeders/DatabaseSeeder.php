<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Pembeli;
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

    }
}

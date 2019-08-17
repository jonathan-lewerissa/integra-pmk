<?php

use App\Mahasiswa;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'username' => 'admin',
           'email' => 'admin@admin.com',
           'password' => bcrypt('secret'),
        ])->assignRole('admin');

        User::create([
           'username' => 'alumni',
           'email' => 'alumni@admin.com',
           'password' => bcrypt('secret'),
        ])->assignRole('alumni');

        User::create([
            'username' => 'dosen',
            'email' => 'dosen@admin.com',
            'password' => bcrypt('secret'),
        ])->assignRole('dosen');

        User::create([
           'username' => '05111640000105',
           'email' => 'jonathan@test.com',
           'password' => bcrypt('secret'),
        ])->assignRole(['persekutuan', 'dpk']);

        Mahasiswa::create([
            'nrp' => '05111640000105',
            'nama' => 'Jonathan',
            'departemen' => 'S1 Informatika',
            'jenis_kelamin' => 'L',
            'status' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'nrp' => '05111640000106',
            'nama' => 'Jonathan',
            'departemen' => 'S1 Informatika',
            'jenis_kelamin' => 'L',
            'status' => 'mahasiswa',
            'pkk_id' => '05111640000105',
        ]);

        Mahasiswa::create([
            'nrp' => '05111640000107',
            'nama' => 'Jonathan',
            'departemen' => 'S1 Informatika',
            'jenis_kelamin' => 'L',
            'status' => 'mahasiswa',
            'pkk_id' => '05111640000105',
        ]);
    }
}

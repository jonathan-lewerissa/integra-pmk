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
        ]);

        User::create([
           'username' => '05111640000105',
           'email' => 'jonathan@test.com',
           'password' => bcrypt('secret'),
        ]);

        Mahasiswa::create([
            'nrp' => '05111640000105',
            'nama' => 'Jonathan',
            'status' => 'mahasiswa',
        ]);
    }
}

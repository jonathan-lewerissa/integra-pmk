<?php

namespace App\Imports;

use App\Mahasiswa;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $mahasiswas = Mahasiswa::all();

        foreach ($collection as $row) {
            $mahasiswa = $mahasiswas->first(function ($item) use ($row) {
                return $item->nrp == $row['nrp'];
            });

            $tanggal_lahir = array();
            preg_match('/([0-9]*).([0-9]*).([0-9]*)/', $row['tanggal_lahir'], $tanggal_lahir);

            $row['tanggal_lahir'] = $tanggal_lahir[3].'-'.$tanggal_lahir[2].'-'.$tanggal_lahir[1];

            if($mahasiswa) {
                $mahasiswa->fill([
                    'nrp' => $row['nrp'],
                    'nama' => $row['nama'],
                    'departemen' => $row['departemen'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'alamat_asal' => $row['alamat_asal'],
                    'alamat_surabaya' => $row['alamat_surabaya'],
                    'hp' => $row['hp'],
                    'email' => $row['email'],
                    'status' => $row['status'],
                    'jalur' => $row['jalur'],
                ]);
                $mahasiswa->save();
            } else {
                Mahasiswa::create([
                    'nrp' => $row['nrp'],
                    'nama' => $row['nama'],
                    'departemen' => $row['departemen'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'alamat_asal' => $row['alamat_asal'],
                    'alamat_surabaya' => $row['alamat_surabaya'],
                    'hp' => $row['hp'],
                    'email' => $row['email'],
                    'status' => $row['status'],
                    'jalur' => $row['jalur'],
                ]);

                User::create([
                    'username' => $row['nrp'],
                    'email' => $row['email'],
                    'password' => Hash::make($row['nrp']),
                ])->assignRole('mahasiswa');
            }
        }
    }
}

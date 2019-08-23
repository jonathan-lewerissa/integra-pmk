<?php

namespace App\Imports;

use App\Mahasiswa;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
//        $mahasiswas = Mahasiswa::get('nrp')->map(function ($item, $key) {
//            return $item->nrp;
//        })->toArray();

        $new_mahasiswa = array();
        $new_user = array();

        foreach ($collection as $row) {
            if(0) {
                continue;
            } else {
                array_push($new_mahasiswa, [
                    'nrp' => $row['nrp'],
                    'nama' => $row['nama'],
                    'departemen' => $row['departemen'],
                    'angkatan' => $row['angkatan'],
                    'tanggal_lahir' => $row['tanggal_lahir'] ? Carbon::createFromFormat('d.m.Y', $row['tanggal_lahir']) : null,
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'alamat_asal' => $row['alamat_asal'],
                    'alamat_surabaya' => $row['alamat_surabaya'],
                    'hp' => $row['hp'],
                    'email' => $row['email'],
                    'jalur' => $row['jalur'],
                ]);

                array_push($new_user, [
                    'username' => $row['nrp'],
                    'email' => $row['email'],
                    'password' => bcrypt($row['nrp']),
                ]);

                if(count($new_mahasiswa) >= 50) {
//                    Mahasiswa::insert($new_mahasiswa);
//                    User::insert($new_user);

                    $new_mahasiswa = array();
                    $new_user = array();
                }
            }
        }

//        if(count($new_mahasiswa)) {
//            Mahasiswa::insert($new_mahasiswa);
//            User::insert($new_user);
//        }
    }
}

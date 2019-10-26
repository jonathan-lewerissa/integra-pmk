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

                if(isset($row['tanggal_lahir']) && strlen($row['tanggal_lahir']) == 10) {
                    $datum = Carbon::createFromFormat('d.m.Y', $row['tanggal_lahir']);
                } elseif(isset($row['tanggal_lahir'])) {
                    $datum = Carbon::createFromFormat('d-m-y', $row['tanggal_lahir']);
                }

                array_push($new_mahasiswa, [
                    'nrp' => $row['nrp'],
                    'nama' => $row['nama'],
                    'departemen' => $row['departemen'],
                    'angkatan' => $row['angkatan'],
                    'tanggal_lahir' => $row['tanggal_lahir'] ? $datum : null,
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
            }
        }

        if(count($new_mahasiswa)) {
            Mahasiswa::insert($new_mahasiswa);
            User::insert($new_user);
        }
    }
}

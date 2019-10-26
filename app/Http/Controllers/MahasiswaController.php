<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use App\Mahasiswa;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::cursor();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(string $nrp)
    {
        $mahasiswa = Mahasiswa::where('nrp',$nrp)->first();
        $mahasiswa = $mahasiswa->makeHidden(['id', 'pkk_id', 'created_at', 'updated_at'])->toArray();

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function importExcel(Request $request)
    {

        DB::beginTransaction();
        $mahasiswas = (new FastExcel)->import($request->file('excel'), function ($row) {

            if(isset($row['Tanggal Lahir']) && strlen($row['Tanggal Lahir']) == 10) {
                $datum = Carbon::createFromFormat('d.m.Y', $row['Tanggal Lahir']);
            } elseif(isset($row['Tanggal Lahir']) && strlen($row['Tanggal Lahir']) == 8) {
                $datum = Carbon::createFromFormat('d-m-y', $row['Tanggal Lahir']);
            }

            return Mahasiswa::firstOrCreate([
                'nrp' => $row['NRP'],
                'nama' => $row['Nama'],
                'departemen' => $row['Departemen'],
                'angkatan' => $row['Angkatan'],
                'tanggal_lahir' => $row['Tanggal Lahir'] ? $datum : null,
                'jenis_kelamin' => $row['Jenis Kelamin'],
                'alamat_asal' => $row['Alamat Asal'],
                'alamat_surabaya' => $row['Alamat Surabaya'],
                'hp' => $row['HP'],
                'email' => $row['Email'],
                'jalur' => $row['Jalur'],
            ]);
        });
        DB::commit();

        return back();
    }
}

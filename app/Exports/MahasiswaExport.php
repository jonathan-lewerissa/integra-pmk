<?php

namespace App\Exports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MahasiswaExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::get(['nrp', 'nama', 'departemen',
            'tanggal_lahir', 'jenis_kelamin', 'alamat_asal',
            'alamat_surabaya', 'hp', 'email', 'status', 'jalur']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NRP',
            'Nama',
            'Departemen',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat Asal',
            'Alamat Surabaya',
            'HP',
            'Email',
            'Status',
            'Jalur',
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class   =>  function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:K1')
                    ->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB(Color::COLOR_YELLOW);
            },
        ];
    }
}

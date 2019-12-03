<?php

namespace App\Exports;

use App\Event;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EventAttendancesExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    private $event;
    private $attendees;

    public function __construct(Event $event, Collection $attendees)
    {
        $this->event = $event;
        $this->attendees = $attendees;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->attendees;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        if($this->event->type == 'Mahasiswa') {
            return [
                'NRP',
                'Nama',
                'Created at',
            ];
        } else {
            return [
                'Nama',
                'Asal',
                'Created at',
            ];
        }
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        if($this->event->type == 'Mahasiswa') {
            return [
                $row->nrp,
                ($row->mahasiswa) ? $row->mahasiswa->nama : '-',
                Date::dateTimeToExcel($row->created_at),
            ];
        } else {
            return [
                $row->nama,
                $row->asal,
                Date::dateTimeToExcel($row->created_at),
            ];
        }
    }
}

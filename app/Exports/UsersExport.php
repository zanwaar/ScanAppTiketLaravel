<?php

namespace App\Exports;

use App\Models\Etiket;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function map($row): array
    {
        return [
            $row->barcode,
            $row->nocode,
            $row->jenis,
            $row->ket,
        ];
    }

    public function headings(): array
    {
        return [
            '#Barcode',
            'No Tiket',
            'Jenis',
            'Deskripsi',
        ];
    }

    public function query()
    {
        return Etiket::latest()->where(['status' => 1]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}

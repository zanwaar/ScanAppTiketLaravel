<?php

namespace App\Imports;

use App\Models\Etiket;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EtiketImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new etiket([
            'barcode' => $row['barcode'],
            'nocode' => $row['nocode'],
            'jenis' => $row['jenis'],
            'status' => 0,
            'ket' => '',
        ]);
    }
}

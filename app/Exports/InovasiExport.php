<?php

namespace App\Exports;

use App\Models\Inovasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class InovasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inovasi::all();
    }
}

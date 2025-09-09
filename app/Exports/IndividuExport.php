<?php

namespace App\Exports;

use App\Models\Individu;
use Maatwebsite\Excel\Concerns\FromCollection;

class IndividuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Individu::all();
    }
}

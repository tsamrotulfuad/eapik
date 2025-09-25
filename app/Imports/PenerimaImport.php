<?php

namespace App\Imports;

use App\Models\Individu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PenerimaImport implements ToCollection
{
    public array $individuIds = [];
    public array $notFound = [];

    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) { // skip header
            $nik = trim($row[0] ?? '');

            if ($nik) {
                $individu = Individu::where('nik', $nik)->first();
                if ($individu) {
                    $this->individuIds[] = $individu->id;
                } else {
                    $this->notFound[] = $nik;
                }
            }
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Individu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenerimaImport implements ToCollection, WithHeadingRow
{
    protected $bantuanId;

    public function __construct($bantuanId)
    {
        $this->bantuanId = $bantuanId;
    }

    public function collection(Collection $rows)
    {
         foreach ($rows as $row) {
            if (!isset($row['nama']) || !isset($row['nik'])) {
                continue; // skip baris kosong
            }

            // buat / update individu
            $individu = Individu::firstOrCreate(
                ['nik' => $row['nik']],
                [
                    'nama'              => $row['nama'],
                    'tanggal_lahir'     => $row['tanggal_lahir'],
                    'jenis_kelamin'     => $row['jenis_kelamin'],
                    'hubungan_keluarga' => $row['hubungan_keluarga'],
                    'status_kawin'      => $row['status_kawin'],
                    'pekerjaan'         => $row['pekerjaan'],
                    'status_pekerjaan'  => $row['status_pekerjaan'],
                    'pendidikan'        => $row['pendidikan'],
                ]
            );

            // attach ke bantuan dengan tanggal_terima
            $tanggal = $row['tanggal_terima'] ?? now()->toDateString();
            $individu->bantuans()->syncWithoutDetaching([
                $this->bantuanId => ['tanggal_terima' => $tanggal],
            ]);
        };
    }
}

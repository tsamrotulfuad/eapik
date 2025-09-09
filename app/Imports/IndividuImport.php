<?php

namespace App\Imports;

use App\Models\Individu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndividuImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Individu([
            'nama'              => $row['nama'],
            'nik'               => $row['nik'],
            'tanggal_lahir'     => $row['tanggal_lahir'],
            'jenis_kelamin'     => $row['jenis_kelamin'],
            'hubungan_keluarga' => $row['hubungan_keluarga'],
            'status_kawin'      => $row['status_kawin'],
            'pekerjaan'         => $row['pekerjaan'],
            'status_pekerjaan'  => $row['status_pekerjaan'],
            'pendidikan'        => $row['pendidikan'],
        ]);
    }
}

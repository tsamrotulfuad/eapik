<?php

namespace App\Imports;

use App\Models\Individu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndividuImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $insertData = [];

        foreach ($rows as $row) {
            $insertData[] = [
                'nama'              => $row['nama'],
                'nik'               => $row['nik'],
                'tanggal_lahir'     => $row['tanggal_lahir'],
                'jenis_kelamin'     => $row['jenis_kelamin'],
                'hubungan_keluarga' => $row['hubungan_keluarga'],
                'status_kawin'      => $row['status_kawin'],
                'pekerjaan'         => $row['pekerjaan'],
                'status_pekerjaan'  => $row['status_pekerjaan'],
                'pendidikan'        => $row['pendidikan'],
            ];
        }

        // Bulk insert per chunk
        if (!empty($insertData)) {
            Individu::insert($insertData);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * Jumlah data yang diinsert per batch
     */
    public function batchSize(): int
    {
        return 1000;
    }
}

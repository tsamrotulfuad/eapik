<?php

namespace App\Imports;

use App\Models\Individu;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

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
                'uuid'              => (string) Str::uuid(), 
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

        if (!empty($insertData)) {
            // untuk safety: pecah menjadi chunk agar query tidak terlalu besar
            $chunks = array_chunk($insertData, $this->batchSize());
            foreach ($chunks as $chunk) {
                Individu::insert($chunk);
            }
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

    /**
     * Jumlah data yang diinsert per batch
     */
    public function batchSize(): int
    {
        return 500;
    }
}

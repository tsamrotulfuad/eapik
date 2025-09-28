<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenerimaTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // contoh baris dummy supaya user bisa lihat format
        return collect([
            [
                'Budi Santoso',
                '3578xxxxxx',
                '1997-07-01',
                'Laki-laki',
                'Kepala Keluarga',
                'Kawin',
                'Petani',
                'Buruh',
                'SMP'
            ],
            [
                'Siti Aminah',
                '3578xxxxxx',
                '1995-07-01',
                'Perempuan',
                'Istri',
                'Kawin',
                'IRT',
                '-',
                'SMP'
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'nama',
            'nik',
            'tanggal_lahir',
            'jenis_kelamin',          
            'hubungan_keluarga',
            'status_kawin',
            'pekerjaan',
            'status_pekerjaan',
            'pendidikan',
            'tanggal_terima',
        ];
    }
}

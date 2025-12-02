<?php

namespace App\Filament\Perangkatdaerah\Resources\InovasiPerangkatDaerahResource\Pages;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use App\Filament\Perangkatdaerah\Resources\InovasiPerangkatDaerahResource;

class IndikatorInovasiPerangkatDaerah extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithRecord, InteractsWithTable;
    use WithFileUploads;

    protected static string $resource = InovasiPerangkatDaerahResource::class;

    protected static string $view = 'filament.perangkatdaerah.resources.inovasi-perangkat-daerah-resource.pages.indikator-inovasi-perangkat-daerah';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill();
    }

     public function form(Form $form): Form
    {
        $inovasi_id = $this->record->id;
        $regis_iga = $this->record->registrasi_iga;
        $nama_inovasi = $this->record->nama_inovasi;

        return $form->schema([
            Fieldset::make('Proposal Inovasi')
                ->schema([
                    TextInput::make('inovasi_id')
                        ->default($inovasi_id)
                        ->readOnly(),
                    TextInput::make('registrasi_iga')
                        ->label('Registrasi IGA')
                        ->default($regis_iga)
                        ->disabled(),
                    TextInput::make('nama_inovasi')
                        ->default($nama_inovasi)
                        ->disabled(),
                ])->columns(3),
            Section::make('Regulasi Inovasi')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('regulasi_inovasi')
                        ->label('Regulasi Inovasi Daerah')
                        ->options([
                            'SK Kepala UPT' => 'SK Kepala UPT',
                            'SK Kepala Perangkat Daerah' => 'SK Kepala Perangkat Daerah',
                            'SK Kepala Daerah' => 'SK Kepala Daerah',
                            'Peraturan Kepala Daerah / Peraturan Daerah' => 'Peraturan Kepala Daerah / Peraturan Daerah',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapRegulasi = [
                                'SK Kepala UPT' => 5,
                                'SK Kepala Perangkat Daerah' => 10,
                                'SK Kepala Daerah' => 15,
                                'Peraturan Kepala Daerah / Peraturan Daerah' => 25
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapRegulasi[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('regulasi_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                        + (float) $get('ketersediaan_nilai') 
                                        + (float) $get('dukungan_anggaran_nilai')
                                        + (float) $get('kecepatan_penciptaan_nilai')
                                        + (float) $get('kemanfaatan_nilai')
                                        + (float) $get('sosialisasi_nilai')
                                        + (float) $get('kemudahan_proses_nilai')
                                        + (float) $get('alat_kerja_nilai')
                                        + (float) $get('kualitas_nilai');
                                $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('regulasi_nilai')
                        ->label('Nilai Regulasi Inovasi')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('regulasi_inovasi_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('regulasi_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Ketersediaan SDM')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('ketersediaan_sdm')
                        ->label('Ketersediaan SDM')
                        ->options([
                            '1-10 SDM' => '1-10 SDM',
                            '11-30 SDM' => '11-30 SDM',
                            'Lebih dari 30 SDM' => 'Lebih dari 30 SDM',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapKetersediaan = [
                                '1-10 SDM' => 5,
                                '11-30 SDM' => 10,
                                'Lebih dari 30 SDM' => 15,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapKetersediaan[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('ketersediaan_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('ketersediaan_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('ketersediaan_sdm_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('ketersediaan_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Dukungan Anggaran')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('dukungan_anggaran')
                        ->label('Dukungan Anggaran')
                        ->options([
                            'Tidak ada dukungan anggaran' => 'Tidak ada dukungan anggaran',
                            'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (Tahun Berjalan)' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0(Tahun Berjalan)',
                            'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2',
                            'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapAnggaran = [
                                'Tidak ada dukungan anggaran' => 5,
                                'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (Tahun Berjalan)' => 10,
                                'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2' => 15,
                                'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2' => 20,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapAnggaran[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('dukungan_anggaran_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('dukungan_anggaran_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('dukungan_anggaran_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('dukungan_anggaran_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Kecepatan Penciptaan')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('kecepatan_penciptaan')
                        ->label('Kecepatan Penciptaan')
                        ->options([
                            'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih' => 'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih',
                            'Inovasi dapat diciptakan dalam waktu 5-8 bulan' => 'Inovasi dapat diciptakan dalam waktu 5-8 bulan',
                            'Inovasi dapat diciptakan dalam waktu 1-4 bulan' => 'Inovasi dapat diciptakan dalam waktu 1-4 bulan',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapKecepatan = [
                                'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih' => 5,
                                'Inovasi dapat diciptakan dalam waktu 5-8 bulan' => 10,
                                'Inovasi dapat diciptakan dalam waktu 1-4 bulan' => 15,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapKecepatan[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('kecepatan_penciptaan_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('kecepatan_penciptaan_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('kecepatan_penciptaan_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('kecepatan_penciptaan_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Kemanfaatan')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('kemanfaatan')
                        ->label('Kemanfaatan Inovasi')
                        ->options([
                            'Satuan Orang' => 'Satuan orang (pegawai, peserta didik, pasien, dsb)',
                            'Satuan Unit' => 'Satuan unit (opd/uptd/desa/rt/rw/kampung/KK,dsb) organisasi',
                            'Satuan Biaya' => 'Satuan biaya (rupiah)',
                            'Satuan Pendapatan' =>  'Satuan pendapatan (rupiah)',
                            'Satuan Hasil' => 'Satuan hasil produk/satuan penjualan',
                        ])
                        ->live()
                        ->reactive()
                        ->native(false)
                        ->required(),
                    Select::make('kemanfaatan_do')
                        ->label('Definisi Operasional - Kemanfaatan Inovasi')
                        ->options(fn (Get $get): array => match ($get('kemanfaatan')) {
                            'Satuan Orang' => [
                                'Tidak dapat diukur' => 'Tidak dapat diukur',
                                'Jumlah pengguna atau penerima manfaat 1-100 orang' => 'Jumlah pengguna atau penerima manfaat 1-100 orang',
                                'Jumlah pengguna atau penerima manfaat 101-200 orang' => 'Jumlah pengguna atau penerima manfaat 101-200 orang',
                                'Jumlah pengguna atau penerima manfaat 201 orang atau lebih' => 'Jumlah pengguna atau penerima manfaat 201 orang atau lebih',
                            ],
                            'Satuan Unit' => [
                                'Tidak dapat diukur' => 'Tidak dapat diukur',
                                'Persentase peningkatan Jumlah Unit 5,00% - 20,00%' => 'Persentase peningkatan Jumlah Unit 5,00% - 20,00%',
                                'Persentase peningkatan Jumlah Unit 20,01% - 50%' => 'Persentase peningkatan Jumlah Unit 20,01% - 50%',
                                'Persentase peningkatan Jumlah Unit > 50%' => 'Persentase peningkatan Jumlah Unit > 50%',
                            ],
                            'Satuan Biaya' => [
                                'Tidak dapat diukur' => 'Tidak dapat diukur',
                                'Efisiensi belanja sebesar 0,01% - 10%' => 'Efisiensi belanja sebesar 0,01% - 10%',
                                'Efisiensi belanja sebesar 10,01% - 20,00%' => 'Efisiensi belanja sebesar 10,01% - 20,00%',
                                'Efisiensi belanja sebesar 20,01% - 30,00%' => 'Efisiensi belanja sebesar 20,01% - 30,00%',
                            ],
                            'Satuan Pendapatan' => [
                                'Tidak dapat diukur' => 'Tidak dapat diukur',
                                'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%' => 'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%',
                                'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%' => 'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%',
                                'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%' => 'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%',
                            ],
                            'Satuan Hasil' => [
                                'Tidak dapat diukur' => 'Tidak dapat diukur',
                                'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang' => 'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang',
                                'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang' => 'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang',
                                'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang' => 'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang',
                            ],
                            default => [],
                        })
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan pilihan definisi operasional
                            $mapKemanfaatan_do = [
                                'Tidak dapat diukur' => 0,
                                'Jumlah pengguna atau penerima manfaat 1-100 orang' => 5,
                                'Jumlah pengguna atau penerima manfaat 101-200 orang' => 10,
                                'Jumlah pengguna atau penerima manfaat 201 orang atau lebih' => 15,

                                'Persentase peningkatan Jumlah Unit 5,00% - 20,00%' => 5,
                                'Persentase peningkatan Jumlah Unit 20,01% - 50%' => 10,
                                'Persentase peningkatan Jumlah Unit > 50%' => 15,

                                'Efisiensi belanja sebesar 0,01% - 10%' => 5,
                                'Efisiensi belanja sebesar 10,01% - 20,00%' => 10,
                                'Efisiensi belanja sebesar 20,01% - 30,00%' => 15,

                                'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%' => 5,
                                'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%' => 10,
                                'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%' => 15,

                                'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang' => 5,
                                'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang' => 10,
                                'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang' => 15,
                            ];

                            $nilai = $mapKemanfaatan_do[$state] ?? 0;
                            $set('kemanfaatan_nilai', $nilai);

                            // hitung total skor
                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->columnSpanFull()
                        ->native(false)
                        ->dehydrated(false)
                        ->required(),
                    TextInput::make('kemanfaatan_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('kemanfaatan_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('kemanfaatan_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Sosialisasi')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('sosialisasi')
                        ->label('Sosialisasi Inovasi')
                        ->options([
                            'Sosialisasi Tatap Muka' => 'Sosialisasi Tatap Muka',
                            'Konten Media Sosial' => 'Konten Media Sosial',
                            'Media Berita' => 'Media Berita',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $MapSosialisasi = [
                                'Sosialisasi Tatap Muka' => 5,
                                'Konten Media Sosial' => 10,
                                'Media Berita' => 15,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $MapSosialisasi[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('sosialisasi_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('sosialisasi_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('sosialisasi_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('sosialisasi_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Kemudahan Proses')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('kemudahan_proses')
                        ->label('Kemudahan Proses Inovasi')
                        ->options([
                            'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih' => 'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih',
                            'Hasil inovasi diperoleh dalam waktu 2-5 hari' => 'Hasil inovasi diperoleh dalam waktu 2-5 hari',
                            'Hasil inovasi diperoleh dalam waktu 1 hari' => 'Hasil inovasi diperoleh dalam waktu 1 hari',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapKemudahan = [
                                'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih' => 5,
                                'Hasil inovasi diperoleh dalam waktu 2-5 hari' => 10,
                                'Hasil inovasi diperoleh dalam waktu 1 hari' => 15,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapKemudahan[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('kemudahan_proses_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('kemudahan_proses_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('kemudahan_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('kemudahan_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Alat Kerja')
                ->description('Deskripsi')
                ->aside()
                ->schema([
                    Select::make('alat_kerja')
                        ->label('Alat Kerja Inovasi')
                        ->options([
                            'Pelaksanaan kerja secara Manual' => 'Pelaksanaan kerja secara Manual',
                            'Pelaksanaan kerja secara Elektronik' => 'Pelaksanaan kerja secara Elektronik',
                            'Pelaksanaan kerja sudah didukung sistem informasi online' => 'Pelaksanaan kerja sudah didukung sistem informasi online',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapAlatKerja = [
                                'Pelaksanaan kerja secara Manual' => 5,
                                'Pelaksanaan kerja secara Elektronik' => 10,
                                'Pelaksanaan kerja sudah didukung sistem informasi online' => 15,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapAlatKerja[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('alat_kerja_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->required(),
                    TextInput::make('alat_kerja_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('alat_kerja_upload')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('alat_kerja_upload')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            Section::make('Kualitas Inovasi (Video)')
                ->description('Unsur Video Inovasi Daerah meliputi: Latar Belakang Inovasi, Penjaringan Ide Inovasi, Pemilihan Ide, Manfaat, Dampak')
                ->aside()
                ->schema([
                    Select::make('kualitas_parameter')
                        ->label('Parameter Kualitas Video')
                        ->options([
                            'Memenuhi 1 atau 2 unsur substansi' => 'Memenuhi 1 atau 2 unsur substansi',
                            'Memenuhi 3 atau 4 unsur substansi' => 'Memenuhi 3 atau 4 unsur substansi',
                            'Memenuhi 5 unsur substansi' => 'Memenuhi 5 unsur substansi',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            // mapping nilai berdasarkan parameter
                            $mapKualitas = [
                                'Memenuhi 1 atau 2 unsur substansi' => 5,
                                'Memenuhi 3 atau 4 unsur substansi' => 10,
                                'Memenuhi 5 unsur substansi' => 15,
                            ];
                            // ambil nilai dari pilihan user
                            $nilai = $mapKualitas[$state] ?? 0;

                            // set ke hasil section ini (misal regulasi_nilai)
                            $set('kualitas_nilai', $nilai);

                            $total = (float) $get('regulasi_nilai') 
                                    + (float) $get('ketersediaan_nilai') 
                                    + (float) $get('dukungan_anggaran_nilai')
                                    + (float) $get('kecepatan_penciptaan_nilai')
                                    + (float) $get('kemanfaatan_nilai')
                                    + (float) $get('sosialisasi_nilai')
                                    + (float) $get('kemudahan_proses_nilai')
                                    + (float) $get('alat_kerja_nilai')
                                    + (float) $get('kualitas_nilai');
                            $set('kematangan', $total);
                        })
                        ->native(false)
                        ->dehydrated(false)
                        ->required(),
                    TextInput::make('kualitas_nilai')
                        ->numeric()
                        ->default(0)
                        ->disabled()
                        ->dehydrated(false),
                    FileUpload::make('kualitas')
                        ->label('Bukti Dukung')
                        ->disk('public')
                        ->directory('kualitas')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->required(),
                ]),
            TextInput::make('kematangan')
                ->label('Total Nilai Kematangan')
                ->numeric()
            ])
        ->statePath('data');
    }

    public function create(): void
    {
        \App\Models\IndikatorInovasiPerangkatDaerah::create($this->form->getState());
        $this->form->fill();
        Notification::make()
            ->title('Data berhasil disimpan')
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        $inovasi_id = $this->record->id;

        return $table
            ->query(\App\Models\IndikatorInovasiPerangkatDaerah::query()
                    ->where('inovasi_id', $inovasi_id))
            ->columns([
                TextColumn::make('inovasi.nama_inovasi')->label('Nama Inovasi'),
                TextColumn::make('kematangan'),
                TextColumn::make('tahun'),
            ])
            ->emptyStateHeading("Tidak Ada Data")
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make(),
                EditAction::make()
                    ->record($this->record)
                    ->form([
                        Section::make('Regulasi Inovasi')
                        ->description('Deskripsi')
                        ->aside()
                        ->schema([
                            Select::make('regulasi_inovasi')
                                ->label('Regulasi Inovasi Daerah')
                                ->options([
                                    'SK Kepala UPT' => 'SK Kepala UPT',
                                    'SK Kepala Perangkat Daerah' => 'SK Kepala Perangkat Daerah',
                                    'SK Kepala Daerah' => 'SK Kepala Daerah',
                                    'Peraturan Kepala Daerah / Peraturan Daerah' => 'Peraturan Kepala Daerah / Peraturan Daerah',
                                ])
                                ->reactive()
                                // Saat form di-load, tampilkan nilai regulasi berdasarkan record lama
                                ->afterStateHydrated(function ($state, Set $set) {
                                    $mapRegulasi = [
                                        'SK Kepala UPT' => 5,
                                        'SK Kepala Perangkat Daerah' => 10,
                                        'SK Kepala Daerah' => 15,
                                        'Peraturan Kepala Daerah / Peraturan Daerah' => 25,
                                    ];

                                    $set('regulasi_nilai', $mapRegulasi[$state] ?? 0);
                                })
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                    // mapping nilai berdasarkan parameter
                                    $mapRegulasi = [
                                        'SK Kepala UPT' => 5,
                                        'SK Kepala Perangkat Daerah' => 10,
                                        'SK Kepala Daerah' => 15,
                                        'Peraturan Kepala Daerah / Peraturan Daerah' => 25
                                    ];
                                    // ambil nilai dari pilihan user
                                    $nilai = $mapRegulasi[$state] ?? 0;

                                    // set ke hasil section ini (misal regulasi_nilai)
                                    $set('regulasi_nilai', $nilai);

                                    $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai');
                                        $set('kematangan', $total);
                                })
                                ->native(false)
                                ->required(),
                            TextInput::make('regulasi_nilai')
                                ->label('Nilai Regulasi Inovasi')
                                ->numeric()
                                ->default(0)
                                ->disabled()
                                ->dehydrated(false),
                            FileUpload::make('regulasi_inovasi_upload')
                                ->label('Bukti Dukung')
                                ->disk('public')
                                ->directory('regulasi_upload')
                                ->visibility('public')
                                ->preserveFilenames()
                                ->downloadable()
                                ->required(),
                        ]),
                        Section::make('Ketersediaan SDM')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                                Select::make('ketersediaan_sdm')
                                    ->label('Ketersediaan SDM')
                                    ->options([
                                        '1-10 SDM' => '1-10 SDM',
                                        '11-30 SDM' => '11-30 SDM',
                                        'Lebih dari 30 SDM' => 'Lebih dari 30 SDM',
                                    ])
                                    ->reactive()
                                    ->afterStateHydrated(function ($state, Set $set) {
                                        $mapKetersediaan = [
                                            '1-10 SDM' => 5,
                                            '11-30 SDM' => 10,
                                            'Lebih dari 30 SDM' => 15,
                                        ];

                                            $set('ketersediaan_nilai', $mapKetersediaan[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan parameter
                                        $mapKetersediaan = [
                                            '1-10 SDM' => 5,
                                            '11-30 SDM' => 10,
                                            'Lebih dari 30 SDM' => 15,
                                        ];
                                        // ambil nilai dari pilihan user
                                        $nilai = $mapKetersediaan[$state] ?? 0;

                                        // set ke hasil section ini (misal regulasi_nilai)
                                        $set('ketersediaan_nilai', $nilai);

                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->native(false)
                                    ->required(),
                                TextInput::make('ketersediaan_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('ketersediaan_sdm_upload')
                                    ->label('Bukti Dukung')
                                    ->disk('public')
                                    ->directory('ketersediaan_upload')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->required(),
                            ]),
                        Section::make('Dukungan Anggaran')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                        Select::make('dukungan_anggaran')
                            ->label('Dukungan Anggaran')
                            ->options([
                                'Tidak ada dukungan anggaran' => 'Tidak ada dukungan anggaran',
                                'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (Tahun Berjalan)' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0(Tahun Berjalan)',
                                'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2',
                                'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2',
                            ])
                            ->reactive()
                             ->afterStateHydrated(function ($state, Set $set) {
                                        $mapAnggaran = [
                                            'Tidak ada dukungan anggaran' => 5,
                                            'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (Tahun Berjalan)' => 10,
                                            'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2' => 15,
                                            'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2' => 20,
                                        ];

                                            $set('dukungan_anggaran_nilai', $mapAnggaran[$state] ?? 0);
                                    })
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                // mapping nilai berdasarkan parameter
                                $mapAnggaran = [
                                    'Tidak ada dukungan anggaran' => 5,
                                    'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (Tahun Berjalan)' => 10,
                                    'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2' => 15,
                                    'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0,T-1 dan T-2' => 20,
                                ];
                                // ambil nilai dari pilihan user
                                $nilai = $mapAnggaran[$state] ?? 0;

                                // set ke hasil section ini (misal regulasi_nilai)
                                $set('dukungan_anggaran_nilai', $nilai);

                                $total = (float) $get('regulasi_nilai') 
                                        + (float) $get('ketersediaan_nilai') 
                                        + (float) $get('dukungan_anggaran_nilai')
                                        + (float) $get('kecepatan_penciptaan_nilai')
                                        + (float) $get('kemanfaatan_nilai')
                                        + (float) $get('sosialisasi_nilai')
                                        + (float) $get('kemudahan_proses_nilai')
                                        + (float) $get('alat_kerja_nilai');
                                $set('kematangan', $total);
                            })
                            ->native(false)
                            ->required(),
                        TextInput::make('dukungan_anggaran_nilai')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(false),
                        FileUpload::make('dukungan_anggaran_upload')
                            ->label('Bukti Dukung')
                            ->disk('public')
                            ->directory('dukungan_anggaran_upload')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->downloadable()
                            ->required(),
                        ]),
                        Section::make('Kecepatan Penciptaan')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                                Select::make('kecepatan_penciptaan')
                                    ->label('Kecepatan Penciptaan')
                                    ->options([
                                        'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih' => 'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih',
                                        'Inovasi dapat diciptakan dalam waktu 5-8 bulan' => 'Inovasi dapat diciptakan dalam waktu 5-8 bulan',
                                        'Inovasi dapat diciptakan dalam waktu 1-4 bulan' => 'Inovasi dapat diciptakan dalam waktu 1-4 bulan',
                                    ])
                                    ->reactive()
                                    ->afterStateHydrated(function ($state, Set $set) {
                                        $mapKecepatan = [
                                            'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih' => 5,
                                            'Inovasi dapat diciptakan dalam waktu 5-8 bulan' => 10,
                                            'Inovasi dapat diciptakan dalam waktu 1-4 bulan' => 15,
                                        ];

                                            $set('kecepatan_penciptaan_nilai', $mapKecepatan[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan parameter
                                        $mapKecepatan = [
                                            'Inovasi dapat diciptakan dalam waktu 9 bulan atau lebih' => 5,
                                            'Inovasi dapat diciptakan dalam waktu 5-8 bulan' => 10,
                                            'Inovasi dapat diciptakan dalam waktu 1-4 bulan' => 15,
                                        ];
                                        // ambil nilai dari pilihan user
                                        $nilai = $mapKecepatan[$state] ?? 0;

                                        // set ke hasil section ini (misal regulasi_nilai)
                                        $set('kecepatan_penciptaan_nilai', $nilai);

                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->native(false)
                                    ->required(),
                                TextInput::make('kecepatan_penciptaan_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('kecepatan_penciptaan_upload')
                                    ->label('Bukti Dukung')
                                    ->disk('public')
                                    ->directory('kecepatan_penciptaan_upload')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->required(),
                            ]),
                        Section::make('Kemanfaatan')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                                Select::make('kemanfaatan')
                                    ->label('Kemanfaatan Inovasi')
                                    ->options([
                                        'Satuan Orang' => 'Satuan orang (pegawai, peserta didik, pasien, dsb)',
                                        'Satuan Unit' => 'Satuan unit (opd/uptd/desa/rt/rw/kampung/KK,dsb) organisasi',
                                        'Satuan Biaya' => 'Satuan biaya (rupiah)',
                                        'Satuan Pendapatan' =>  'Satuan pendapatan (rupiah)',
                                        'Satuan Hasil' => 'Satuan hasil produk/satuan penjualan',
                                    ])
                                    ->live()
                                    ->reactive()
                                    ->native(false)
                                    ->required(),
                                Select::make('kemanfaatan_do')
                                    ->label('Definisi Operasional - Kemanfaatan Inovasi')
                                    ->options(fn (Get $get): array => match ($get('kemanfaatan')) {
                                        'Satuan Orang' => [
                                            'Tidak dapat diukur' => 'Tidak dapat diukur',
                                            'Jumlah pengguna atau penerima manfaat 1-100 orang' => 'Jumlah pengguna atau penerima manfaat 1-100 orang',
                                            'Jumlah pengguna atau penerima manfaat 101-200 orang' => 'Jumlah pengguna atau penerima manfaat 101-200 orang',
                                            'Jumlah pengguna atau penerima manfaat 201 orang atau lebih' => 'Jumlah pengguna atau penerima manfaat 201 orang atau lebih',
                                        ],
                                        'Satuan Unit' => [
                                            'Tidak dapat diukur' => 'Tidak dapat diukur',
                                            'Persentase peningkatan Jumlah Unit 5,00% - 20,00%' => 'Persentase peningkatan Jumlah Unit 5,00% - 20,00%',
                                            'Persentase peningkatan Jumlah Unit 20,01% - 50%' => 'Persentase peningkatan Jumlah Unit 20,01% - 50%',
                                            'Persentase peningkatan Jumlah Unit > 50%' => 'Persentase peningkatan Jumlah Unit > 50%',
                                        ],
                                        'Satuan Biaya' => [
                                            'Tidak dapat diukur' => 'Tidak dapat diukur',
                                            'Efisiensi belanja sebesar 0,01% - 10%' => 'Efisiensi belanja sebesar 0,01% - 10%',
                                            'Efisiensi belanja sebesar 10,01% - 20,00%' => 'Efisiensi belanja sebesar 10,01% - 20,00%',
                                            'Efisiensi belanja sebesar 20,01% - 30,00%' => 'Efisiensi belanja sebesar 20,01% - 30,00%',
                                        ],
                                        'Satuan Pendapatan' => [
                                            'Tidak dapat diukur' => 'Tidak dapat diukur',
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%' => 'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%',
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%' => 'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%',
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%' => 'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%',
                                        ],
                                        'Satuan Hasil' => [
                                            'Tidak dapat diukur' => 'Tidak dapat diukur',
                                            'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang' => 'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang',
                                            'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang' => 'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang',
                                            'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang' => 'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang',
                                        ],
                                        default => [],
                                    })
                                    ->afterStateHydrated(function ($state, Set $set) {
                                        $mapKemanfaatan_do = [
                                            'Tidak dapat diukur' => 0,
                                            'Jumlah pengguna atau penerima manfaat 1-100 orang' => 5,
                                            'Jumlah pengguna atau penerima manfaat 101-200 orang' => 10,
                                            'Jumlah pengguna atau penerima manfaat 201 orang atau lebih' => 15,

                                            'Persentase peningkatan Jumlah Unit 5,00% - 20,00%' => 5,
                                            'Persentase peningkatan Jumlah Unit 20,01% - 50%' => 10,
                                            'Persentase peningkatan Jumlah Unit > 50%' => 15,

                                            'Efisiensi belanja sebesar 0,01% - 10%' => 5,
                                            'Efisiensi belanja sebesar 10,01% - 20,00%' => 10,
                                            'Efisiensi belanja sebesar 20,01% - 30,00%' => 15,

                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%' => 5,
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%' => 10,
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%' => 15,

                                            'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang' => 5,
                                            'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang' => 10,
                                            'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang' => 15,
                                        ];

                                            $set('kemanfaatan_nilai', $mapKemanfaatan_do[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan pilihan definisi operasional
                                        $mapKemanfaatan_do = [
                                            'Tidak dapat diukur' => 0,
                                            'Jumlah pengguna atau penerima manfaat 1-100 orang' => 5,
                                            'Jumlah pengguna atau penerima manfaat 101-200 orang' => 10,
                                            'Jumlah pengguna atau penerima manfaat 201 orang atau lebih' => 15,

                                            'Persentase peningkatan Jumlah Unit 5,00% - 20,00%' => 5,
                                            'Persentase peningkatan Jumlah Unit 20,01% - 50%' => 10,
                                            'Persentase peningkatan Jumlah Unit > 50%' => 15,

                                            'Efisiensi belanja sebesar 0,01% - 10%' => 5,
                                            'Efisiensi belanja sebesar 10,01% - 20,00%' => 10,
                                            'Efisiensi belanja sebesar 20,01% - 30,00%' => 15,

                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 0,01% - 49,99%' => 5,
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi 50,00% -99,99%' => 10,
                                            'Penambahan pendapatan bagi pemda atau perangkat daerah atau unit kerja yang menerapkan inovasi dari sama dengan 100%' => 15,

                                            'Jumah produk yang dihasilkan atau diperjualbelikan 1-100 barang' => 5,
                                            'Jumlah produk yang dihasilkan atau diperjualbelikan 101-200 barang' => 10,
                                            'Jumlah produk yang dihasilkan atau diperjualbelikan lebih dari 200 barang' => 15,
                                        ];

                                        $nilai = $mapKemanfaatan_do[$state] ?? 0;
                                        $set('kemanfaatan_nilai', $nilai);

                                        // hitung total skor
                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai')
                                                + (float) $get('kualitas_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->columnSpanFull()
                                    ->native(false)
                                    ->required(),
                                TextInput::make('kemanfaatan_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('kemanfaatan_upload')
                                    ->label('Bukti Dukung')
                                    ->disk('public')
                                    ->directory('kemanfaatan_upload')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->required(),
                            ]),
                        Section::make('Sosialisasi')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                                Select::make('sosialisasi')
                                    ->label('Sosialisasi Inovasi')
                                    ->options([
                                        'Sosialisasi Tatap Muka' => 'Sosialisasi Tatap Muka',
                                        'Konten Media Sosial' => 'Konten Media Sosial',
                                        'Media Berita' => 'Media Berita',
                                    ])
                                    ->reactive()
                                     ->afterStateHydrated(function ($state, Set $set) {
                                        $MapSosialisasi = [
                                            'Sosialisasi Tatap Muka' => 5,
                                            'Konten Media Sosial' => 10,
                                            'Media Berita' => 15,
                                        ];

                                            $set('sosialisasi_nilai', $MapSosialisasi[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan parameter
                                        $MapSosialisasi = [
                                            'Sosialisasi Tatap Muka' => 5,
                                            'Konten Media Sosial' => 10,
                                            'Media Berita' => 15,
                                        ];
                                        // ambil nilai dari pilihan user
                                        $nilai = $MapSosialisasi[$state] ?? 0;

                                        // set ke hasil section ini (misal regulasi_nilai)
                                        $set('sosialisasi_nilai', $nilai);

                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->native(false)
                                    ->required(),
                                TextInput::make('sosialisasi_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('sosialisasi_upload')
                                    ->label('Bukti Dukung')
                                    ->disk('public')
                                    ->directory('sosialisasi_upload')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->required(),
                            ]),
                        Section::make('Kemudahan Proses')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                                Select::make('kemudahan_proses')
                                    ->label('Kemudahan Proses Inovasi')
                                    ->options([
                                        'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih' => 'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih',
                                        'Hasil inovasi diperoleh dalam waktu 2-5 hari' => 'Hasil inovasi diperoleh dalam waktu 2-5 hari',
                                        'Hasil inovasi diperoleh dalam waktu 1 hari' => 'Hasil inovasi diperoleh dalam waktu 1 hari',
                                    ])
                                    ->reactive()
                                    ->afterStateHydrated(function ($state, Set $set) {
                                        $mapKemudahan = [
                                            'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih' => 5,
                                            'Hasil inovasi diperoleh dalam waktu 2-5 hari' => 10,
                                            'Hasil inovasi diperoleh dalam waktu 1 hari' => 15,
                                        ];

                                            $set('kemudahan_proses_nilai', $mapKemudahan[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan parameter
                                        $mapKemudahan = [
                                            'Hasil inovasi diperoleh dalam waktu 6 hari atau lebih' => 5,
                                            'Hasil inovasi diperoleh dalam waktu 2-5 hari' => 10,
                                            'Hasil inovasi diperoleh dalam waktu 1 hari' => 15,
                                        ];
                                        // ambil nilai dari pilihan user
                                        $nilai = $mapKemudahan[$state] ?? 0;

                                        // set ke hasil section ini (misal regulasi_nilai)
                                        $set('kemudahan_proses_nilai', $nilai);

                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->native(false)
                                    ->required(),
                                TextInput::make('kemudahan_proses_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('kemudahan_upload')
                                    ->label('Bukti Dukung')
                                    ->disk('public')
                                    ->directory('kemudahan_upload')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->required(),
                            ]),
                        Section::make('Alat Kerja')
                            ->description('Deskripsi')
                            ->aside()
                            ->schema([
                                Select::make('alat_kerja')
                                    ->label('Alat Kerja Inovasi')
                                    ->options([
                                        'Pelaksanaan kerja secara Manual' => 'Pelaksanaan kerja secara Manual',
                                        'Pelaksanaan kerja secara Elektronik' => 'Pelaksanaan kerja secara Elektronik',
                                        'Pelaksanaan kerja sudah didukung sistem informasi online' => 'Pelaksanaan kerja sudah didukung sistem informasi online',
                                    ])
                                    ->reactive()
                                     ->afterStateHydrated(function ($state, Set $set) {
                                        $mapAlatKerja = [
                                            'Pelaksanaan kerja secara Manual' => 5,
                                            'Pelaksanaan kerja secara Elektronik' => 10,
                                            'Pelaksanaan kerja sudah didukung sistem informasi online' => 15,
                                        ];

                                            $set('alat_kerja_nilai', $mapAlatKerja[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan parameter
                                        $mapAlatKerja = [
                                            'Pelaksanaan kerja secara Manual' => 5,
                                            'Pelaksanaan kerja secara Elektronik' => 10,
                                            'Pelaksanaan kerja sudah didukung sistem informasi online' => 15,
                                        ];
                                        // ambil nilai dari pilihan user
                                        $nilai = $mapAlatKerja[$state] ?? 0;

                                        // set ke hasil section ini (misal regulasi_nilai)
                                        $set('alat_kerja_nilai', $nilai);

                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->native(false)
                                    ->required(),
                                TextInput::make('alat_kerja_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('alat_kerja_upload')
                                    ->label('Bukti Dukung')
                                    ->disk('public')
                                    ->directory('alat_kerja_upload')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->required(),
                            ]),
                         Section::make('Kualitas Inovasi (Video)')
                            ->description('Unsur Video Inovasi Daerah meliputi: Latar Belakang Inovasi, Penjaringan Ide Inovasi, Pemilihan Ide, Manfaat, Dampak')
                            ->aside()
                            ->schema([
                                Select::make('kualitas_parameter')
                                    ->label('Parameter Kualitas Video')
                                    ->options([
                                        'Memenuhi 1 atau 2 unsur substansi' => 'Memenuhi 1 atau 2 unsur substansi',
                                        'Memenuhi 3 atau 4 unsur substansi' => 'Memenuhi 3 atau 4 unsur substansi',
                                        'Memenuhi 5 unsur substansi' => 'Memenuhi 5 unsur substansi',
                                    ])
                                    ->reactive()
                                    ->afterStateHydrated(function ($state, Set $set) {
                                        $mapKualitas = [
                                            'Memenuhi 1 atau 2 unsur substansi' => 5,
                                            'Memenuhi 3 atau 4 unsur substansi' => 10,
                                            'Memenuhi 5 unsur substansi' => 15,
                                        ];

                                            $set('kualitas_nilai', $mapKualitas[$state] ?? 0);
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        // mapping nilai berdasarkan parameter
                                        $mapKualitas = [
                                            'Memenuhi 1 atau 2 unsur substansi' => 5,
                                            'Memenuhi 3 atau 4 unsur substansi' => 10,
                                            'Memenuhi 5 unsur substansi' => 15,
                                        ];
                                        // ambil nilai dari pilihan user
                                        $nilai = $mapKualitas[$state] ?? 0;

                                        // set ke hasil section ini (misal regulasi_nilai)
                                        $set('kualitas_nilai', $nilai);

                                        $total = (float) $get('regulasi_nilai') 
                                                + (float) $get('ketersediaan_nilai') 
                                                + (float) $get('dukungan_anggaran_nilai')
                                                + (float) $get('kecepatan_penciptaan_nilai')
                                                + (float) $get('kemanfaatan_nilai')
                                                + (float) $get('sosialisasi_nilai')
                                                + (float) $get('kemudahan_proses_nilai')
                                                + (float) $get('alat_kerja_nilai')
                                                + (float) $get('kualitas_nilai');
                                        $set('kematangan', $total);
                                    })
                                    ->native(false)
                                    ->required(),
                                TextInput::make('kualitas_nilai')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                                FileUpload::make('kualitas')
                                    ->label('Bukti Dukung (50mb)')
                                    ->disk('public')
                                    ->directory('kualitas')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->openable()
                                    ->required(),
                            ]),
                        TextInput::make('kematangan')
                            ->label('Total Nilai Kematangan')
                            ->numeric()
                        ])
                    ])
            ->bulkActions([
                // ...
            ]);
    }
}

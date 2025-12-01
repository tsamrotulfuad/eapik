<?php

namespace App\Filament\Brida\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Blade;
use App\Models\InovasiPerangkatDaerah;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Brida\Resources\InovasiPerangkatDaerahResource\Pages;
use App\Filament\Brida\Resources\InovasiPerangkatDaerahResource\RelationManagers;

class InovasiPerangkatDaerahResource extends Resource
{
    protected static ?string $model = InovasiPerangkatDaerah::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationGroup = "Proposal Inovasi";

    protected static ?string $navigationLabel = 'Inovasi Perangkat Daerah';

    protected static ?string $breadcrumb = "Inovasi";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_inovasi')
                    ->columnSpanFull()
                    ->label('Nama Inovasi')
                    ->required(),
                TextInput::make('registrasi_iga')
                    ->columnSpanFull()
                    ->label('Nomor Registrasi IGA'),
                Select::make('tahapan_inovasi')
                    ->options([
                        'Inisiatif' => 'Inisiatif',
                        'Uji coba' => 'Uji Coba',
                        'Penerapan' => 'Penerapan',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('inisiator_inovasi')
                    ->options([
                        'Kepala Daerah' => 'Kepala Daerah',
                        'Anggota DPRD' => 'Anggota DPRD',
                        'OPD' => 'OPD',
                        'ASN' => 'ASN',
                        'Masyarakat' => 'Masyarakat',
                    ])->native(false)->required(),
                TextInput::make('nama_inisiator')
                    ->label('Nama Inisiator')
                    ->required(),
                Forms\Components\Select::make('jenis_inovasi')
                    ->options([
                        'Digital' => 'Digital',
                        'Non Digital' => 'Non Digital',
                    ])->native(false)->required(),
                Forms\Components\Select::make('klasifikasi_inovasi')
                    ->options([
                        'Umum' => 'Umum',
                        'Replikasi' => 'Replikasi',
                    ])->native(false)->required(),
                Forms\Components\Select::make('bentuk_inovasi')
                    ->options([
                        'Inovasi Pelayanan Publik' => 'Inovasi Pelayanan Publik',
                        'Inovasi Tata Kelola' => 'Inovasi Tata Kelola Pemerintahan Daerah',
                        'Invosasi Daerah Lainnya' => 'Inovasi Daerah lainnya sesuai dengan Urusan Pemerintahan yang mejadi Kewenangan Daerah',
                    ])->native(false)->required(),
                Select::make('astacita_inovasi')
                    ->label('Asta Cita')
                    ->options([
                        'Memperkokoh ideologi Pancasila, demokrasi, dan hak asasi manusia (HAM).' => 'Memperkokoh ideologi Pancasila, demokrasi, dan hak asasi manusia (HAM).',
                        'Memantapkan sistem pertahanan keamanan negara dan mendorong kemandirian bangsa melalui swasembada pangan, energi, air, ekonomi kreatif, ekonomi hijau, dan ekonomi biru.' => 'Memantapkan sistem pertahanan keamanan negara dan mendorong kemandirian bangsa melalui swasembada pangan, energi, air, ekonomi kreatif, ekonomi hijau, dan ekonomi biru.',
                        'Meningkatkan lapangan kerja yang berkualitas, mendorong kewirausahaan, mengembangkan industri kreatif, dan melanjutkan pengembangan infrastruktur.' => 'Meningkatkan lapangan kerja yang berkualitas, mendorong kewirausahaan, mengembangkan industri kreatif, dan melanjutkan pengembangan infrastruktur.',
                        'Memperkuat pembangunan sumber daya manusia (SDM), sains, teknologi, pendidikan, kesehatan, prestasi olahraga, kesetaraan gender, serta penguatan peran perempuan, pemuda, dan penyandang disabilitas.' => 'Memperkuat pembangunan sumber daya manusia (SDM), sains, teknologi, pendidikan, kesehatan, prestasi olahraga, kesetaraan gender, serta penguatan peran perempuan, pemuda, dan penyandang disabilitas.',
                        'Melanjutkan hilirisasi dan industrialisasi untuk meningkatkan nilai tambah di dalam negeri.' => 'Melanjutkan hilirisasi dan industrialisasi untuk meningkatkan nilai tambah di dalam negeri.',
                        'Membangun dari desa dan dari bawah untuk pemerataan ekonomi dan pemberantasan kemiskinan.' => 'Membangun dari desa dan dari bawah untuk pemerataan ekonomi dan pemberantasan kemiskinan.',
                        'Memperkuat reformasi politik, hukum, dan birokrasi, serta memperkuat pencegahan dan pemberantasan korupsi dan narkoba.' => 'Memperkuat reformasi politik, hukum, dan birokrasi, serta memperkuat pencegahan dan pemberantasan korupsi dan narkoba.',
                        'Memperkuat penyelarasan kehidupan yang harmonis dengan lingkungan, alam, dan budaya, serta peningkatan toleransi antarumat beragama untuk mencapai masyarakat yang adil dan Makmur' => 'Memperkuat penyelarasan kehidupan yang harmonis dengan lingkungan, alam, dan budaya, serta peningkatan toleransi antarumat beragama untuk mencapai masyarakat yang adil dan Makmur',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('urusan_inovasi')
                    ->multiple()
                    ->required()
                    // ->searchable()
                    ->options([
                        'Pendidikan'    => 'Pendidikan',
                        'Kesehatan'     => 'Kesehatan',
                        'PUPR'          => 'Pekerjaan Umum dan Penataan Ruang',
                        'DPRKP'         => 'Perumahan Rakyat dan Kawasan Permukiman',
                        'Perlindungan Masyarakat' => 'Ketentraman, Ketertiban Umum, dan Pelindungan Masyarakat',
                        'Sosial'        => 'Sosial',
                        'Tenaga Kerja'  => 'Tenaga Kerja',
                        'PPPAKP'        => 'Pemberdayaan Perempuan dan Perlindungan Anak',
                        'Pangan'        => 'Pangan',
                        'Pertanahan'    => 'Pertanahan',
                        'Lingkuangan Hidup' => 'Lingkuangan Hidup',
                        'CAPIL'         => 'Administrasi Kependudukan dan Pencataan Sipil',
                        'Masyarakat dan Desa' => 'Pemberdayaan Masyarakat dan Desa',
                        'Pengendalia Penduduk' => 'Pengedalian Penduduk dan Keluarga Berencana',
                        'Perhubungan'   => 'Perhubungan',
                        'Kominfo'       => 'Komunikasi dan Informatika',
                        'Koperasi'      => 'Koperasi, Usaha Kecil, dan Menengah',
                        'DPM'           => 'Penanaman Modal',
                        'Kepemudaan dan Olahraga' => 'Kepemudaan dan Olahraga',
                        'statistik'     => 'Statistik',
                        'Persandian'    => 'Persandian',
                        'Kebudayaan'    => 'Kebudayaan',
                        'Perpustakaan'  => 'Perpustakaan',
                        'Arsip'         => 'Kearsipan',
                        'Kelautan'      => 'Kelautan dan Perikanan',
                        'Pariwisata'    => 'Pariwisata',
                        'Pertanian'     => 'Pertanian',
                        'Kehutanan'     => 'Kehutanan',
                        'Energi dan Sumber Daya Mineral' => 'Energi dan Sumber Daya Mineral',
                        'Perdagangan'   => 'Perdagangan',
                        'Perindustrian' => 'Perindustrian',
                        'Transmigrasi'  => 'Transmigrasi',
                        'Perencanaan'   => 'Perencanaan',
                        'Keuangan'      => 'Keuangan',
                        'Kepegawaian'   => 'Kepegawaian',
                        'Pendidikan dan Pelatihan' => 'Pendidikan dan Pelatihan',
                        'Penelitian dan Pengembangan' => 'Penelitian dan Pengembangan',
                        'Fungsi Lain'   => 'Fungsi lain sesuai dengan ketentuan perundang-undangan',
                    ])->native(false),
                TextInput::make('koordinat_inovasi')
                    ->label('Koordinat')
                    ->required(),
                DatePicker::make('waktu_ujicoba_inovasi')
                    ->label('Waktu Ujicoba (Min. 6 Bulan)')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->timezone('Asia/Jakarta')
                    ->closeOnDateSelection()
                    ->maxDate(now()->subMonths(6))
                    ->required(),
                DatePicker::make('waktu_implementasi_inovasi')
                    ->label('Waktu Implementasi (Min. 6 Bulan)')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->timezone('Asia/Jakarta')
                    ->closeOnDateSelection()
                    ->maxDate(now()->subMonths(6))
                    ->required(),
                DatePicker::make('waktu_pengembangan_inovasi')
                    ->label('Waktu Pengembangan')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->timezone('Asia/Jakarta')
                    ->closeOnDateSelection()
                    ->maxDate(now()->subMonths(6)),
                RichEditor::make('rancang_bangun_inovasi')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('tujuan_inovasi')
                    ->columnSpanFull()
                    ->rows(5)
                    ->required(),
                Textarea::make('manfaat_inovasi')
                    ->columnSpanFull()
                    ->rows(5)
                    ->required(),
                Textarea::make('hasil_inovasi')
                    ->columnSpanFull()
                    ->rows(5)
                    ->required(),
                FileUpload::make('anggaran_inovasi')
                    ->label('Anggaran')
                    ->disk('public')
                    ->directory('anggaran_inovasi')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                FileUpload::make('profilbisnis_inovasi')
                    ->label('Profil Bisnis')
                    ->disk('public')
                    ->directory('profilbisnis_inovasi')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                FileUpload::make('hki_inovasi')
                    ->label('Dokumen HKI')
                    ->disk('public')
                    ->directory('hki-document')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                FileUpload::make('penghargaan_inovasi')
                    ->label('Penghargaan')
                    ->disk('public')
                    ->directory('penghargaan-inovasi')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_inovasi')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('nama_inisiator')
                    ->searchable(),
                TextColumn::make('tahapan_inovasi'),
                TextColumn::make('jenis_inovasi'),
                TextColumn::make('bentuk_inovasi')
                    ->wrap(),
                TextColumn::make('waktu_implementasi_inovasi'),
                TextColumn::make('tahun'),
                TextColumn::make('indikators.kematangan')->label('Kematangan'),
            ])
            // ->modifyQueryUsing(function (Builder $query) {
            //     $query->where('user_id', auth()->id())->with('indikators'); // Filters records by the authenticated user's ID
            // })
            ->emptyStateHeading('Tidak ada data inovasi')
            ->filters([
                SelectFilter::make('bentuk_inovasi')
                    ->label('Bentuk Inovasi')
                    ->options([
                        'Inovasi Pelayanan Publik' => 'Inovasi Pelayanan Publik',
                        'Inovasi Tata Kelola' => 'Inovasi Tata Kelola Pemerintahan Daerah',
                        'Inovasi Pendidikan' => 'Inovasi Pendidikan',
                        'Invosasi Daerah Lainnya' => 'Inovasi Daerah lainnya sesuai dengan Urusan Pemerintahan yang mejadi Kewenangan Daerah',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('Indikator')
                    ->url(fn($record): string => InovasiPerangkatDaerahResource::getUrl('indikator', ['record' => $record]))
                    ->label('')
                    ->icon('heroicon-o-folder'),
                Tables\Actions\Action::make('Pdf')
                    ->label('')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->action(function (InovasiPerangkatDaerah $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHtml(
                                Blade::render('pdf', ['record' => $record])
                            )->stream();
                        }, $record->nama_inovasi . '.pdf');
                    }),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInovasiPerangkatDaerahs::route('/'),
            'create' => Pages\CreateInovasiPerangkatDaerah::route('/create'),
            'edit' => Pages\EditInovasiPerangkatDaerah::route('/{record}/edit'),
            'indikator' => Pages\IndikatorInovasiPerangkatDaerah::route('/{record}/indikator')
        ];
    }
}

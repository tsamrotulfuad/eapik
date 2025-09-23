<?php

namespace App\Filament\Kemiskinan\Resources\BantuanResource\Pages;

use App\Models\Bantuan;
use App\Models\Individu;
use Filament\Tables\Table;
use App\Imports\IndividuImport;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Kemiskinan\Resources\BantuanResource;

class KelolaPenerima extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = BantuanResource::class;
    protected static string $view = 'filament.kemiskinan.resources.bantuan-resource.pages.kelola-penerima';

    public Bantuan $bantuan;

    public function mount($record): void
    {
        $this->bantuan = Bantuan::findOrFail($record);
    }

    public function getTitle(): string
    {
        return 'Kelola Penerima - ' . $this->bantuan->nama_bantuan;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Individu::query()
                    ->whereHas('bantuans', fn ($q) => $q->where('bantuan_id', $this->bantuan->id))
                    ->with(['bantuans' => fn ($q) => $q->where('bantuan_id', $this->bantuan->id)])
            )
            ->columns([
                TextColumn::make('nama')->label('Nama')->searchable()->sortable(),
                TextColumn::make('nik')->label('NIK')->searchable(),
                TextColumn::make('jenis_kelamin')->label('Jenis Kelamin')->sortable(),
                TextColumn::make('bantuans.0.pivot.tanggal_terima')->label('Tanggal Terima')->date(),
            ])
            ->headerActions([
                Action::make('tambahBanyak')
                    ->label('Tambah Banyak Penerima')
                    ->icon('heroicon-o-user-plus')
                    ->form([
                        Select::make('individu_ids')
                            ->label('Pilih Individu')
                            ->multiple()
                            ->options(fn () => Individu::whereDoesntHave('bantuans', fn($q) => $q->where('bantuan_id', $this->bantuan->id))
                                                        ->orderBy('nama')
                                                        ->pluck('nama', 'id')
                                                        ->toArray()
                            )
                            ->searchable()
                            ->required(),

                        DatePicker::make('tanggal_terima')
                            ->label('Tanggal Terima')
                            ->default(now())
                            ->required(),
                    ])
                    ->action(function (array $data, Page $livewire): void {
                        $ids = $data['individu_ids'] ?? [];
                        $tanggal = $data['tanggal_terima'] ?? null;

                        if (empty($ids)) {
                            Notification::make()->title('Tidak ada individu terpilih')->danger()->send();
                            return;
                        }

                        foreach ($ids as $id) {
                            $this->bantuan->individus()->syncWithoutDetaching([
                                $id => ['tanggal_terima' => $tanggal],
                            ]);
                        }

                        Notification::make()
                            ->title('Penerima berhasil ditambahkan')
                            ->body(count($ids) . ' individu ditambahkan.')
                            ->success()
                            ->send();
                    }),
                    Action::make('import')
                        ->label('Import')
                        ->form([
                            FileUpload::make('file')
                                ->label('Upload File Excel')
                                ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                                ->disk('local')
                                ->visibility('private')
                                ->directory('imports/individu')
                                ->preserveFilenames()
                                ->maxSize(64000)
                                ->required(),
                        ])
                ->action(function (array $data): void {
                    $relative = $data['file']; // ex: "imports/xxx.xlsx"
                    $path = storage_path('app/' . $relative);

                    try {
                        Excel::queueImport(new IndividuImport, $path);
                    } catch (\Exception $e) {
                        Log::error('Import gagal: ' . $e->getMessage());
                        throw $e; // biarkan Filament menampilkan error
                    } finally {
                        // hapus file upload agar storage tidak penuh
                        Storage::disk('local')->delete($relative);
                    }
                })
                ->color('warning')
                ->icon('heroicon-o-arrow-down-tray'),
            ])
             ->actions([
                EditAction::make()
                    ->label('Ubah Tanggal')
                    ->form([
                        DatePicker::make('tanggal_terima')
                            ->label('Tanggal Terima')
                            ->required(),
                    ])
                    ->mutateFormDataUsing(fn (array $data, Model $record) => [
                        'tanggal_terima' => $data['tanggal_terima'],
                    ])
                    ->using(function (Model $record, array $data, Page $livewire): void {
                        $bantuan = $livewire->bantuan;

                        $bantuan->individus()->updateExistingPivot(
                            $record->id,
                            ['tanggal_terima' => $data['tanggal_terima']]
                        );
                    }),

                DetachAction::make()->label('Hapus Penerima')
                    ->using(function (Model $record, Page $livewire) {
                        $bantuan = $livewire->bantuan;

                        $bantuan->individus()->detach($record->id);
                    }),
            ])
            ->bulkActions([
                DetachBulkAction::make()->label('Hapus Terpilih')
                ->using(function ($records, Page $livewire) {
                    $bantuan = $livewire->bantuan;

                    $bantuan->individus()->detach($records->pluck('id'));
                }),
            ]);
    }

    // helper stats
    public function getStats(): array
    {
        $total = $this->bantuan->individus()->count();
        $male = $this->bantuan->individus()->where('jenis_kelamin', 'Laki-laki')->count();
        $female = $this->bantuan->individus()->where('jenis_kelamin', 'Perempuan')->count();

        return [
            'total' => $total,
            'male' => $male,
            'female' => $female,
        ];
    }
}
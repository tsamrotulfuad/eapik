<?php

namespace App\Filament\Kemiskinan\Resources\BantuanResource\Pages;

use App\Models\Bantuan;
use App\Models\Individu;
use Filament\Tables\Table;
use App\Imports\IndividuImport;
use App\Imports\PenerimaImport;
use Illuminate\Http\UploadedFile;
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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                     // Import Excel
                    Action::make('importExcel')
                        ->label('Import Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->form([
                                FileUpload::make('file')
                                    ->label('Pilih File Excel')
                                    ->disk('public') // simpan di disk public
                                    ->directory('imports/penerima') // folder khusus
                                    ->preserveFilenames() // opsional: supaya nama file tetap
                                    ->acceptedFileTypes([
                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                        'application/vnd.ms-excel'
                                    ])
                                    ->required(),
                            ])
                        ->action(function (array $data) {
                            // $data['file'] akan berisi string relatif ke dalam disk public
                            $relativePath = $data['file']; // contoh: imports/penerima/file.xlsx
                            $fullPath = Storage::disk('public')->path($relativePath);

                            if (! file_exists($fullPath)) {
                                Notification::make()
                                    ->title('Gagal Import')
                                    ->body("File $fullPath tidak ditemukan.")
                                    ->danger()
                                    ->send();
                                return;
                            }

                            Excel::import(new PenerimaImport($this->bantuan->id), $fullPath);

                            Notification::make()
                                ->title('Import Berhasil')
                                ->body('Data penerima berhasil diimport.')
                                ->success()
                                ->send();
                        }),  
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
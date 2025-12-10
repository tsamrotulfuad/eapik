<?php

namespace App\Filament\Brida\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Inovasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Brida\Resources\InovasiResource\Pages;
use App\Filament\Brida\Resources\InovasiResource\RelationManagers;

class InovasiResource extends Resource
{
    protected static ?string $model = Inovasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $navigationLabel = 'Inovasi Pelayanan Publik ';

    protected static ?string $navigationGroup = 'Kirim IGA';

    protected static ?string $breadcrumb = 'Inovasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('no_regis_iga')
                    ->label('Nomor Registrasi IGA')
                    ->required(),
                TextInput::make('kematangan_inovasi')
                    ->numeric()
                    ->label('Kematangan')
                    ->required(),
                TextInput::make('nama_inovasi')
                    ->label('Nama Inovasi')
                    ->required(),
                TextInput::make('nama_inisiator')
                    ->label('Nama Inisiator')
                    ->required(),
                TextInput::make('inisiator_inovasi')
                    ->label('Inisiator')
                    ->required(),
                Select::make('jenis_inovasi')
                    ->options([
                        'Digital' => 'Digital',
                        'Non-Digital' => 'Non-Digital',
                    ])->native(false),
                TextInput::make('klasifikasi_inovasi')
                    ->label('Klasifikasi')
                    ->required(),
                TextInput::make('bentuk_inovasi')
                    ->label('Bentuk Inovasi')
                    ->required(),
                TextInput::make('asta_cita_inovasi')
                    ->label('Asta Cita')
                    ->required(),
                TextInput::make('urusan_inovasi')
                    ->label('Urusan')
                    ->required(),
                DatePicker::make('waktu_ujicoba')
                    ->label('Waktu Ujicoba')
                    ->required(),
                DatePicker::make('waktu_penerapan')
                    ->label('Waktu Penerapan')
                    ->required(),
                TextInput::make('koordinat_inovasi')
                    ->label('Koordinat')
                    ->required(),
                TextInput::make('anggaran_inovasi')
                    ->label('Anggaran (Link)'),
                TextInput::make('profil_bisnis_inovasi')
                    ->label('Profil Bisnis (Link)'),
                TextInput::make('doc_haki_inovasi')
                    ->label('Dokumen HAKI (Link)'),
                TextInput::make('penghargaan_inovasi')
                    ->label('Penghargaan (Link)'),
                Select::make('tahun_iga')
                    ->label('Tahun')
                    ->options([
                        '2025' => '2025',
                    ])->native(false)
                    ->required(),
                FileUpload::make('file_inovasi_iga')
                    ->label('Upload File IGA')
                    ->directory('iga')
                    ->preserveFilenames()
                    ->openable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_regis_iga')->label('Nomor Register IGA'),
                TextColumn::make('nama_inovasi')->label('Nama Inisiator')->searchable(),
                TextColumn::make('nama_inisiator')->label('Nama Inisiator'),
                TextColumn::make('inisiator_inovasi')->label('Inisiator'),
                TextColumn::make('jenis_inovasi')->label('Jenis'),
                TextColumn::make('bentuk_inovasi')->label('Bentuk'),
                TextColumn::make('urusan')->label('urusan'),
                TextColumn::make('kematangan_inovasi')->label('Kematangan')->sortable(),
                TextColumn::make('tahun_iga')->label('Tahun'),
            ])
            ->emptyStateHeading('Tidak ada data')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                    ->after(function (Inovasi $record) {
                        // delete file
                        if ($record->file_inovasi_iga) {
                            Storage::disk('public')->delete($record->file_inovasi_iga);
                        }
                    }),
                ])
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
            'index' => Pages\ListInovasis::route('/'),
            'create' => Pages\CreateInovasi::route('/create'),
            'edit' => Pages\EditInovasi::route('/{record}/edit'),
        ];
    }
}

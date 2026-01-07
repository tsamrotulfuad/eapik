<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Usulan;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UsulanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UsulanResource\RelationManagers;

class UsulanResource extends Resource
{
    protected static ?string $model = Usulan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Perencanaan";

    protected static ?string $navigationLabel = 'Usulan';

    protected static ?string $breadcrumb = "Usulan";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pengusul')->label('Nama Pengusul')->required(),
                DatePicker::make('tanggal_usulan')->label('Tanggal Usulan')->native(false)->required(),
                Textarea::make('isu_permasalahan_usulan')->label('Isu / Permasalahan')->required(),
                Textarea::make('lokasi_permasalahan')->label('Lokasi Permasalahan')->required(),
                Select::make('kecamatan')
                    ->label('Kecamatan')
                        ->options([
                            'Bugul Kidul' => 'Bugul Kidul',
                            'Gadingrejo' => 'Gadingrejo',
                            'Panggungrejo' => 'Panggungrejo',
                            'Purworejo' => 'Purworejo',
                        ])
                    ->live()
                    ->reactive()
                    ->native(false)
                    ->required(),
                Select::make('kelurahan')
                    ->label('Kelurahan')
                        ->options(fn (Get $get): array => match ($get('kecamatan')) {
                            'Bugul Kidul' => [
                                'Blandongan' => 'Blandongan',
                                'Kepel' => 'Kepel',
                                'Tapaan' => 'Tapaan',
                                'Bakalan' => 'Kepel',
                                'Krampyangan' => 'Krampyangan',
                                'Bugul Kidul' => 'Bugul Kidul',
                            ],
                            'Gadingrejo' => [
                                'Karangketug' => 'Karangketug',
                                'Gentong' => 'Gentong',
                                'Sebani' => 'Sebani',
                                'Petahunan' => 'Petahunan',
                                'Bukir' => 'Bukir',
                                'Randusari' => 'Randusari',
                                'Krapyakrejo' => 'Krapyakrejo',
                                'Gadingrejo' => 'Gadingrejo',
                            ],
                            'Panggungrejo' => [
                                'Karanganyar' => 'Karanganyar',
                                'Tambaan' => 'Tambaan',
                                'Trajeng' => 'Trajeng',
                                'Bangilan' => 'Bangilan',
                                'Kebonsari' => 'Kebonsari',
                                'Mayangan' => 'Mayangan',
                                'Ngemplakrejo' => 'Ngemplakrejo',
                                'Petamanan' => 'Petamanan',
                                'Pekuncen' => 'Pekuncen',
                                'Bugul Lor' => 'Bugul Lor',
                                'Kandangsapi' => 'Kandangsapi',
                                'Panggungrejo' => 'Panggungrejo',
                                'Mandaranrejo' => 'Mandaranrejo',
                            ],
                            'Purworejo' => [
                                'Pohjentrek' => 'Pohjentrek',
                                'Wirogunan' => 'Wirogunan',
                                'Tembokrejo' => 'Tembokrejo',
                                'Purutrejo' => 'Purutrejo',
                                'Kebonagung' => 'Kebonagung',
                                'Purworejo' => 'Purworejo',
                                'Sekargadung' => 'Sekargadung',
                            ],
                            default => [],
                        })
                        ->native(false)->required(),
                Textarea::make('nama_usulan')->label('Nama Usulan'),
                Select::make('urusan_pd')
                    ->label('Urusan Perangkat Daerah')
                    ->options(function () {
                        return User::role('perangkat_daerah')->pluck('name', 'id');
                    })
                    ->native(false)
                    ->required(),
                Textarea::make('keterangan_usulan')->label('Keterangan Usulan'),
                Select::make('status_usulan')
                    ->label('Status Usulan')
                        ->options([
                            'verifikasi' => 'Verifikasi',
                            'diterima' => 'Diterima',
                            'ditolak' => 'Ditolak',
                        ])
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
           ->columns([
                TextColumn::make('nama_pengusul')->label('Nama Pengusul')
                ->wrap()
                ->searchable(),
                TextColumn::make('tanggal_usulan')->label('Tanggal Usulan'),
                TextColumn::make('lokasi_permasalahan')->label('Lokasi Permasalahan')
                ->wrap(),
                TextColumn::make('nama_usulan')->label('Nama Usulan'),
                TextColumn::make('status_usulan')
                    ->label('Status Usulan')
                    ->formatStateUsing(fn (string $state): string => ucwords($state))
                    ->badge(),
                TextColumn::make('user.name')->label('Asal Usulan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsulans::route('/'),
            'create' => Pages\CreateUsulan::route('/create'),
            'edit' => Pages\EditUsulan::route('/{record}/edit'),
        ];
    }
}

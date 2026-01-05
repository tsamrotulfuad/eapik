<?php

namespace App\Filament\Perencanaan\Resources;

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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Perencanaan\Resources\UsulanResource\Pages;
use App\Filament\Perencanaan\Resources\UsulanResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class UsulanResource extends Resource
{
    protected static ?string $model = Usulan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Pra Kamus";

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pengusul'),
                TextColumn::make('tanggal_usulan'),
            ])
            ->filters([
                //
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('user_id', auth()->id()); // Filters records by the authenticated user's ID
            })
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

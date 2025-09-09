<?php

namespace App\Filament\Kemiskinan\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Individu;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Kemiskinan\Resources\IndividuResource\Pages;
use App\Filament\Kemiskinan\Resources\IndividuResource\RelationManagers;

class IndividuResource extends Resource
{
    protected static ?string $model = Individu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Individu';

    protected static ?string $navigationGroup = 'Penerima';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('nik')
                    ->label('NIK'),
                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->displayFormat('d/m/Y')
                    ->reactive() // agar langsung update
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('umur', Carbon::parse($state)->age); // setting umur
                        } else {
                            $set('umur', null);
                        }
                    })
                    ->required(),
                TextInput::make('umur')
                    ->label('Umur')
                    ->disabled()
                    ->dehydrated(false), // tidak simpan ke DB, hanya ditampilkan
                Select::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Select::make('hubungan_keluarga')
                    ->options([
                        'Suami' => 'Suami',
                        'Istri' => 'Istri',
                    ]),
                Select::make('status_kawin')
                    ->options([
                        'Kawin' => 'Kawin',
                        'Tidak Kawin' => 'Tidak Kawin',
                    ]),
                TextInput::make('pekerjaan'),
                TextInput::make('status_pekerjaan'),
                TextInput::make('pendidikan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),
                TextColumn::make('umur') // menampilkan umur, koding ada di EditResource
                    ->getStateUsing(fn ($record) => $record->tanggal_lahir 
                    ? Carbon::parse($record->tanggal_lahir)->age . ' tahun'
                    : '-'),
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
            'index' => Pages\ListIndividus::route('/'),
            'create' => Pages\CreateIndividu::route('/create'),
            'edit' => Pages\EditIndividu::route('/{record}/edit'),
        ];
    }
}

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
use App\Filament\Kemiskinan\Resources\BantuanResource\RelationManagers\BantuanRelationManager;

class IndividuResource extends Resource
{
    protected static ?string $model = Individu::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Individu';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('nik')
                    ->label('NIK')
                    ->required()->unique(ignoreRecord: true),
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
                    ])->native(false),
                Select::make('hubungan_keluarga')
                    ->options([
                        'Kepala Keluarga' => 'Kepala Keluarga',
                        'Istri/Suami'     => 'Istri/Suami',
                        'Anak'            => 'Anak',
                        'Lainnya'         => 'Lainnya',
                    ])->native(false),
                Select::make('status_kawin')
                    ->options([
                        'Kawin' => 'Kawin',
                        'Belum kawin' => 'Belum kawin',
                        'Cerai hidup' => 'Cerai hidup',
                        'Cerai mati' => 'Cerai mati',
                    ])->native(false),
                TextInput::make('pekerjaan'),
                TextInput::make('status_pekerjaan'),
                TextInput::make('pendidikan'),
                Forms\Components\Toggle::make('is_verified')
                    ->label('Terverifikasi')
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        // otomatis set verified_at kalau dicentang
                        $set('verified_at', $state ? Carbon::now() : null);
                    }),

                Forms\Components\DateTimePicker::make('verified_at')
                    ->label('Tanggal Verifikasi')
                    ->disabled()
                    ->dehydrated(false), // tidak ikut submit, biar tidak menimpa nilai otomatis
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
                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verifikasi')
                    ->boolean(),
                Tables\Columns\TextColumn::make('verified_at')
                    ->label('Tanggal Verifikasi')
                    ->dateTime(),
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
            BantuanRelationManager::class,
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

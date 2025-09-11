<?php

namespace App\Filament\Kemiskinan\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Keluarga;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Kemiskinan\Resources\KeluargaResource\Pages;
use App\Filament\Kemiskinan\Resources\KeluargaResource\RelationManagers;
use App\Filament\Kemiskinan\Resources\BantuanResource\RelationManagers\BantuanRelationManager;
use App\Filament\Kemiskinan\Resources\IndividuResource\RelationManagers\IndividuesRelationManager;

class KeluargaResource extends Resource
{
    protected static ?string $model = Keluarga::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Data Kemiskinan';
    protected static ?string $navigationLabel = 'Keluarga';
    protected static ?string $pluralModelLabel = 'Keluarga';
    protected static ?string $modelLabel = 'Keluarga';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_kk')
                    ->label('Nomor KK')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(16),
                Forms\Components\TextInput::make('kepala_keluarga')
                    ->label('Kepala Keluarga')
                    ->required(),
                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('no_kk')
                    ->label('Nomor KK')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kepala_keluarga')
                    ->label('Kepala Keluarga')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50),

                Tables\Columns\TextColumn::make('individues_count')
                    ->counts('individues')
                    ->label('Jumlah Anggota'),

                Tables\Columns\TextColumn::make('bantuans_count')
                    ->counts('bantuans')
                    ->label('Jumlah Bantuan'),
            ])
            ->filters([
                Tables\Filters\Filter::make('with_bantuan')
                    ->label('Hanya yang mendapat bantuan')
                    ->query(fn ($query) => $query->has('bantuans')),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            IndividuesRelationManager::class,
            BantuanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeluargas::route('/'),
            'create' => Pages\CreateKeluarga::route('/create'),
            'edit' => Pages\EditKeluarga::route('/{record}/edit'),
        ];
    }
}

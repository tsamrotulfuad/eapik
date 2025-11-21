<?php

namespace App\Filament\Kemiskinan\Resources;

use App\Filament\Kemiskinan\Resources\UsulanBantuanResource\Pages;
use App\Filament\Kemiskinan\Resources\UsulanBantuanResource\RelationManagers;
use App\Models\UsulanBantuan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsulanBantuanResource extends Resource
{
    protected static ?string $model = UsulanBantuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Usulan Bantuan';

    protected static ?string $navigationGroup = 'Perencanaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('usulan_bantuan'),
                Select::make('tahun')
                ->options([
                    '2026' => '2026',
                    '2025' => '2025',
                    '2024' => '2024',
                ])->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('usulan_bantuan'),
                TextColumn::make('tahun')
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
            'index' => Pages\ListUsulanBantuans::route('/'),
            'create' => Pages\CreateUsulanBantuan::route('/create'),
            'edit' => Pages\EditUsulanBantuan::route('/{record}/edit'),
        ];
    }
}

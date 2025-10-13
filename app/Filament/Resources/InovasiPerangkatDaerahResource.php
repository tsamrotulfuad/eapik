<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InovasiPerangkatDaerahResource\Pages;
use App\Filament\Resources\InovasiPerangkatDaerahResource\RelationManagers;
use App\Models\InovasiPerangkatDaerah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InovasiPerangkatDaerahResource extends Resource
{
    protected static ?string $model = InovasiPerangkatDaerah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Inovasi Perangkat Daerah';

    protected static ?string $navigationGroup = 'Inovasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInovasiPerangkatDaerahs::route('/'),
            'create' => Pages\CreateInovasiPerangkatDaerah::route('/create'),
            'edit' => Pages\EditInovasiPerangkatDaerah::route('/{record}/edit'),
        ];
    }
}

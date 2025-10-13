<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InovasiMasyarakatResource\Pages;
use App\Filament\Resources\InovasiMasyarakatResource\RelationManagers;
use App\Models\InovasiMasyarakat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InovasiMasyarakatResource extends Resource
{
    protected static ?string $model = InovasiMasyarakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Inovasi Masyarakat';

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
            'index' => Pages\ListInovasiMasyarakats::route('/'),
            'create' => Pages\CreateInovasiMasyarakat::route('/create'),
            'edit' => Pages\EditInovasiMasyarakat::route('/{record}/edit'),
        ];
    }
}

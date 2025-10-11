<?php

namespace App\Filament\Superadmin\Resources;

use App\Filament\Superadmin\Resources\BantuanResource\Pages;
use App\Filament\Superadmin\Resources\BantuanResource\RelationManagers;
use App\Models\Bantuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BantuanResource extends Resource
{
    protected static ?string $model = Bantuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Bantuan';

    protected static ?string $navigationGroup = 'Kemiskinan';
    protected static ?int $navigationSort = 1;

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
            'index' => Pages\ListBantuans::route('/'),
            'create' => Pages\CreateBantuan::route('/create'),
            'edit' => Pages\EditBantuan::route('/{record}/edit'),
        ];
    }
}

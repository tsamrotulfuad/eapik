<?php

namespace App\Filament\Superadmin\Resources;

use App\Filament\Superadmin\Resources\IndividuResource\Pages;
use App\Filament\Superadmin\Resources\IndividuResource\RelationManagers;
use App\Models\Individu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndividuResource extends Resource
{
    protected static ?string $model = Individu::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Individu';
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
            'index' => Pages\ListIndividus::route('/'),
            'create' => Pages\CreateIndividu::route('/create'),
            'edit' => Pages\EditIndividu::route('/{record}/edit'),
        ];
    }
}

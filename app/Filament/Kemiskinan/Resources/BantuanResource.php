<?php

namespace App\Filament\Kemiskinan\Resources;

use App\Filament\Kemiskinan\Resources\BantuanResource\Pages;
use App\Filament\Kemiskinan\Resources\BantuanResource\RelationManagers;
use App\Models\Bantuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BantuanResource extends Resource
{
    protected static ?string $model = Bantuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Bantuan';

    protected static ?string $title = 'Custom Page Title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_bantuan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_bantuan')->label('Nama Bantuan'),
                TextColumn::make('user.name')->label('Perangkat Daerah')
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

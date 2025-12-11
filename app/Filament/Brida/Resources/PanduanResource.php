<?php

namespace App\Filament\Brida\Resources;

use App\Filament\Brida\Resources\PanduanResource\Pages;
use App\Filament\Brida\Resources\PanduanResource\RelationManagers;
use App\Models\Panduan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PanduanResource extends Resource
{
    protected static ?string $model = Panduan::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Panduan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_panduan')
                    ->required(),
                FileUpload::make('file_panduan')
                    ->label('File Panduan')
                    ->disk('public')
                    ->directory('panduan-inovasi')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->required(),
                Textarea::make('keterangan_panduan')
                    ->required(),
                Select::make('tahun')
                    ->options([
                        '2025' => '2025',
                    ]
                    )->native(false)
                    ->required(),
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
            'index' => Pages\ListPanduans::route('/'),
            'create' => Pages\CreatePanduan::route('/create'),
            'edit' => Pages\EditPanduan::route('/{record}/edit'),
        ];
    }
}

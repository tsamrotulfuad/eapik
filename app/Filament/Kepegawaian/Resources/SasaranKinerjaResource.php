<?php

namespace App\Filament\Kepegawaian\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SasaranKinerja;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Kepegawaian\Resources\SasaranKinerjaResource\Pages;
use App\Filament\Kepegawaian\Resources\SasaranKinerjaResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class SasaranKinerjaResource extends Resource
{
    protected static ?string $model = SasaranKinerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-plus';

    protected static ?string $navigationLabel = 'Sasaran Kinerja';

    protected static ?string $breadcrumb = "Sasaran Kinerja";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_skp')->label('SKP'),
                Select::make('tahun')
                     ->options([
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                        '2026' => '2026',
                        '2027' => '2027',
                    ])
                    ->native(false),
                FileUpload::make('file_skp')
                    ->label('Upload File')
                    ->directory('skps')
                    ->preserveFilenames()
                    ->openable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_skp')->label('SKP'),
                TextColumn::make('tahun')->label('Tahun')
            ])
            ->emptyStateHeading('Tidak ada data')
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
            'index' => Pages\ListSasaranKinerjas::route('/'),
            'create' => Pages\CreateSasaranKinerja::route('/create'),
            'edit' => Pages\EditSasaranKinerja::route('/{record}/edit'),
        ];
    }
}

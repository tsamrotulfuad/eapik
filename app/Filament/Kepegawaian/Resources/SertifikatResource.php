<?php

namespace App\Filament\Kepegawaian\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Sertifikat;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Kepegawaian\Resources\SertifikatResource\Pages;
use App\Filament\Kepegawaian\Resources\SertifikatResource\RelationManagers;

class SertifikatResource extends Resource
{
    protected static ?string $model = Sertifikat::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationLabel = 'Sertifikat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nomor_sert')
                    ->label('Nomor Sertifikat'),
                TextInput::make('acara_sert')
                    ->label('Acara'),
                DatePicker::make('tanggal_sert')
                    ->label('Tanggal Sertifikat'),
                FileUpload::make('file_sert')
                    ->label('Upload File')
                    ->directory('sertifikats')
                    ->preserveFilenames()
                    ->openable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('user_id', auth()->id()); // Filters records by the authenticated user's ID
            })
            ->emptyStateHeading('Tidak ada data')
            ->columns([
                TextColumn::make('nomor_sert')->label('Nomor Sertifikat'),
                TextColumn::make('acara_sert')->label('Acara')->limit(50),
                TextColumn::make('tanggal_sert')->label('Tanggal Sertifikat')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->after(function (Sertifikat $record) {
                    // delete file
                    if ($record->file_sert) {
                        Storage::disk('public')->delete($record->file_sert);
                    }
                }),
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
            'index' => Pages\ListSertifikats::route('/'),
            'create' => Pages\CreateSertifikat::route('/create'),
            'edit' => Pages\EditSertifikat::route('/{record}/edit'),
        ];
    }
}

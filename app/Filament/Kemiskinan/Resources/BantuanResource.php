<?php

namespace App\Filament\Kemiskinan\Resources;

use App\Filament\Kemiskinan\Resources\BantuanResource\Pages;
use App\Models\Bantuan;
use Filament\Forms;
use Filament\Forms\Components\Select;
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

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Bantuan';

    protected static ?string $navigationGroup = 'Monitoring dan Evaluasi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_bantuan')->required(),
                Forms\Components\TextInput::make('deskripsi'),
                Select::make('tahun')
                     ->options([
                        '2025' => '2025',
                        '2026' => '2026',
                        '2027' => '2027',
                    ])
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_bantuan')->label('Nama Bantuan')->searchable(),
                TextColumn::make('user.name')->label('Perangkat Daerah'),
                TextColumn::make('tahun')->label('Tahun'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('downloadTemplate')
                    ->label('Template')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(route('template.penerima'))
                    ->openUrlInNewTab(),
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
            'kelola-penerima' => Pages\KelolaPenerima::route('/{record}/kelola-penerima'),
        ];
    }
}

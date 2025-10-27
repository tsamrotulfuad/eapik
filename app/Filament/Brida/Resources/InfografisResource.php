<?php

namespace App\Filament\Brida\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bidang;
use App\Models\Kajian;
use Filament\Forms\Form;
use App\Models\Infografis;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Brida\Resources\InfografisResource\Pages;
use App\Filament\Brida\Resources\InfografisResource\RelationManagers;

class InfografisResource extends Resource
{
    protected static ?string $model = Infografis::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Infografis';

    protected static ?string $navigationGroup = 'Kajian Daerah';

    protected static ?string $breadcrumb = 'Infografis';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_infografis'),
                TextInput::make('slug'),
                Textarea::make('deskripsi_infografis')
                    ->columnSpanFull(),
                Select::make('kategori')
                    ->options([
                            'Tematik' => 'Tematik',
                        ])
                    ->native(false),
                TagsInput::make('tag')
                    ->label('Tags'),
                Select::make('tahun_infografis')
                    ->options([
                        '2019' => '2019',
                        '2020' => '2020',
                        '2021' => '2021',
                        '2022' => '2022',
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ])
                    ->native(false),
                Select::make('bidang_id')
                    ->label('Bidang')
                    ->options(Bidang::all()->pluck('nama_bidang', 'id'))
                    ->searchable(),
                Select::make('kajian_id')
                    ->label('Kajian')
                    ->options(Kajian::all()->pluck('nama_kajian', 'id'))
                    ->searchable(),
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
            'index' => Pages\ListInfografis::route('/'),
            'create' => Pages\CreateInfografis::route('/create'),
            'edit' => Pages\EditInfografis::route('/{record}/edit'),
        ];
    }
}

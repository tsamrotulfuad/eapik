<?php

namespace App\Filament\Brida\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bidang;
use App\Models\Kajian;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Request;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Brida\Resources\KajianResource\Pages;
use App\Filament\Brida\Resources\KajianResource\RelationManagers;
use JeffersonGoncalves\Filament\QrCodeField\Forms\Components\QrCodeInput;

class KajianResource extends Resource
{
    protected static ?string $model = Kajian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Kajian';

    protected static ?string $navigationGroup = 'Kajian Daerah';

    protected static ?string $breadcrumb = 'Kajian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_kajian')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug'),
                Textarea::make('ringkasan_kajian'),
                Select::make('tahun_kajian')
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
                FileUpload::make('file_kajian')
                    ->label('File Kajian')
                    ->disk('public')
                    ->directory('file_kajian')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                TextInput::make('kajian_link')
                    ->label('Link Kajian'),
                Select::make('bidang_id')
                    ->label('Bidang')
                    ->options(Bidang::all()->pluck('nama_bidang', 'id'))
                    ->searchable(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kajian')->wrap(),
                TextColumn::make('ringkasan_kajian'),
                TextColumn::make('tahun_kajian'),
                TextColumn::make('bidang.nama_bidang'),
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
            'index' => Pages\ListKajians::route('/'),
            'create' => Pages\CreateKajian::route('/create'),
            'edit' => Pages\EditKajian::route('/{record}/edit'),
        ];
    }
}

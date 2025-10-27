<?php

namespace App\Filament\Brida\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bidang;
use App\Models\Kajian;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Infografis;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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
                TextInput::make('nama_infografis')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
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
                FileUpload::make('file_infografis')
                    ->label('File Infografis')
                    ->multiple()
                    ->disk('public')
                    ->directory('infografis')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                DatePicker::make('tanggal_publikasi')
                    ->label('Tanggal Publikasi'),
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
                ImageColumn::make('actors')
                    ->label('Infografis')
                    ->getStateUsing(function (Infografis $record) {
                        $profileUrls = collect($record->file_infografis)->toArray();

                        return $profileUrls;
                    })
                    ->height(120)
                    ->limit(1)
                    ->limitedRemainingText(),
                TextColumn::make('nama_infografis')
                    ->label('Nama Infografis')
                    ->wrap(),
                TextColumn::make('deskripsi_infografis')
                    ->label('Deskripsi Infografis') 
                    ->wrap()
                    ->limit(50),
                TextColumn::make('kategori')
                    ->label('Kategori'),
                TextColumn::make('tanggal_publikasi')
                    ->label('Tanggal Publikasi'),
                TextColumn::make('tahun_infografis')
                    ->label('Tahun'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function (Infografis $record) {
                        // delete file
                        if ($record->file_infografis) {
                            Storage::disk('public')->delete($record->file_infografis);
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
            'index' => Pages\ListInfografis::route('/'),
            'create' => Pages\CreateInfografis::route('/create'),
            'edit' => Pages\EditInfografis::route('/{record}/edit'),
        ];
    }
}

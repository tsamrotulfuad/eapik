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
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Support\Facades\Request;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
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
                FileUpload::make('cover_kajian')
                    ->label('Cover Kajian')
                    ->disk('public')
                    ->directory('cover_kajian')
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
                ImageColumn::make('cover_kajian')
                    ->height(120),
                TextColumn::make('nama_kajian')
                    ->wrap(),
                TextColumn::make('ringkasan_kajian')
                    ->wrap()
                    ->limit(50),
                TextColumn::make('tahun_kajian'),
                TextColumn::make('bidang.nama_bidang'),
                ViewColumn::make('qr_code')
                    ->label('QR Code')
                    ->view('filament.tables.columns.qr-code'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('nama_kajian')->label('Nama Inovasi'),
            TextEntry::make('slug')->label('Slug'),
            TextEntry::make('ringkasan_kajian')->label('Ringkasan Kajian'),

            // 🔹 Tampilkan QR Code di halaman detail
            Section::make('QR Code')
                ->schema([
                    ViewEntry::make('qr_code')
                        ->view('filament.infolists.components.qr-code'),
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

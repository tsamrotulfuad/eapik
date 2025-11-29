<?php

namespace App\Filament\Masyarakat\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\InovasiMasyarakat;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Masyarakat\Resources\InovasiMasyarakatResource\Pages;
use App\Filament\Masyarakat\Resources\InovasiMasyarakatResource\RelationManagers;

class InovasiMasyarakatResource extends Resource
{
    protected static ?string $model = InovasiMasyarakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationGroup = "Proposal";

    protected static ?string $navigationLabel = 'Inovasi Masyarakat';

    protected static ?string $breadcrumb = "Inovasi";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_inovasi')
                    ->columnSpanFull()
                    ->label('Nama Inovasi')
                    ->required(),
                TextInput::make('nama_inisiator')
                    ->label('Nama Inisiator')
                    ->required(),
                TextInput::make('ktp_inisiator')
                    ->label('Nomor KTP')
                    ->numeric()
                    ->maxLength(16)
                    ->minLength(16)
                    ->required(),
                TextInput::make('hp_inisiator')
                    ->label('Nomor HP')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->required(),
                Select::make('tahapan_inovasi')
                    ->options([
                        'Inisiatif' => 'Inisiatif',
                        'Uji coba' => 'Uji Coba',
                        'Penerapan' => 'Penerapan',
                    ])
                    ->native(false)
                    ->required(),
                Select::make('jenis_inovasi')
                    ->options([
                        'Digital' => 'Digital',
                        'Non Digital' => 'Non Digital',
                    ])
                    ->native(false)
                    ->required(),
                Select::make('bentuk_inovasi')
                    ->options([
                        'Aplikasi Teknologi' => 'Aplikasi dan Teknologi',
                        'Produk dan Jasa' => 'Produk dan Jasa',
                        'Program dan Pergerakan' => 'Program dan Pergerakan',
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('koordinat_inovasi')
                    ->label('Koordinat')
                    ->columnSpanFull()
                    ->required(),
                DatePicker::make('waktu_ujicoba_inovasi')
                    ->label('Waktu Ujicoba')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->timezone('Asia/Jakarta')
                    ->closeOnDateSelection()
                    // ->maxDate(now()->subMonths(6))
                    ->required(),
                DatePicker::make('waktu_implementasi_inovasi')
                    ->label('Waktu Implementasi')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->timezone('Asia/Jakarta')
                    ->closeOnDateSelection()
                    // ->maxDate(now()->subMonths(6))
                    ->required(),
                RichEditor::make('rancang_bangun_inovasi')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('tujuan_inovasi')
                    ->columnSpanFull()
                    ->rows(5)
                    ->required(),
                Textarea::make('manfaat_inovasi')
                    ->columnSpanFull()
                    ->rows(5)
                    ->required(),
                Textarea::make('hasil_inovasi')
                    ->columnSpanFull()
                    ->rows(5)
                    ->required(),
                FileUpload::make('ktp_file')
                    ->label('KTP (pdf/jpg)')
                    ->disk('public')
                    ->directory('ktp')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable()
                    ->required(),
                FileUpload::make('hki_inovasi')
                    ->label('Dokumen HKI (pdf)')
                    ->disk('public')
                    ->directory('hki-document')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                FileUpload::make('penghargaan_inovasi')
                    ->label('Penghargaan (pdf)')
                    ->disk('public')
                    ->directory('penghargaan-inovasi')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
                FileUpload::make('skt')
                    ->label('SK / SKT (pdf)')
                    ->disk('public')
                    ->directory('skt')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->openable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('user_id', auth()->id())->with('indikators'); // Filters records by the authenticated user's ID
            })
            ->columns([
                TextColumn::make('nama_inovasi')
                    ->wrap(),
                TextColumn::make('nama_inisiator'),
                TextColumn::make('tahapan_inovasi'),
                TextColumn::make('jenis_inovasi'),
                TextColumn::make('bentuk_inovasi'),
                TextColumn::make('waktu_implementasi_inovasi'),
                TextColumn::make('tahun'),
            ])
            ->emptyStateHeading('Tidak ada data inovasi')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Indikator')
                    ->url(fn($record): string => InovasiMasyarakatResource::getUrl('indikator', ['record' => $record]))
                    ->label('')
                    ->icon('heroicon-o-folder')
                    ->tooltip('Indikator'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil')
                    ->tooltip('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->tooltip('Hapus')
                    ->after(function (InovasiMasyarakat $record) {
                        // delete file
                        if ($record->hki_inovasi) {
                            Storage::disk('public')->delete($record->hki_inovasi);
                        }
                        if ($record->penghargaan_inovasi) {
                            Storage::disk('public')->delete($record->penghargaan_inovasi);
                        }
                        if ($record->skt) {
                            Storage::disk('public')->delete($record->skt);
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
            'index' => Pages\ListInovasiMasyarakats::route('/'),
            'create' => Pages\CreateInovasiMasyarakat::route('/create'),
            'edit' => Pages\EditInovasiMasyarakat::route('/{record}/edit'),
            'indikator' => Pages\IndikatorInovasiMasyarakat::route('/{record}/indikator')
        ];
    }
}

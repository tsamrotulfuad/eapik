<?php

namespace App\Filament\Masyarakat\Resources\InovasiMasyarakatResource\Pages;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use App\Filament\Masyarakat\Resources\InovasiMasyarakatResource;

class IndikatorInovasiMasyarakat extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithRecord, InteractsWithTable;
    use WithFileUploads;
    
    protected static string $resource = InovasiMasyarakatResource::class;

    protected static string $view = 'filament.masyarakat.resources.inovasi-masyarakat-resource.pages.indikator-inovasi-masyarakat';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $inovasi_id = $this->record->id;
        $nama_inovasi = $this->record->nama_inovasi;

        return $form->schema([
            Fieldset::make('Proposal Inovasi')
                ->schema([
                    TextInput::make('inovasi_id')->default($inovasi_id)->readOnly()->columns(3),
                    TextInput::make('nama_inovasi')->default($nama_inovasi)->disabled()
                        ->columns(3),
                ]),
            Section::make('Kemudahan Proses')
                ->description('Prevent abuse by limiting the number of requests per period')
                ->aside()
                ->schema([
                    Textarea::make('kemudahan_proses')
                        ->columnSpanFull()
                        ->maxLength(3000)
                        ->rows(5)
                        ->required(),
                ]),
            Section::make('Keterlibatan Aktor')
                ->description('Prevent abuse by limiting the number of requests per period')
                ->aside()
                ->schema([
                    Textarea::make('keterlibatan_aktor')
                        ->columnSpanFull()
                        ->maxLength(3000)
                        ->rows(5)
                        ->required(),
                ]),
            Section::make('Kemanfaatan')
                ->description('Prevent abuse by limiting the number of requests per period')
                ->aside()
                ->schema([
                    Textarea::make('kemanfaatan')
                        ->columnSpanFull()
                        ->maxLength(3000)
                        ->rows(5)
                        ->required(),
                    FileUpload::make('kemanfaatan_upload')
                        ->label('Bukti Dukung Kemanfaatan')
                        ->required()
                ]),
            Section::make('Sosialisasi')
                ->description('Prevent abuse by limiting the number of requests per period')
                ->aside()
                ->schema([
                     Select::make('sosialisasi')
                    ->options([
                        'Media Berita' => 'Media Berita',
                        'Konten Media Sosial' => 'Konten Media Sosial',
                        'Foto Sosialisasi' => 'Foto Sosialisasi',
                    ])
                    ->required()
                    ->native(false),
                    FileUpload::make('sosialisasi_upload')
                        ->label('Bukti Dukung Sosialisasi')
                        ->required(),
                ]),
            Section::make('Kualitas Inovasi (Video)')
                ->description('Kualitasi inovasi dibuktkan dengan video tentang inovasinya')
                ->aside()
                ->schema([
                    FileUpload::make('video_inovasi')
                    ->required()
                ]),
            TextInput::make('kematangan')
                ->label('Kematangan')
                ->numeric()
                ->default(0)
                ->readOnly(),
                ])
        ->statePath('data');;
    }

    public function create(): void
    {
        \App\Models\IndikatorInovasiMasyarakat::create($this->form->getState());
        $this->form->fill();
        Notification::make()
            ->title('Data berhasil disimpan')
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\IndikatorInovasiMasyarakat::query()
                    ->where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('kemudahan_proses'),
                TextColumn::make('keterlibatan_aktor'),
                TextColumn::make('kematangan'),
                TextColumn::make('tahun'),
            ])
            ->emptyStateHeading("Tidak Ada Data")
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make(),
                EditAction::make()
                    ->record($this->record)
                    ->form([
                        Section::make('Kemudahan Proses')
                            ->description('Prevent abuse by limiting the number of requests per period')
                            ->aside()
                            ->schema([
                                Textarea::make('kemudahan_proses')
                                    ->columnSpanFull()
                                    ->maxLength(3000)
                                    ->rows(5)
                                    ->required(),
                                Select::make('parameter_kemudahan_proses')
                                    ->label('Pilih Parameter')
                                    ->default(false)
                                    ->reactive()
                                    ->dehydrated(false)
                                    ->options([
                                        10 => 'Kurang (10)',
                                        20 => 'Cukup (20)',
                                        30 => 'Baik (30)',
                                    ])
                                    ->afterStateUpdated(fn ($state, callable $get, callable $set) =>
                                        $set('kematangan',
                                            (intval($state))
                                            + intval($get('parameter_keterlibatan_aktor'))
                                        )
                                    ),
                            ]),
                        Section::make('Keterlibatan Aktor')
                            ->description('Prevent abuse by limiting the number of requests per period')
                            ->aside()
                            ->schema([
                                Textarea::make('keterlibatan_aktor')
                                    ->columnSpanFull()
                                    ->maxLength(3000)
                                    ->rows(5)
                                    ->required(),
                                Select::make('parameter_keterlibatan_aktor')
                                    ->label('Pilih Parameter')
                                    ->default(false)
                                    ->reactive()
                                    ->dehydrated(false)
                                    ->options([
                                        10 => 'Kurang (10)',
                                        20 => 'Cukup (20)',
                                        30 => 'Baik (30)',
                                    ])
                                    ->afterStateUpdated(fn ($state, callable $get, callable $set) =>
                                        $set('kematangan',
                                            (intval($get('parameter_kemudahan_proses')))
                                            + intval($state)
                                        )
                                    ),
                            ]),
                        Section::make('Kemanfaatan')
                            ->description('Prevent abuse by limiting the number of requests per period')
                            ->aside()
                            ->schema([
                                Textarea::make('kemanfaatan')
                                    ->columnSpanFull()
                                    ->maxLength(3000)
                                    ->rows(5)
                                    ->required(),
                                FileUpload::make('kemanfaatan_upload')
                                    ->label('Bukti Dukung Kemanfaatan')
                                    ->required()
                            ]),
                        Section::make('Sosialisasi')
                            ->description('Prevent abuse by limiting the number of requests per period')
                            ->aside()
                            ->schema([
                                Select::make('sosialisasi')
                                ->options([
                                    'Media Berita' => 'Media Berita',
                                    'Konten Media Sosial' => 'Konten Media Sosial',
                                    'Foto Sosialisasi' => 'Foto Sosialisasi',
                                ])
                                ->required()
                                ->native(false),
                                FileUpload::make('sosialisasi_upload')
                                    ->label('Bukti Dukung Sosialisasi')
                                    ->required(),
                            ]),
                        Section::make('Kualitas Inovasi (Video)')
                            ->description('Kualitasi inovasi dibuktkan dengan video tentang inovasinya')
                            ->aside()
                            ->schema([
                                FileUpload::make('video_inovasi')
                                ->required()
                            ]),
                        TextInput::make('kematangan')
                            ->label('Kematangan')
                            ->numeric()
                            ->default(0)
                            ->readOnly(),
                        ])
                    ])
            ->bulkActions([
                // ...
            ]);
    }

}

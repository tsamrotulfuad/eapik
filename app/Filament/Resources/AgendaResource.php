<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgendaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgendaResource\RelationManagers;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $navigationGroup = 'Tools';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_agenda')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('tanggal_agenda')->required(),
                TimePicker::make('mulai')->required()
                    ->displayFormat('H:i')
                    ->seconds(false)
                    ->datalist([
                        '08:00',
                        '08:30',
                        '09:00',
                        '09:30',
                        '10:00',
                        '10:30',
                        '11:00',
                        '11:30',
                        '12:00',
                        '12:30',
                        '13:00',
                        '13:30',
                        '14:00',
                        '14:30',
                        '15:00',
                    ]),
                TimePicker::make('selesai')->required()
                    ->displayFormat('H:i')
                    ->seconds(false)
                    ->datalist([
                        '08:00',
                        '08:30',
                        '09:00',
                        '09:30',
                        '10:00',
                        '10:30',
                        '11:00',
                        '11:30',
                        '12:00',
                        '12:30',
                        '13:00',
                        '13:30',
                        '14:00',
                        '14:30',
                        '15:00',
                        '15:30',
                    ]),
                Select::make('urusan_agenda')
                    ->options([
                        'Umum' => 'Umum',
                        'Kepala Perangkat Derah' => 'Kepala Perangkat Derah',
                    ]),
                Select::make('bidang_id')
                    ->relationship('bidang', 'nama_bidang')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Bidang'),
                Select::make('ruangan_id')
                    ->relationship('ruangan', 'nama_ruangan')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Ruangan'),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_agenda')->searchable(),
                TextColumn::make('tanggal_agenda')->date(),
                TextColumn::make('mulai')->label('Mulai'),
                TextColumn::make('selesai')->label('Selesai'),
                TextColumn::make('ruangan.nama_ruangan')->label('Ruangan')->badge(),
            ])
            ->defaultSort('tanggal_agenda', 'desc')
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}

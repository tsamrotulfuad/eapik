<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Individu;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class IndividuesRelationManager extends RelationManager
{
    protected static string $relationship = 'individues';

    protected static ?string $title = 'Anggota Keluarga';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('tanggal_lahir')->label('Tanggal Lahir')->date(),
                Tables\Columns\TextColumn::make('hubungan_keluarga')->label('Hubungan Keluarga'),
                Tables\Columns\IconColumn::make('is_verified')->label('Verifikasi')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('attachIndividu')
                    ->label('Tambahkan Individu dari Data')
                    ->icon('heroicon-o-user-plus')
                    ->form([
                        Forms\Components\Select::make('individu_ids')
                            ->label('Pilih Individu')
                            ->multiple()
                            ->options(fn () => Individu::whereNull('keluarga_id')
                                // ->orderBy('nama')
                                ->pluck('nama', 'id')
                                ->toArray()
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->action(function (array $data, $livewire) {
                        // ambil parent keluarga (record yang sedang dibuka)
                        $parent = $livewire->ownerRecord;
                        // ambil id yang dikirim; aman jika tidak ada
                        $ids = $data['individu_ids'] ?? [];

                        if (empty($ids)) {
                            Notification::make()
                                ->title('Tidak ada individu yang dipilih')
                                ->danger()
                                ->send();

                            return;
                        }

                         // update banyak sekaligus; returns number of rows updated
                        $updatedCount = Individu::whereIn('id', $ids)
                            ->update(['keluarga_id' => $parent->id]);

                        Notification::make()
                            ->title('Sukses menambahkan anggota')
                            ->body("{$updatedCount} individu berhasil ditautkan ke keluarga {$parent->kepala_keluarga}.")
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                // aksi lepaskan per baris
                Tables\Actions\Action::make('detach')
                    ->label('Lepas dari Keluarga')
                    ->icon('heroicon-o-user-minus')
                    ->action(function ($record, $livewire) {
                        $record->update(['keluarga_id' => null]);
                        Notification::make()
                            ->title('Anggota dilepas')
                            ->success()
                            ->send();

                        // refresh
                        $livewire->redirect($livewire->getUrl());
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

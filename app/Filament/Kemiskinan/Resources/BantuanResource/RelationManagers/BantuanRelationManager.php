<?php

namespace App\Filament\Kemiskinan\Resources\BantuanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BantuanRelationManager extends RelationManager
{
    protected static string $relationship = 'bantuans';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('pivot.tanggal_terima')
                ->label('Tanggal Terima')
                ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_bantuan')
            ->columns([
                Tables\Columns\TextColumn::make('nama_bantuan'),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\TextColumn::make('pivot.tanggal_terima')->date()->label('Tanggal Terima')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                 Tables\Actions\AttachAction::make()
                    ->label('Tambah Bantuan')
                    ->form(fn ($action) => [
                        $action->getRecordSelect()->label('Pilih Bantuan'),
                        Forms\Components\DatePicker::make('tanggal_terima')
                        ->required(),
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Ubah Data')
                    ->form([
                        // untuk edit pivot harus pakai prefix pivot.
                        Forms\Components\DatePicker::make('pivot.tanggal_terima')
                            ->label('Tanggal Terima')
                            ->required(),
                    ])
                    ->mutateFormDataUsing(function (array $data) {
                        // ubah key supaya Filament tahu hanya butuh tanggal_terima
                        return ['tanggal_terima' => $data['pivot']['tanggal_terima']];
                    })
                    ->using(function ($record, array $data) {
                        // update langsung ke pivot
                        $record->pivot->update($data);
                    }),
                Tables\Actions\DetachAction::make()
                    ->label('Hapus Bantuan') // tombol detach
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Individu;
use Filament\Forms\Form;
use Filament\Tables\Table;
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
                        Forms\Components\Select::make('individu_id')
                            ->label('Pilih Individu')
                            ->options(
                                Individu::whereNull('keluarga_id') // hanya individu yang belum punya keluarga
                                    ->pluck('nama', 'id')
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data, $livewire) {
                        $parent = $livewire->ownerRecord; // record keluarga
                        $individu = Individu::find($data['individu_id']);
                        if ($individu) {
                            $individu->update(['keluarga_id' => $parent->id]);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Lepas dari Keluarga')
                    ->action(function ($record) {
                        $record->update(['keluarga_id' => null]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

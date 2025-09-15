<?php

namespace App\Filament\Kemiskinan\Pages;

use App\Models\Individu;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SearchIndividu extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static ?string $navigationGroup = 'Data Kemiskinan';
    protected static ?string $title = 'Pencarian Individu';
    protected static string $view = 'filament.kemiskinan.pages.search-individu';

    // Livewire properties (penting: harus ada supaya $this->validate() menemukan properti)
    public ?string $nik = null;
    public ?Individu $individu = null;

    // aturan validasi untuk property di atas
    protected $rules = [
        'nik' => ['required', 'string', 'max:16'],
    ];

    public function mount(): void
    {
        $this->individu = null;
    }

    public function search(): void
    {
        // pakai Livewire validation terhadap property $nik
        $this->validate();

        $this->individu = Individu::with(['bantuans'])
            ->where('nik', $this->nik)
            ->first();

        if (! $this->individu) {
            Notification::make()
                ->title('Data tidak ditemukan')
                ->body("Individu dengan NIK {$this->nik} tidak ditemukan.")
                ->danger()
                ->send();
        }
    }

    public function clear(): void
    {
        $this->nik = null;
        $this->individu = null;
    }
}

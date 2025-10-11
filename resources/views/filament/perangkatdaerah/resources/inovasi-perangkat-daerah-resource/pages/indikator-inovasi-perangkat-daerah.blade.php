<x-filament-panels::page>

    <form wire:submit="create">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Simpan
            </x-filament::button>
        </div>
    </form>
    <div class="mt-3">
        {{ $this->table }}
    </div>
</x-filament-panels::page>

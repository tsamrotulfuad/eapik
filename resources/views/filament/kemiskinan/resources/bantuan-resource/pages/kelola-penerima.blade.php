<x-filament::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">Statistik Penerima</x-slot>

            @php($stats = $this->getStats())

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Penerima</div>
                    <div class="text-2xl font-bold">{{ $stats['total'] }}</div>
                </div>

                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Laki-laki</div>
                    <div class="text-2xl font-bold">{{ $stats['male'] }}</div>
                </div>

                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Perempuan</div>
                    <div class="text-2xl font-bold">{{ $stats['female'] }}</div>
                </div>
            </div>
        </x-filament::section>

        {{-- tabel (InteractsWithTable) --}}
        {{ $this->table }}
    </div>
</x-filament::page>

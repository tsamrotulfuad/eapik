<x-filament::page>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Kolom kiri: Form pencarian --}}
        <div class="space-y-6">
            <x-filament::section>
                {{-- Form pencarian (styled sesuai Filament) --}}
                <form wire:submit.prevent="search" class="space-y-4">
                    <div>
                    <x-filament::input.wrapper>
                            <x-filament::input
                                wire:model.defer="nik"
                                type="text"
                                placeholder="Contoh: 3578..."
                            />
                        </x-filament::input.wrapper>

                        @error('nik')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <x-filament::button type="submit" icon="heroicon-o-magnifying-glass">
                            Cari 
                        </x-filament::button>

                        <x-filament::button color="secondary" wire:click.prevent="clear" type="button" icon="heroicon-o-x-mark">
                            Reset
                        </x-filament::button>
                    </div>
                </form>
            </x-filament::section>
        </div>

        {{-- Kolom kanan: Hasil pencarian --}}
        <div class="space-y-6">
        @if($individu)
            <x-filament::section>
                <x-slot name="heading">Detail Individu</x-slot>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>Nama:</strong> {{ $individu->nama }}</div>
                    <div><strong>NIK:</strong> {{ $individu->nik }}</div>
                    <div><strong>Tanggal Lahir:</strong> {{ $individu->tanggal_lahir }}</div>
                    <div><strong>Verifikasi:</strong> {{ $individu->is_verified ? '✔️ Diverifikasi' : '❌ Belum' }}</div>
                </div>
            </x-filament::section>

            @if($individu->keluarga)
                <x-filament::section>
                    <x-slot name="heading">Data Keluarga</x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>No KK:</strong> {{ $individu->keluarga->no_kk }}</div>
                        <div><strong>Kepala Keluarga:</strong> {{ $individu->keluarga->kepala_keluarga }}</div>
                        <div class="col-span-2"><strong>Alamat:</strong> {{ $individu->keluarga->alamat }}</div>
                    </div>
                </x-filament::section>
            @endif

            <x-filament::section>
                <x-slot name="heading">Bantuan yang Diterima</x-slot>
                @if($individu->bantuans && $individu->bantuans->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-md">
                            <thead>
                                <tr>
                                    <th class="px-3 py-2 border">Nama Bantuan</th>
                                    <th class="px-3 py-2 border">Tahun</th>
                                    <th class="px-3 py-2 border">Deskripsi</th>
                                    <th class="px-3 py-2 border">Tanggal Terima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($individu->bantuans as $bantuan)
                                    <tr>
                                        <td class="px-3 py-2 border">{{ $bantuan->nama_bantuan }}</td>
                                        <td class="px-3 py-2 border">{{ $bantuan->tahun }}</td>
                                        <td class="px-3 py-2 border">{{ $bantuan->deskripsi }}</td>
                                        <td class="px-3 py-2 border">
                                            {{ $bantuan->pivot->tanggal_terima ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Belum menerima bantuan</p>
                @endif
            </x-filament::section>
        @endif
        </div>
        
    </div>
</x-filament::page>

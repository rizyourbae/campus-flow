@php
    // Kita panggil method dari class Widget-nya
    $userName = $this->getAuthenticatedUserName();
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex-1">
                <h2 class="text-lg font-semibold tracking-tight text-gray-950 dark:text-white">
                    Selamat Datang Kembali, {{ $userName }}!
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Selamat beraktivitas di dashboard KampusFlow. Semua alat yang Anda butuhkan untuk mengelola
                    penjadwalan ada di sini.
                </p>
            </div>

            <div class="flex flex-col items-end gap-y-1">
                <x-filament::button tag="a" href="{{ \App\Filament\Resources\ScheduleResource::getUrl() }}"
                    icon="heroicon-m-table-cells" color="primary">
                    Lihat Jadwal
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

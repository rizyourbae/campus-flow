<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-center h-full text-center gap-x-3">

            {{-- Tambahkan Icon Kalender di sini --}}
            @svg('heroicon-o-calendar-days', 'w-10 h-10 text-gray-400 dark:text-gray-500')

            {{-- Teks tanggal dengan styling baru --}}
            <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200 tracking-tight">
                {{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}
            </p>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>

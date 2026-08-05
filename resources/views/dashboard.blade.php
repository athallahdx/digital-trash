<x-layouts::app :title="__('Dasbor')">
    <div class="space-y-8">
        {{-- Header --}}
        <header class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('Dasbor') }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ringkasan status bank sampah dan aktivitas terbaru.</p>
            </div>
        </header>

        {{-- Stat cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Total Nasabah --}}
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition-all duration-200 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900">
                <div class="flex items-start justify-between">
                    <div class="min-w-0">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Total Nasabah</dt>
                        <dd class="mt-2 text-3xl font-bold tabular-nums text-gray-900 dark:text-white">{{ number_format($totalCustomers) }}</dd>
                    </div>
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Nasabah Aktif --}}
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition-all duration-200 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900">
                <div class="flex items-start justify-between">
                    <div class="min-w-0">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nasabah Aktif</dt>
                        <dd class="mt-2 text-3xl font-bold tabular-nums text-gray-900 dark:text-white">{{ number_format($activeCustomers) }}</dd>
                    </div>
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Total Saldo Simpanan --}}
            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition-all duration-200 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900 sm:col-span-2 lg:col-span-1">
                <div class="flex items-start justify-between">
                    <div class="min-w-0">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Total Saldo Simpanan</dt>
                        <dd class="mt-2 truncate text-3xl font-bold tabular-nums text-gray-900 dark:text-white">Rp{{ number_format($totalSavingsBalance, 2) }}</dd>
                    </div>
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        {{-- Recent activity --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            {{-- Setoran Terbaru --}}
            <section class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
                <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 dark:border-neutral-800">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Setoran Terbaru</h3>
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">Masuk</span>
                </div>

                @if($latestDeposits->isEmpty())
                    <div class="flex flex-col items-center justify-center gap-2 px-5 py-12 text-center">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-neutral-800 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" y1="15" x2="12" y2="3" />
                            </svg>
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada setoran terbaru.</p>
                    </div>
                @else
                    <ul class="divide-y divide-gray-100 px-5 dark:divide-neutral-800">
                        @foreach($latestDeposits as $d)
                            <li class="flex items-center justify-between gap-4 py-3.5">
                                <div class="flex min-w-0 items-center gap-3">
                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-neutral-800 dark:text-gray-300">
                                        {{ strtoupper(substr($d->customer?->name ?? '-', 0, 1)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <div class="truncate text-sm font-medium text-gray-900 dark:text-white">{{ $d->customer?->name ?? '-' }}</div>
                                        <div class="mt-0.5 truncate text-xs text-gray-500 dark:text-gray-400">{{ $d->transaction_date->format('d M Y') }} &middot; {{ $d->transaction_number }}</div>
                                    </div>
                                </div>
                                <div class="shrink-0 text-right">
                                    <div class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">+Rp{{ number_format($d->total_amount, 2) }}</div>
                                    <div class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $d->created_at ? \Illuminate\Support\Carbon::parse($d->created_at)->format('d M Y H:i') : '-' }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>

            {{-- Penarikan Terbaru --}}
            <section class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
                <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 dark:border-neutral-800">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Penarikan Terbaru</h3>
                    <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-xs font-medium text-rose-700 dark:bg-rose-500/10 dark:text-rose-400">Keluar</span>
                </div>

                @if($latestWithdrawals->isEmpty())
                    <div class="flex flex-col items-center justify-center gap-2 px-5 py-12 text-center">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-neutral-800 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada penarikan terbaru.</p>
                    </div>
                @else
                    <ul class="divide-y divide-gray-100 px-5 dark:divide-neutral-800">
                        @foreach($latestWithdrawals as $w)
                            <li class="flex items-center justify-between gap-4 py-3.5">
                                <div class="flex min-w-0 items-center gap-3">
                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-neutral-800 dark:text-gray-300">
                                        {{ strtoupper(substr($w->customer?->name ?? '-', 0, 1)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <div class="truncate text-sm font-medium text-gray-900 dark:text-white">{{ $w->customer?->name ?? '-' }}</div>
                                        <div class="mt-0.5 truncate text-xs text-gray-500 dark:text-gray-400">{{ $w->transaction_date->format('d M Y') }} &middot; {{ $w->transaction_number }}</div>
                                    </div>
                                </div>
                                <div class="shrink-0 text-right">
                                    <div class="text-sm font-semibold text-rose-600 dark:text-rose-400">-Rp{{ number_format($w->amount, 2) }}</div>
                                    <div class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $w->created_at ? \Illuminate\Support\Carbon::parse($w->created_at)->format('d M Y H:i') : '-' }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>
    </div>
</x-layouts::app>

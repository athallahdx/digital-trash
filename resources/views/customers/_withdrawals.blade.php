@props(['withdrawals'])

<section class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
    <div class="flex flex-col gap-3 border-b border-gray-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-neutral-800">
        <div class="flex items-center gap-2.5">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Penarikan</h3>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <form method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pointer-events-none absolute left-2.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400">
                        <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input name="withdrawal_search" value="{{ request('withdrawal_search') }}" placeholder="Cari transaksi"
                           class="rounded-lg border border-gray-300 py-1.5 pl-8 pr-3 text-sm shadow-sm transition placeholder-gray-400 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500" />
                </div>
                <select name="withdrawal_sort"
                        class="rounded-lg border border-gray-300 py-1.5 px-2.5 text-sm shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100">
                    <option value="transaction_date_desc" {{ request('withdrawal_sort') === 'transaction_date_desc' ? 'selected' : '' }}>Terbaru</option>
                    <option value="transaction_date_asc" {{ request('withdrawal_sort') === 'transaction_date_asc' ? 'selected' : '' }}>Terlama</option>
                </select>
                <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400/30 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-200 dark:hover:bg-neutral-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                    Filter
                </button>
            </form>
            @php
                $currentCustomerId = optional(request()->route('customer'))->id ?? request('customer');
            @endphp
            <a href="{{ route('withdrawal-transactions.create') }}{{ $currentCustomerId ? '?customer_id=' . $currentCustomerId : '' }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Penarikan Baru
            </a>
        </div>
    </div>

    @if($withdrawals->isEmpty())
        <div class="flex flex-col items-center justify-center gap-2 px-5 py-12 text-center">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-neutral-800 dark:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
            </span>
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada penarikan untuk nasabah ini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 dark:bg-neutral-800/60">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        <th class="px-5 py-3">#</th>
                        <th class="px-5 py-3">Transaksi</th>
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3 text-right">Nominal</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-neutral-800">
                    @foreach($withdrawals as $w)
                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-neutral-800/60">
                            <td class="px-5 py-3 text-gray-500 dark:text-gray-400">{{ $w->id }}</td>
                            <td class="px-5 py-3 font-medium text-gray-900 dark:text-white">{{ $w->transaction_number }}</td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $w->transaction_date->format('d M Y') }}</td>
                            <td class="px-5 py-3 text-right font-semibold text-rose-600 dark:text-rose-400">Rp{{ number_format($w->amount, 2) }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('withdrawal-transactions.show', $w) }}{{ $currentCustomerId ? '?customer_id=' . $currentCustomerId : '' }}" title="Lihat"
                                       class="rounded-md p-1.5 text-gray-500 transition hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:text-gray-400 dark:hover:bg-blue-500/10 dark:hover:text-blue-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" /><circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('withdrawal-transactions.edit', $w) }}{{ $currentCustomerId ? '?customer_id=' . $currentCustomerId : '' }}" title="Ubah"
                                       class="rounded-md p-1.5 text-gray-500 transition hover:bg-amber-50 hover:text-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500/30 dark:text-gray-400 dark:hover:bg-amber-500/10 dark:hover:text-amber-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('withdrawal-transactions.destroy', $w) }}{{ $currentCustomerId ? '?customer_id=' . $currentCustomerId : '' }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus transaksi ini?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                                class="rounded-md p-1.5 text-gray-500 transition hover:bg-rose-50 hover:text-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500/30 dark:text-gray-400 dark:hover:bg-rose-500/10 dark:hover:text-rose-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 px-5 py-3 dark:border-neutral-800">
            {{ $withdrawals->appends(request()->except('page'))->links() }}
        </div>
    @endif
</section>
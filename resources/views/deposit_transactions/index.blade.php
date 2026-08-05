<x-layouts::app :title="__('Riwayat Setoran')">
    <div class="flex flex-col gap-6">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('Riwayat Setoran') }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Melacak setoran masuk dan totalnya.</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('deposit-transactions.index') }}" class="flex items-center gap-2">
                    <label for="search" class="sr-only">Cari</label>
                    <input id="search" name="search" value="{{ request('search') }}" type="search" placeholder="Cari nomor transaksi atau nama nasabah"
                           class="w-56 rounded-md border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 dark:border-neutral-800 dark:bg-neutral-900 dark:text-gray-200" />
                    <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">Cari</button>
                </form>

                <a href="{{ route('deposit-transactions.create') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Setoran Baru
                </a>
            </div>
        </header>

        @if(session('success'))
            <div class="flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900 dark:border-emerald-800/50 dark:bg-emerald-900/20 dark:text-emerald-200" role="status">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" /><polyline points="22 4 12 14.01 9 11.01" /></svg>
                {{ session('success') }}
            </div>
        @endif

        <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-neutral-800/60">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            <th class="px-5 py-3"> <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => (request('sort') == 'id' && request('direction') == 'desc') ? 'asc' : 'desc', 'page' => 1]) }}">#</a></th>
                            <th class="px-5 py-3"> <a href="{{ request()->fullUrlWithQuery(['sort' => 'transaction_number', 'direction' => (request('sort') == 'transaction_number' && request('direction') == 'desc') ? 'asc' : 'desc', 'page' => 1]) }}">Transaksi</a></th>
                            <th class="px-5 py-3"> <a href="{{ request()->fullUrlWithQuery(['sort' => 'customer', 'direction' => (request('sort') == 'customer' && request('direction') == 'desc') ? 'asc' : 'desc', 'page' => 1]) }}">Nasabah</a></th>
                            <th class="px-5 py-3"> <a href="{{ request()->fullUrlWithQuery(['sort' => 'transaction_date', 'direction' => (request('sort') == 'transaction_date' && request('direction') == 'desc') ? 'asc' : 'desc', 'page' => 1]) }}">Tanggal</a></th>
                            <th class="px-5 py-3 text-right"> <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => (request('sort') == 'total_amount' && request('direction') == 'desc') ? 'asc' : 'desc', 'page' => 1]) }}">Total</a></th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-neutral-800">
                        @forelse($transactions as $transaction)
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-neutral-800/60">
                                <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400">{{ $transaction->id }}</td>
                                <td class="px-5 py-3.5 font-medium text-gray-900 dark:text-white">{{ $transaction->transaction_number }}</td>
                                <td class="px-5 py-3.5 text-gray-700 dark:text-gray-200">{{ $transaction->customer?->name ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-gray-600 dark:text-gray-300">{{ $transaction->transaction_date->format('d M Y') }}</td>
                                <td class="px-5 py-3.5 text-right font-semibold text-emerald-600 dark:text-emerald-400">{{ 'Rp ' . number_format($transaction->total_amount ?? 0, 2, ',', '.') }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('deposit-transactions.show', $transaction) }}" title="Lihat"
                                           class="rounded-md p-1.5 text-gray-500 transition hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:text-gray-400 dark:hover:bg-blue-500/10 dark:hover:text-blue-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" /><circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('deposit-transactions.edit', $transaction) }}" title="Ubah"
                                           class="rounded-md p-1.5 text-gray-500 transition hover:bg-amber-50 hover:text-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500/30 dark:text-gray-400 dark:hover:bg-amber-500/10 dark:hover:text-amber-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('deposit-transactions.destroy', $transaction) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus transaksi ini?') }}')">
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
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-14">
                                    <div class="flex flex-col items-center gap-3 text-center">
                                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-neutral-800 dark:text-gray-500">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M9 17a3 3 0 006 0M3 7h18"/></svg>
                                        </span>
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Belum ada setoran</div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Buat setoran untuk mulai mencatat pemasukan.</p>
                                        <a href="{{ route('deposit-transactions.create') }}"
                                           class="mt-2 inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                                            </svg>
                                            Buat Setoran
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">Menampilkan {{ $transactions->firstItem() ?? 0 }} hingga {{ $transactions->lastItem() ?? 0 }} dari {{ $transactions->total() }} transaksi</div>
            <nav>
                {{ $transactions->links() }}
            </nav>
        </div>
    </div>
</x-layouts::app>
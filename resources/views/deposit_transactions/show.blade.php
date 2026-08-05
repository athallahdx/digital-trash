<x-layouts::app :title="__('Detail Setoran')">
    <div class="mx-auto max-w-4xl space-y-6">
        <header class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="truncate text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $transaction->transaction_number }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Detail transaksi setoran ini.</p>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <a href="{{ route('deposit-transactions.edit', $transaction) }}{{ request('customer_id') ? '?customer_id=' . request('customer_id') : '' }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-3.5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Ubah
                </a>

                <form action="{{ route('deposit-transactions.destroy', $transaction) }}{{ request('customer_id') ? '?customer_id=' . request('customer_id') : '' }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus transaksi ini?') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Hapus" class="inline-flex items-center gap-2 rounded-lg border border-rose-300 bg-white px-3.5 py-2 text-sm font-medium text-rose-700 shadow-sm transition hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-400/30">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                        </svg>
                        Hapus
                    </button>
                </form>

                <a href="{{ request('customer_id') ? route('customers.show', request('customer_id')) : route('deposit-transactions.index') }}"
                   class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400/30 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-200 dark:hover:bg-neutral-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <line x1="19" y1="12" x2="5" y2="12" /><polyline points="12 19 5 12 12 5" />
                    </svg>
                    Kembali
                </a>
            </div>
        </header>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nomor Transaksi</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $transaction->transaction_number }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nasabah</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $transaction->customer?->name ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Tanggal</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $transaction->transaction_date->format('d M Y') }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Total</dt>
                    <dd class="mt-1.5 text-sm font-semibold text-emerald-600 dark:text-emerald-400">Rp{{ number_format($transaction->total_amount, 2) }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Catatan</dt>
                    <dd class="mt-1.5 text-sm leading-relaxed text-gray-900 dark:text-gray-100">{{ $transaction->notes ?: '-' }}</dd>
                </div>
            </dl>
        </div>

        @if($transaction->depositItems && $transaction->depositItems->count())
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-neutral-800">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Item Setoran</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-neutral-800/60">
                            <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                <th class="px-5 py-3">Kategori</th>
                                <th class="px-5 py-3 text-right">Berat</th>
                                <th class="px-5 py-3 text-right">Harga</th>
                                <th class="px-5 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-neutral-800">
                            @foreach($transaction->depositItems as $item)
                                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-neutral-800/60">
                                    <td class="px-5 py-3 font-medium text-gray-900 dark:text-white">{{ $item->wasteCategory?->name ?? '-' }}</td>
                                    <td class="px-5 py-3 text-right text-gray-700 dark:text-gray-200">{{ number_format($item->weight, 2) }} kg</td>
                                    <td class="px-5 py-3 text-right text-gray-700 dark:text-gray-200">Rp{{ number_format($item->price, 2) }}</td>
                                    <td class="px-5 py-3 text-right font-semibold text-gray-900 dark:text-white">Rp{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts::app>
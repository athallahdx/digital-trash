<x-layouts::app :title="__('Nasabah')">
    <div class="mx-auto max-w-3xl space-y-6">
        <header class="flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1 class="truncate text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $customer->name }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Detail nasabah dan informasi kontak</p>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <a href="{{ route('customers.edit', $customer) }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-3.5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Ubah
                </a>

                <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus nasabah ini?') }}')">
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

                <a href="{{ route('customers.index') }}"
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
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nomor Nasabah</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $customer->customer_number }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Nama</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $customer->name }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Saldo</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $customer->balance ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Telepon</dt>
                    <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $customer->phone ?? '-' }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Alamat</dt>
                    <dd class="mt-1.5 text-sm leading-relaxed text-gray-900 dark:text-gray-100">{{ $customer->address ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Status</dt>
                    <dd class="mt-1.5">
                        @if($customer->is_active)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-800/30 dark:text-amber-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                Non-aktif
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Related resources: deposits & withdrawals --}}
        @include('customers._deposits', ['deposits' => $deposits ?? collect()])
        @include('customers._withdrawals', ['withdrawals' => $withdrawals ?? collect()])
    </div>
</x-layouts::app>
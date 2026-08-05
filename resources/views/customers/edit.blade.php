<x-layouts::app :title="__('Ubah Nasabah')">
    <div class="mx-auto max-w-3xl space-y-6">
        <header class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('Ubah Nasabah') }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Perbarui detail dan status nasabah.</p>
            </div>
            <a href="{{ route('customers.index') }}"
               class="inline-flex shrink-0 items-center gap-2 rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400/30 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-200 dark:hover:bg-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <line x1="19" y1="12" x2="5" y2="12" /><polyline points="12 19 5 12 12 5" />
                </svg>
                Kembali
            </a>
        </header>

        @if($errors->any())
            <div class="flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 dark:border-rose-800/50 dark:bg-rose-900/20 dark:text-rose-200" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-0.5 h-4 w-4 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                <div>
                    <p class="font-semibold">Terdapat kesalahan pada isian Anda:</p>
                    <ul class="mt-1 list-disc space-y-0.5 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('customers.update', $customer) }}" method="POST" class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
            @csrf
            @method('PUT')

            @include('customers._form', ['customer' => $customer])
        </form>

        {{-- Related resources: deposits & withdrawals (manageable from edit page) --}}
        @include('customers._deposits', ['deposits' => $deposits ?? collect()])
        @include('customers._withdrawals', ['withdrawals' => $withdrawals ?? collect()])
    </div>
</x-layouts::app>
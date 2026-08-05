@props(['transaction' => null, 'customers' => null, 'selectedCustomerId' => null])

<div class="space-y-6">
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <label for="transaction_number" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Nomor Transaksi
            </label>
            @php $txnNumber = old('transaction_number', $transaction->transaction_number ?? ''); @endphp
            <input type="hidden" name="transaction_number" value="{{ $txnNumber }}">

            <div class="mt-1.5 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-400">
                {{ $txnNumber ?: 'Nomor transaksi Akan dibuat otomatis oleh sistem' }}
            </div>

            @error('transaction_number')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="customer_id" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Nasabah <span class="text-rose-500">*</span>
            </label>
            @php
                $customerIdValue = old('customer_id', $selectedCustomerId ?? $transaction->customer_id ?? '');
                $selectedCustomer = $customers->firstWhere('id', $customerIdValue);
            @endphp
            @if($selectedCustomerId)
                <input type="hidden" name="customer_id" value="{{ $customerIdValue }}">
                <div class="mt-1.5 rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100">
                    {{ $selectedCustomer ? $selectedCustomer->name . ' (' . $selectedCustomer->customer_number . ')' : 'Nasabah terpilih' }}
                </div>
            @else
                <select id="customer_id" name="customer_id" required
                        class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100">
                    <option value="">-- Pilih Nasabah --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" {{ $customerIdValue == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->customer_number }})</option>
                    @endforeach
                </select>
            @endif
            @error('customer_id')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="transaction_date" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Tanggal Transaksi <span class="text-rose-500">*</span>
            </label>
            <input id="transaction_date" name="transaction_date" type="date" value="{{ old('transaction_date', (isset($transaction) && $transaction->transaction_date) ? $transaction->transaction_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required
                   class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 [color-scheme:light] dark:[color-scheme:dark]" />
            @error('transaction_date')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="total_amount" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Total <span class="text-rose-500">*</span>
            </label>
            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-gray-400 dark:text-gray-500">Rp</span>
                <input id="total_amount" name="total_amount" type="number" step="0.01" value="{{ old('total_amount', $transaction->total_amount ?? '') }}" required
                       class="block w-full rounded-lg border border-gray-300 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500" />
            </div>
            @error('total_amount')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <div>
        <label for="notes" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Catatan</label>
        <textarea id="notes" name="notes" rows="4"
                  class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500">{{ old('notes', $transaction->notes ?? '') }}</textarea>
        @error('notes')
            <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5 dark:border-neutral-800">
        <button type="submit"
                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                <polyline points="17 21 17 13 7 13 7 21" />
                <polyline points="7 3 7 8 15 8" />
            </svg>
            Simpan Setoran
        </button>
    </div>
</div>
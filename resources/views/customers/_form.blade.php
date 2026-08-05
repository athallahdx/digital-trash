@props(['customer' => null])

<div class="space-y-6">
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <label for="customer_number" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Nomor Nasabah
            </label>
            @if(isset($customer) && $customer->customer_number)
                <input id="customer_number" name="customer_number" type="text" value="{{ $customer->customer_number }}" readonly
                       class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-700 placeholder-gray-400 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-200" />
            @else
                <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">Nomor Nasabah akan dibuat otomatis oleh sistem</p>
            @endif
        </div>

        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Nama <span class="text-rose-500">*</span>
            </label>
            <input id="name" name="name" type="text" value="{{ old('name', $customer->name ?? '') }}" required
                   class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500" />
            @error('name')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="balance" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Saldo</label>
            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-gray-400 dark:text-gray-500">
                    Rp
                </span>
                <input id="balance" name="balance" type="text" inputmode="numeric"
                    value="{{ old('balance', $customer->balance ?? '') }}"
                    class="block w-full rounded-lg border border-gray-300 bg-white pl-9 pr-3 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500" />
            </div>
            @error('balance')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Telepon</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone', $customer->phone ?? '') }}"
                   class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500" />
            @error('phone')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <div>
        <label for="address" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Alamat</label>
        <textarea id="address" name="address" rows="4"
                  class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-100 dark:placeholder-gray-500">{{ old('address', $customer->address ?? '') }}</textarea>
        @error('address')
            <p class="mt-1.5 flex items-center gap-1 text-xs text-rose-600 dark:text-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 shrink-0"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <label for="is_active" class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-gray-100 dark:border-neutral-800 dark:bg-neutral-800/50 dark:hover:bg-neutral-800">
        <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $customer->is_active ?? true) ? 'checked' : '' }}
               class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-2 focus:ring-emerald-500/30 dark:border-neutral-600 dark:bg-neutral-800">
        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Nasabah aktif</span>
    </label>

    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5 dark:border-neutral-800">
        <button type="submit"
                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                <polyline points="17 21 17 13 7 13 7 21" />
                <polyline points="7 3 7 8 15 8" />
            </svg>
            Simpan Nasabah
        </button>
    </div>
</div>
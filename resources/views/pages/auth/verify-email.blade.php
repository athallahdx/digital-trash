<x-layouts::auth :title="__('Verifikasi Email')">
    <div class="flex flex-col gap-6 mt-4">
        <!-- Icon Badge -->
        <div class="flex justify-center">
            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 ring-1 ring-emerald-100 dark:ring-emerald-900/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="M3 7l9 6 9-6" />
                    <path d="M17 13l2 2 4-4" stroke="currentColor" />
                </svg>
            </div>
        </div>

        <div class="text-center">
            <h1 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                {{ __('Verifikasi Alamat Email Anda') }}
            </h1>
            <flux:text class="mt-2 text-sm leading-relaxed text-center text-zinc-500 dark:text-zinc-400">
                {{ __('Silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda.') }}
            </flux:text>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="flex items-center gap-2 px-4 py-3 text-sm font-medium text-center text-emerald-700 border rounded-lg justify-center bg-emerald-50 border-emerald-200 dark:bg-emerald-950/40 dark:border-emerald-900/50 dark:text-emerald-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <path d="M22 4L12 14.01l-3-3" />
                </svg>
                <span>{{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat pendaftaran.') }}</span>
            </div>
        @endif

        <div class="flex flex-col items-center justify-between gap-3">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <flux:button
                    type="submit"
                    variant="primary"
                    class="w-full !bg-emerald-600 hover:!bg-emerald-700 dark:!bg-emerald-600 dark:hover:!bg-emerald-500 transition-colors duration-150 shadow-sm hover:shadow-md focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-zinc-900"
                >
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </flux:button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:button
                    variant="ghost"
                    type="submit"
                    class="w-full text-sm cursor-pointer text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition-colors duration-150"
                    data-test="logout-button"
                >
                    {{ __('Keluar') }}
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts::auth>
<x-layouts::auth :title="__('Lupa Kata Sandi')">
    <div class="flex flex-col gap-6">
        <!-- Icon Badge -->
        <div class="flex justify-center">
            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 ring-1 ring-emerald-100 dark:ring-emerald-900/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="M3 7l9 6 9-6" />
                </svg>
            </div>
        </div>

        <x-auth-header :title="__('Lupa Kata Sandi')" :description="__('Masukkan alamat email Anda untuk menerima tautan reset kata sandi')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Alamat Email')"
                type="email"
                required
                autofocus
                placeholder="nama@email.com"
                class="[&_input]:transition-colors [&_input]:duration-150"
            />

            <flux:button
                variant="primary"
                type="submit"
                class="w-full !bg-emerald-600 hover:!bg-emerald-700 dark:!bg-emerald-600 dark:hover:!bg-emerald-500 transition-colors duration-150 shadow-sm hover:shadow-md focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-zinc-900"
                data-test="email-password-reset-link-button"
            >
                {{ __('Kirim Tautan Reset Kata Sandi') }}
            </flux:button>
        </form>

        <div class="flex items-center justify-center gap-1.5 text-center text-sm text-zinc-500 dark:text-zinc-400">
            <span>{{ __('Atau, kembali ke') }}</span>
            <flux:link
                :href="route('login')"
                wire:navigate
                class="font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 underline-offset-4 transition-colors duration-150 rounded-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500"
            >
                {{ __('halaman masuk') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>
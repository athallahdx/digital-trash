<x-layouts::auth :title="__('Autentikasi Dua Faktor')">
    <div class="flex flex-col gap-6">
        <div
            class="relative w-full h-auto"
            x-cloak
            x-data="{
                showRecoveryInput: @js($errors->has('recovery_code')),
                code: '',
                recovery_code: '',
                focusOtp() {
                    this.$nextTick(() => this.$refs.otp?.querySelector('input')?.focus());
                },
                init() {
                    if (! this.showRecoveryInput) {
                        this.focusOtp();
                    }
                },
                toggleInput() {
                    this.showRecoveryInput = !this.showRecoveryInput;

                    this.code = '';
                    this.recovery_code = '';

                    $nextTick(() => {
                        this.showRecoveryInput
                            ? this.$refs.recovery_code?.focus()
                            : this.focusOtp();
                    });
                },
            }"
        >
            <!-- Icon Badge -->
            <div class="flex justify-center mb-6">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 ring-1 ring-emerald-100 dark:ring-emerald-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="5" y="11" width="14" height="10" rx="2" />
                        <path d="M8 11V7a4 4 0 0 1 8 0v4" />
                        <path d="M12 15v2" />
                    </svg>
                </div>
            </div>

            <div x-show="!showRecoveryInput">
                <x-auth-header
                    :title="__('Kode Autentikasi')"
                    :description="__('Masukkan kode autentikasi dari aplikasi autentikator Anda.')"
                />
            </div>

            <div x-show="showRecoveryInput">
                <x-auth-header
                    :title="__('Kode Pemulihan')"
                    :description="__('Konfirmasi akses ke akun Anda dengan memasukkan salah satu kode pemulihan darurat.')"
                />
            </div>

            <form method="POST" action="{{ route('two-factor.login.store') }}">
                @csrf

                <div class="space-y-5 text-center">
                    <div x-show="!showRecoveryInput">
                        <div class="flex items-center justify-center my-6" x-ref="otp">
                            <flux:otp
                                x-model="code"
                                length="6"
                                name="code"
                                label="Kode OTP"
                                label:sr-only
                                class="mx-auto"
                             />
                        </div>
                    </div>

                    <div x-show="showRecoveryInput">
                        <div class="my-6">
                            <flux:input
                                type="text"
                                name="recovery_code"
                                :label="__('Kode Pemulihan')"
                                label:sr-only
                                x-ref="recovery_code"
                                x-bind:required="showRecoveryInput"
                                autocomplete="one-time-code"
                                x-model="recovery_code"
                                :placeholder="__('Masukkan kode pemulihan')"
                            />
                        </div>

                        @error('recovery_code')
                            <flux:text color="red" class="text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </flux:text>
                        @enderror
                    </div>

                    <flux:button
                        variant="primary"
                        type="submit"
                        class="w-full !bg-emerald-600 hover:!bg-emerald-700 dark:!bg-emerald-600 dark:hover:!bg-emerald-500 transition-colors duration-150 shadow-sm hover:shadow-md focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-zinc-900"
                    >
                        {{ __('Lanjutkan') }}
                    </flux:button>
                </div>

                <div class="flex items-center justify-center gap-1.5 mt-6 text-sm leading-5 text-center">
                    <span class="text-zinc-500 dark:text-zinc-400">{{ __('atau Anda dapat') }}</span>
                    <span
                        tabindex="0"
                        role="button"
                        @click="toggleInput()"
                        @keydown.enter="toggleInput()"
                        @keydown.space.prevent="toggleInput()"
                        class="font-medium text-emerald-600 underline underline-offset-4 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 cursor-pointer transition-colors duration-150 rounded-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500"
                    >
                        <span x-show="!showRecoveryInput">{{ __('masuk menggunakan kode pemulihan') }}</span>
                        <span x-show="showRecoveryInput">{{ __('masuk menggunakan kode autentikasi') }}</span>
                    </span>
                </div>
            </form>
        </div>
    </div>
</x-layouts::auth>
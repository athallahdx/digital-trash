<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bank Sampah Jati Sabrang - Desa Bodaskarangjati</title>
        <meta name="description" content="Bank Sampah Jati Sabrang, Desa Bodaskarangjati. Ayo kelola sampah jadi berkah bersama warga.">

        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="Bank Sampah Jati Sabrang" />
        <link rel="manifest" href="/site.webmanifest" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            html { scroll-behavior: smooth; }
            body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        </style>
    </head>
    <body class="bg-white text-gray-800 antialiased">

        {{-- ==================== NAVBAR ==================== --}}
        <header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="#" class="flex items-center gap-2 font-semibold text-green-700">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full text-white">
                        <img src="/main-logo.png" alt="Logo Bank Sampah Jati Sabrang" class="h-9 w-9">
                    </span>
                    <span class="leading-tight">
                        <span class="block text-sm sm:text-base">Bank Sampah Jati Sabrang</span>
                        <span class="block text-[11px] font-normal text-gray-500">Desa Bodaskarangjati</span>
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
                    <a href="#tentang" class="hover:text-green-700">Tentang</a>
                    <a href="#jadwal" class="hover:text-green-700">Jadwal</a>
                    <a href="#galeri" class="hover:text-green-700">Kegiatan</a>
                    <a href="#gabung" class="hover:text-green-700">Gabung</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="#gabung"
                       class="hidden sm:inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">
                        Gabung Jadi Anggota
                    </a>
                    {{-- Login khusus pengurus/pengelola bank sampah — sengaja dibuat kecil, bukan CTA utama.
                         Ganti href sesuai path panel Filament kamu, misal route('filament.admin.auth.login') --}}
                    <a href="/admin" class="text-sm text-gray-500 hover:text-green-700 underline underline-offset-4">
                        Login Pengelola
                    </a>
                </div>
            </div>
        </header>

        {{-- ==================== HERO ==================== --}}
        <section class="relative overflow-hidden bg-gradient-to-b from-green-50 to-white">
            <div class="max-w-6xl mx-auto px-6 pt-16 pb-20 sm:pt-24 sm:pb-28 grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="5"/></svg>
                        Desa Bodaskarangjati
                    </span>

                    <h1 class="mt-5 text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
                        Bank Sampah 
                        <p class="text-green-700">Jati Sabrang</p>
                    </h1>

                    <p class="mt-5 text-lg text-gray-600 leading-relaxed">
                        Wadah warga Desa Bodaskarangjati untuk memilah, menyetor, dan mengelola sampah
                        menjadi tabungan. Sampah dikelola dengan tercatat rapi, mulai dari setoran warga
                        sampai penarikan saldo.
                    </p>

                    <div class="mt-6 flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        <span class="text-sm text-gray-700">
                            Buka setiap <strong>hari Jumat</strong>, 2 minggu sekali (2 bulan sekali)
                        </span>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="#gabung"
                           class="inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white hover:bg-green-700 transition">
                            Gabung Jadi Anggota
                        </a>
                        <a href="#galeri"
                           class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            Lihat Kegiatan Kami
                        </a>
                    </div>
                </div>

                {{-- Foto hero — ganti placeholder ini dengan foto asli kegiatan --}}
                 <div class="relative">
                    <div class="aspect-[4/3] rounded-2xl border-2 border-dashed border-green-200 bg-white overflow-hidden shadow-sm">
                        <img src="/assets/main.jpeg" alt="Foto Utama Bank Sampah Jati Sabrang" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== TENTANG ==================== --}}
        <section id="tentang" class="py-20 border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-6">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold text-gray-900">Tentang Bank Sampah</h2>
                    <p class="mt-3 text-gray-600">
                        Bank Sampah Jati Sabrang membantu warga Desa Bodaskarangjati memilah sampah
                        rumah tangga yang masih bernilai, lalu menyetorkannya untuk dicatat sebagai
                        tabungan yang bisa ditarik kapan saja.
                    </p>
                </div>

                <div class="mt-12 grid sm:grid-cols-3 gap-6">
                    <div class="rounded-xl border border-gray-100 p-6 hover:shadow-sm transition">
                        <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2v20M2 12h20" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">Setor Sampah Terpilah</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Warga membawa sampah yang sudah dipilah untuk ditimbang dan dicatat sebagai setoran.
                        </p>
                    </div>

                    <div class="rounded-xl border border-gray-100 p-6 hover:shadow-sm transition">
                        <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="14" rx="2" />
                                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">Tercatat Rapi</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Setiap setoran dan penarikan dicatat oleh pengelola sehingga saldo warga transparan.
                        </p>
                    </div>

                    <div class="rounded-xl border border-gray-100 p-6 hover:shadow-sm transition">
                        <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22V12M12 12 3 7l9-5 9 5-9 5Z" /><path d="M3 7v10l9 5 9-5V7" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">Saldo Bisa Ditarik</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Saldo hasil setoran sampah bisa ditarik oleh warga sesuai kebutuhan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== JADWAL ==================== --}}
        <section id="jadwal" class="py-16 bg-green-50 border-t border-green-100">
            <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Jadwal Buka</h2>
                    <p class="mt-2 text-gray-600">
                        Bank Sampah Jati Sabrang hadir setiap hari <strong>Jumat</strong>, 2 minggu sekali
                        (2 bulan sekali). Datang bawa sampah terpilah dari rumah, ya!
                    </p>
                </div>
                <a href="#gabung"
                   class="inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white hover:bg-green-700 transition whitespace-nowrap">
                    Tanya Jadwal Terdekat
                </a>
            </div>
        </section>

        {{-- ==================== GALERI KEGIATAN ==================== --}}
        <section id="galeri" class="py-20">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-gray-900">Kegiatan Kami</h2>
                <p class="mt-3 text-gray-600 max-w-2xl">
                    Dokumentasi kegiatan pencatatan setoran, pemilahan, dan pengelolaan sampah bersama warga.
                </p>

                <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach ([
                        ['src' => '/assets/img-1.jpeg'],
                        ['src' => '/assets/img-2.jpeg'],
                        ['src' => '/assets/img-3.jpeg'],
                        ['src' => '/assets/img-4.jpeg'],
                        ['src' => '/assets/img-5.jpeg'],
                        ['src' => '/assets/img-6.jpeg'],
                    ] as $item)
                        <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                            <img src="{{ $item['src'] }}" alt="{{ 'Dokumentasi Kegiatan ' . $loop->iteration }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ==================== CTA GABUNG ==================== --}}
        <section id="gabung" class="py-20 border-t border-gray-100">
            <div class="max-w-4xl mx-auto px-6">
                <div class="rounded-2xl bg-green-700 px-8 py-12 sm:px-14 sm:py-16 text-center text-white">
                    <h2 class="text-3xl font-bold">Yuk, Jadi Anggota Bank Sampah</h2>
                    <p class="mt-3 text-green-50 max-w-xl mx-auto">
                        Warga Desa Bodaskarangjati bisa mulai menabung dari sampah rumah tangga.
                        Datang langsung saat jadwal buka, atau hubungi pengurus untuk informasi pendaftaran.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        {{-- Ganti nomor WhatsApp di bawah dengan nomor pengurus yang sebenarnya --}}
                        <a href="https://wa.me/6285227942227?text=Halo%2C%20saya%20warga%20Bodaskarangjati%20ingin%20gabung%20Bank%20Sampah%20Jati%20Sabrang"
                           target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-green-700 hover:bg-green-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.36 5.07L2 22l5.09-1.33A9.94 9.94 0 0 0 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2Zm5.2 14.2c-.22.62-1.28 1.2-1.77 1.24-.45.05-.94.24-3.14-.66-2.65-1.09-4.35-3.8-4.48-3.98-.13-.18-1.07-1.42-1.07-2.7s.67-1.92.9-2.18c.22-.26.48-.32.65-.32.16 0 .32 0 .46.01.15.01.35-.06.55.42.22.53.73 1.83.8 1.96.06.13.1.29.02.47-.08.18-.13.29-.25.44-.13.16-.27.35-.38.47-.13.13-.26.27-.11.53.15.26.66 1.09 1.42 1.77.98.87 1.8 1.14 2.06 1.27.26.13.41.11.56-.07.16-.18.65-.76.82-1.02.17-.26.34-.22.57-.13.23.09 1.45.68 1.7.81.25.13.41.19.47.3.06.11.06.62-.16 1.24Z"/>
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                        <a href="#jadwal"
                           class="inline-flex items-center gap-2 rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white hover:bg-white/10 transition">
                            Lihat Jadwal
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== FOOTER ==================== --}}
        <footer class="border-t border-gray-100 py-10">
            <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Bank Sampah Jati Sabrang &mdash; Desa Bodaskarangjati</p>
                <div class="flex items-center gap-6">
                    <a href="#tentang" class="hover:text-green-700">Tentang</a>
                    <a href="#galeri" class="hover:text-green-700">Kegiatan</a>
                    {{-- Login pengelola tetap tersedia di footer, tapi tetap kecil/tidak mencolok --}}
                    <a href="/admin" class="hover:text-green-700 underline underline-offset-4">Login Pengelola</a>
                </div>
            </div>
        </footer>

    </body>
</html>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth h-full bg-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Portofolio Terpadu Kelompok 05 - Pemrograman Web Sem 5')</title>
    <meta name="description" content="Portofolio resmi kolaboratif 4 anggota kelompok mahasiswa mata kuliah Pemrograman Web Semester 5. Dokumentasi proyek web dan arsitektur sistem berbasis Laravel dan MySQL.">

    <!-- Fonts: JetBrains Mono & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-black text-zinc-100 min-h-screen flex flex-col antialiased selection:bg-white selection:text-black">

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-40 bg-black/90 backdrop-blur-md border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-mono group">
                    <span class="px-2 py-0.5 bg-white text-black font-bold text-xs">[05]</span>
                    <span class="font-bold text-sm tracking-tight text-white group-hover:text-zinc-300 transition">KELOMPOK_05</span>
                    <span class="hidden sm:inline text-zinc-600 text-xs">// PW.SEM5</span>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-6 font-mono text-xs">
                    <a href="{{ route('home') }}#hero" class="text-zinc-400 hover:text-white transition">00.BERANDA</a>
                    <a href="{{ route('home') }}#members" class="text-zinc-400 hover:text-white transition">01.TIM_ANGGOTA</a>
                    <a href="{{ route('home') }}#projects" class="text-zinc-400 hover:text-white transition">02.PROYEK_KARYA</a>
                    <a href="{{ route('home') }}#about" class="text-zinc-400 hover:text-white transition">03.SPESIFIKASI</a>
                    <a href="{{ route('home') }}#contact" class="text-zinc-400 hover:text-white transition">04.KONTAK</a>
                </nav>

                <!-- Auth Status / Discreet Action -->
                <div class="hidden md:flex items-center gap-3 font-mono text-xs">
                    @auth
                        <a href="{{ route('dashboard.index') }}" class="px-3 py-1.5 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 border border-zinc-700 transition">
                            [DASHBOARD →]
                        </a>
                    @else
                        <span class="text-[11px] text-zinc-600">STATUS: LIVE</span>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button id="mobile-menu-btn" type="button" class="p-2 text-zinc-400 hover:text-white font-mono text-xs">
                        [MENU]
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-zinc-800 bg-zinc-950 px-4 py-4 space-y-3 font-mono text-xs">
            <a href="{{ route('home') }}#hero" class="block text-zinc-300 hover:text-white py-1">00. BERANDA</a>
            <a href="{{ route('home') }}#members" class="block text-zinc-300 hover:text-white py-1">01. TIM ANGGOTA (4)</a>
            <a href="{{ route('home') }}#projects" class="block text-zinc-300 hover:text-white py-1">02. PORTOFOLIO KARYA</a>
            <a href="{{ route('home') }}#about" class="block text-zinc-300 hover:text-white py-1">03. SPESIFIKASI TUGAS</a>
            <a href="{{ route('home') }}#contact" class="block text-zinc-300 hover:text-white py-1">04. KONTAK KELOMPOK</a>
            @auth
                <div class="pt-2 border-t border-zinc-800">
                    <a href="{{ route('dashboard.index') }}" class="block text-white py-1">[DASHBOARD PANEL]</a>
                </div>
            @endauth
        </div>
    </header>

    <!-- Global Toast / Alerts -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full" id="alert-banner-success">
            <div class="flex items-center justify-between p-3 bg-zinc-900 border border-emerald-500/40 text-emerald-300 font-mono text-xs">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-400 font-bold">[OK]</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('alert-banner-success').remove()" class="text-zinc-500 hover:text-white">
                    [×]
                </button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full" id="alert-banner-info">
            <div class="flex items-center justify-between p-3 bg-zinc-900 border border-sky-500/40 text-sky-300 font-mono text-xs">
                <div class="flex items-center gap-2">
                    <span class="text-sky-400 font-bold">[INFO]</span>
                    <span>{{ session('info') }}</span>
                </div>
                <button onclick="document.getElementById('alert-banner-info').remove()" class="text-zinc-500 hover:text-white">
                    [×]
                </button>
            </div>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full" id="alert-banner-error">
            <div class="flex items-start justify-between p-3.5 bg-zinc-900 border border-rose-500/40 text-rose-300 font-mono text-xs">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-rose-400 font-bold">[ERROR]</span>
                        <span>{{ session('error') ?? 'Terdapat kesalahan pada input formulir:' }}</span>
                    </div>
                    @if($errors->any())
                        <ul class="list-disc list-inside text-zinc-400 text-[11px] pl-5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button onclick="document.getElementById('alert-banner-error').remove()" class="text-zinc-500 hover:text-white">
                    [×]
                </button>
            </div>
        </div>
    @endif

    <!-- Content Area -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Edgy Minimalist Footer -->
    <footer class="border-t border-zinc-900 bg-black mt-24 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="md:col-span-2 space-y-3 font-mono">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 bg-white text-black font-bold text-xs">[05]</span>
                        <span class="font-bold text-white tracking-wider">KELOMPOK 05 // SEMESTER 5</span>
                    </div>
                    <p class="text-xs text-zinc-400 leading-relaxed font-sans max-w-md">
                        Portofolio terpadu 4 mahasiswa untuk mata kuliah <strong>Pemrograman Web (Semester 5)</strong>. Dikembangkan secara mandiri menggunakan stack Laravel 13 dan MySQL.
                    </p>
                    <div class="flex items-center gap-2 pt-2 text-[11px] text-zinc-500">
                        <span>PHP 8.5</span> &bull; <span>LARAVEL 13</span> &bull; <span>MYSQL</span> &bull; <span>TAILWIND V4</span>
                    </div>
                </div>

                <div>
                    <h3 class="font-mono text-xs font-bold text-white uppercase tracking-wider mb-4">// NAVIGASI</h3>
                    <ul class="space-y-2 font-mono text-xs text-zinc-400">
                        <li><a href="{{ route('home') }}#hero" class="hover:text-white transition">00. Beranda</a></li>
                        <li><a href="{{ route('home') }}#members" class="hover:text-white transition">01. Tim Mahasiswa (4)</a></li>
                        <li><a href="{{ route('home') }}#projects" class="hover:text-white transition">02. Arsip Karya Proyek</a></li>
                        <li><a href="{{ route('home') }}#about" class="hover:text-white transition">03. Spesifikasi Teknis</a></li>
                        <li><a href="{{ route('home') }}#contact" class="hover:text-white transition">04. Kirim Pesan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-mono text-xs font-bold text-white uppercase tracking-wider mb-4">// AKSES INTERNAL</h3>
                    <p class="text-xs text-zinc-500 leading-relaxed mb-4 font-sans">
                        Pengelolaan data anggota kelompok dan portofolio proyek dilakukan melalui portal manajemen.
                    </p>
                    <a href="{{ route('login') }}" class="inline-block px-3 py-1.5 bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800 font-mono text-xs transition">
                        [ PORTAL_LOGIN → ]
                    </a>
                </div>
            </div>

            <div class="pt-8 border-t border-zinc-900 flex flex-col sm:flex-row items-center justify-between font-mono text-xs text-zinc-600 gap-4">
                <p>&copy; {{ date('Y') }} KELOMPOK 05. ALL RIGHTS RESERVED.</p>
                <p>MATA KULIAH PEMROGRAMAN WEB &bull; TUGAS KELOMPOK</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Nav Script -->
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>

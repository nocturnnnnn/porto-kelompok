<!DOCTYPE html>
<html lang="id" class="h-full bg-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Akses Sistem - Kelompok 05')</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
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
<body class="min-h-full bg-black text-zinc-100 flex flex-col justify-between antialiased selection:bg-white selection:text-black">
    <!-- Minimalist Top Bar -->
    <header class="border-b border-zinc-800 bg-zinc-950 px-6 py-4">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-mono text-xs text-zinc-400 hover:text-white transition flex items-center gap-2">
                <span>←</span>
                <span>kembali_ke_portofolio</span>
            </a>
            <div class="font-mono text-xs text-zinc-500 uppercase tracking-widest">
                [SYS.AUTH // KELOMPOK_05]
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        @yield('content')
    </main>

    <!-- Minimalist Footer -->
    <footer class="border-t border-zinc-900 bg-black px-6 py-4 text-center font-mono text-[11px] text-zinc-600">
        <span>&copy; {{ date('Y') }} KELOMPOK 05 &bull; PEMROGRAMAN WEB (SEM 5)</span>
    </footer>

    @stack('scripts')
</body>
</html>

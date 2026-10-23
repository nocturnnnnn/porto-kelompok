<!DOCTYPE html>
<html lang="id" class="h-full bg-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Kelola Portofolio') - Kelompok 05</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
    @stack('styles')
</head>
<body class="bg-black text-zinc-100 min-h-screen antialiased flex flex-col md:flex-row selection:bg-white selection:text-black">
    
    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-zinc-950 border-r border-zinc-800 shrink-0 flex flex-col justify-between">
        <div>
            <!-- Sidebar Header -->
            <div class="h-16 px-6 flex items-center justify-between border-b border-zinc-800">
                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2.5 font-mono">
                    <span class="w-7 h-7 bg-white text-black flex items-center justify-center font-bold text-xs">[05]</span>
                    <div>
                        <span class="font-bold text-sm tracking-tight text-white block leading-tight">PANEL.CRUD</span>
                        <span class="text-[10px] text-zinc-500 font-mono">KELOMPOK 05 // SEM 5</span>
                    </div>
                </a>

                <button id="sidebar-toggle-btn" type="button" class="md:hidden p-2 text-zinc-400 hover:text-white font-mono text-xs">
                    [MENU]
                </button>
            </div>

            <!-- Collapsible Menu Wrapper on Mobile -->
            <div id="sidebar-menu-wrapper" class="hidden md:block">
                <!-- Navigation Links -->
                <nav class="p-4 space-y-1 font-mono text-xs">
                    <div class="px-3 py-2 text-[10px] font-bold uppercase tracking-widest text-zinc-600">
                        // NAVIGASI
                    </div>
                    
                    <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-3 py-2.5 transition {{ request()->routeIs('dashboard.index') ? 'bg-white text-black font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
                        <span>[00]</span>
                        <span>Ringkasan Overview</span>
                    </a>

                    <a href="{{ route('dashboard.members.index') }}" class="flex items-center gap-3 px-3 py-2.5 transition {{ request()->routeIs('dashboard.members.*') ? 'bg-white text-black font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
                        <span>[01]</span>
                        <span>Anggota Kelompok</span>
                    </a>

                    <a href="{{ route('dashboard.projects.index') }}" class="flex items-center gap-3 px-3 py-2.5 transition {{ request()->routeIs('dashboard.projects.*') ? 'bg-white text-black font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
                        <span>[02]</span>
                        <span>Portofolio Proyek</span>
                    </a>

                    <a href="{{ route('dashboard.messages.index') }}" class="flex items-center justify-between px-3 py-2.5 transition {{ request()->routeIs('dashboard.messages.*') ? 'bg-white text-black font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
                        <div class="flex items-center gap-3">
                            <span>[03]</span>
                            <span>Pesan Masuk</span>
                        </div>
                        @php
                            $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="px-1.5 py-0.2 text-[10px] font-bold bg-white text-black">{{ $unreadCount }}</span>
                        @endif
                    </a>

                    <div class="pt-4 px-3 py-2 text-[10px] font-bold uppercase tracking-widest text-zinc-600">
                        // PENGATURAN
                    </div>

                    <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-3 py-2.5 transition {{ request()->routeIs('dashboard.profile') ? 'bg-white text-black font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
                        <span>[•]</span>
                        <span>Profil Akun</span>
                    </a>

                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 text-zinc-400 hover:text-white hover:bg-zinc-900 transition">
                        <span>[↗]</span>
                        <span>Buka Web Publik</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- User Info / Logout Footer -->
        <div class="p-4 border-t border-zinc-800 bg-zinc-950 font-mono text-xs">
            <div class="flex items-center justify-between">
                <div class="truncate mr-2">
                    <p class="font-bold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-zinc-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-2 py-1 bg-zinc-900 hover:bg-zinc-800 text-zinc-400 hover:text-rose-400 border border-zinc-800 text-[11px] transition" title="Logout">
                        [KELUAR]
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Body -->
    <div class="flex-1 flex flex-col min-w-0 bg-black">
        <!-- Top Nav Bar -->
        <header class="h-16 bg-zinc-950 border-b border-zinc-800 px-6 flex items-center justify-between sticky top-0 z-40">
            <div class="flex items-center gap-3 font-mono">
                <h1 class="text-sm md:text-base font-bold text-white uppercase tracking-tight">
                    @yield('page_heading', 'Dashboard')
                </h1>
                <span class="text-zinc-600 text-xs hidden sm:inline">// CRUD.ACTIVE</span>
            </div>

            <div class="flex items-center gap-3 font-mono text-xs">
                <a href="{{ route('home') }}" class="px-3 py-1.5 bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800 transition">
                    [WEB PUBLIK →]
                </a>
            </div>
        </header>

        <!-- Alerts -->
        @if(session('success'))
            <div class="mx-6 mt-6 p-3 bg-zinc-900 border border-emerald-500/40 text-emerald-300 font-mono text-xs flex items-center justify-between" id="dash-success">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-400 font-bold">[OK]</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('dash-success').remove()" class="text-zinc-500 hover:text-white">
                    [×]
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mx-6 mt-6 p-4 bg-zinc-900 border border-rose-500/40 text-rose-300 font-mono text-xs">
                <div class="font-bold text-rose-400 mb-2 uppercase">
                    [!] Terdapat kesalahan input:
                </div>
                <ul class="list-disc list-inside space-y-1 text-zinc-400">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Body -->
        <main class="flex-1 p-6 md:p-8">
            @yield('content')
        </main>
    </div>

    <script>
        document.getElementById('sidebar-toggle-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('sidebar-menu-wrapper');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>

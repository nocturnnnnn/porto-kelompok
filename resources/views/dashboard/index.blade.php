@extends('layouts.dashboard')

@section('title', 'Overview Dashboard')
@section('page_heading', 'Ringkasan Sistem')

@section('content')
<div class="space-y-6">
    <!-- Top Greeting Banner -->
    <div class="border border-zinc-800 bg-zinc-950 p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="font-mono text-xs text-zinc-500 uppercase tracking-widest">
                    // SISTEM INFORMASI // PEMROGRAMAN WEB (SEM 5)
                </div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight uppercase">
                    Panel Kontrol: {{ Auth::user()->name }}
                </h2>
                <p class="text-xs sm:text-sm text-zinc-400 max-w-2xl font-mono leading-relaxed">
                    Pengelolaan terpadu profil 4 anggota kelompok, rekam jejak portofolio proyek (CRUD), dan tinjauan pesan feedback.
                </p>
            </div>
            <div class="flex items-center gap-3 font-mono text-xs">
                <a href="{{ route('dashboard.projects.create') }}" class="px-4 py-2.5 bg-white text-black font-bold uppercase hover:bg-zinc-200 transition">
                    + Tambah Proyek
                </a>
                <a href="{{ route('dashboard.members.create') }}" class="px-4 py-2.5 bg-zinc-900 text-zinc-200 border border-zinc-700 hover:border-zinc-500 uppercase transition">
                    + Tambah Anggota
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 font-mono">
        <!-- Stat 1: Total Anggota -->
        <div class="bg-zinc-950 border border-zinc-800 p-5 hover:border-zinc-500 transition">
            <p class="text-[11px] uppercase tracking-wider text-zinc-500">// TOTAL ANGGOTA</p>
            <h3 class="text-3xl font-extrabold text-white mt-2">{{ $totalMembers }} <span class="text-xs font-normal text-zinc-500">/ 04 ORANG</span></h3>
            <p class="text-[11px] text-zinc-400 mt-2">Kapasitas tim terpenuhi</p>
        </div>

        <!-- Stat 2: Total Proyek -->
        <div class="bg-zinc-950 border border-zinc-800 p-5 hover:border-zinc-500 transition">
            <p class="text-[11px] uppercase tracking-wider text-zinc-500">// TOTAL KARYA</p>
            <h3 class="text-3xl font-extrabold text-white mt-2">{{ $totalProjects }} <span class="text-xs font-normal text-zinc-500">PROYEK</span></h3>
            <p class="text-[11px] text-zinc-400 mt-2">Arsip portofolio aktif</p>
        </div>

        <!-- Stat 3: Pesan Masuk -->
        <div class="bg-zinc-950 border border-zinc-800 p-5 hover:border-zinc-500 transition">
            <p class="text-[11px] uppercase tracking-wider text-zinc-500">// PESAN MASUK</p>
            <h3 class="text-3xl font-extrabold text-white mt-2">{{ $totalMessages }} <span class="text-xs font-normal text-zinc-500">FEEDBACK</span></h3>
            <p class="text-[11px] text-zinc-400 mt-2">{{ $unreadMessages }} pesan belum dibaca</p>
        </div>

        <!-- Stat 4: Sistem Status -->
        <div class="bg-zinc-950 border border-zinc-800 p-5 hover:border-zinc-500 transition">
            <p class="text-[11px] uppercase tracking-wider text-zinc-500">// KONEKSI DATABASE</p>
            <h3 class="text-xl font-bold text-emerald-400 mt-2 flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-emerald-400"></span>
                <span>MYSQL ONLINE</span>
            </h3>
            <p class="text-[11px] text-zinc-500 mt-2">PHP 8.5 &bull; LARAVEL 13</p>
        </div>
    </div>

    <!-- Two Columns: Anggota Tim & Portofolio Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Kolom 1: Anggota Tim -->
        <div class="bg-zinc-950 border border-zinc-800 p-6">
            <div class="flex items-center justify-between mb-5 font-mono">
                <div>
                    <h3 class="text-base font-bold text-white uppercase tracking-tight">// ANGGOTA KELOMPOK</h3>
                    <p class="text-xs text-zinc-500">{{ $recentMembers->count() }} Anggota Terdaftar</p>
                </div>
                <a href="{{ route('dashboard.members.index') }}" class="text-xs text-zinc-400 hover:text-white transition">
                    [KELOLA →]
                </a>
            </div>

            <div class="space-y-3">
                @forelse($recentMembers as $mem)
                    <div class="flex items-center justify-between p-3 bg-black border border-zinc-800/80 hover:border-zinc-700 transition">
                        <div class="flex items-center gap-3">
                            <img src="{{ $mem->photo_url }}" alt="{{ $mem->name }}" class="w-10 h-10 object-cover border border-zinc-800 grayscale">
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $mem->name }}</h4>
                                <div class="font-mono text-[11px] text-zinc-400 mt-0.5">
                                    <span>NIM: {{ $mem->nim }}</span> &bull; <span>{{ $mem->role }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.members.edit', $mem) }}" class="px-2 py-1 text-xs font-mono text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition">
                            EDIT
                        </a>
                    </div>
                @empty
                    <p class="text-center py-6 font-mono text-xs text-zinc-500">[ BELUM ADA DATA ANGGOTA ]</p>
                @endforelse
            </div>
        </div>

        <!-- Kolom 2: Portofolio Terbaru -->
        <div class="bg-zinc-950 border border-zinc-800 p-6">
            <div class="flex items-center justify-between mb-5 font-mono">
                <div>
                    <h3 class="text-base font-bold text-white uppercase tracking-tight">// PROYEK TERBARU</h3>
                    <p class="text-xs text-zinc-500">Showcase Karya</p>
                </div>
                <a href="{{ route('dashboard.projects.index') }}" class="text-xs text-zinc-400 hover:text-white transition">
                    [KELOLA →]
                </a>
            </div>

            <div class="space-y-3">
                @forelse($recentProjects as $proj)
                    <div class="flex items-center justify-between p-3 bg-black border border-zinc-800/80 hover:border-zinc-700 transition">
                        <div class="flex items-center gap-3 truncate">
                            <img src="{{ $proj->image_url }}" alt="{{ $proj->title }}" class="w-10 h-10 object-cover border border-zinc-800 shrink-0 grayscale">
                            <div class="truncate">
                                <h4 class="text-sm font-bold text-white truncate">{{ $proj->title }}</h4>
                                <div class="font-mono text-[11px] text-zinc-400 mt-0.5 truncate">
                                    <span>[{{ $proj->category }}]</span> &bull; <span>{{ $proj->member?->name ?? 'Tim' }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.projects.edit', $proj) }}" class="px-2 py-1 text-xs font-mono text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition shrink-0">
                            EDIT
                        </a>
                    </div>
                @empty
                    <p class="text-center py-6 font-mono text-xs text-zinc-500">[ BELUM ADA PROYEK ]</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

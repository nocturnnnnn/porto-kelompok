@extends('layouts.auth')

@section('title', 'Login Panel - Kelompok 05')

@section('content')
<div class="w-full max-w-md">
    <div class="border border-zinc-800 bg-zinc-950 p-8 shadow-2xl">
        <!-- Header -->
        <div class="border-b border-zinc-800 pb-6 mb-6">
            <div class="font-mono text-[11px] text-zinc-500 uppercase tracking-wider mb-1">
                // AUTHENTICATION REQUIRED
            </div>
            <h1 class="text-xl font-bold text-white tracking-tight uppercase">
                Panel Manajemen Kelompok
            </h1>
            <p class="text-xs text-zinc-400 mt-1">
                Akses internal untuk mengelola profil 4 anggota dan portofolio proyek.
            </p>
        </div>

        <!-- Quick Autofill Helper -->
        <div class="mb-6 p-3 bg-zinc-900 border border-zinc-800 flex items-center justify-between font-mono text-xs">
            <div class="text-zinc-400 truncate">
                <span class="text-emerald-400">●</span> demo: <span class="text-white">admin@kelompok.test</span>
            </div>
            <button type="button" onclick="autofillDemo()" class="px-2.5 py-1 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-[11px] font-mono border border-zinc-700 transition">
                [GUNAKAN]
            </button>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5" id="loginForm">
            @csrf

            <div>
                <label for="email" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                    Email Pengguna
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    @class([
                        'w-full px-3.5 py-2.5 bg-black border text-white text-sm font-mono focus:outline-none focus:border-white transition',
                        'border-rose-500' => $errors->has('email'),
                        'border-zinc-800' => !$errors->has('email'),
                    ])
                    placeholder="admin@kelompok.test">
                @error('email')
                    <p class="mt-1 font-mono text-xs text-rose-400">! {{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block font-mono text-xs uppercase text-zinc-400">
                        Kata Sandi
                    </label>
                    <button type="button" onclick="togglePasswordVisibility()" class="font-mono text-[11px] text-zinc-500 hover:text-white">
                        <span id="pass-toggle-text">[LIHAT]</span>
                    </button>
                </div>
                <input type="password" id="password" name="password" required
                    @class([
                        'w-full px-3.5 py-2.5 bg-black border text-white text-sm font-mono focus:outline-none focus:border-white transition',
                        'border-rose-500' => $errors->has('password'),
                        'border-zinc-800' => !$errors->has('password'),
                    ])
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1 font-mono text-xs text-rose-400">! {{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer font-mono text-xs text-zinc-400">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded-none bg-black border-zinc-700 text-white focus:ring-0">
                    <span>Ingat sesi ini</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 bg-white hover:bg-zinc-200 text-black font-mono font-bold text-xs uppercase tracking-wider transition">
                Masuk ke Sistem →
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-zinc-800 text-center font-mono text-xs text-zinc-500">
            <span>Belum memiliki akun?</span>
            <a href="{{ route('register') }}" class="text-white hover:underline ml-1">Daftar Akun Baru</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function autofillDemo() {
        document.getElementById('email').value = 'admin@kelompok.test';
        document.getElementById('password').value = 'password';
    }

    function togglePasswordVisibility() {
        const pass = document.getElementById('password');
        const text = document.getElementById('pass-toggle-text');
        if (pass.type === 'password') {
            pass.type = 'text';
            text.textContent = '[SEMBUNYIKAN]';
        } else {
            pass.type = 'password';
            text.textContent = '[LIHAT]';
        }
    }
</script>
@endpush

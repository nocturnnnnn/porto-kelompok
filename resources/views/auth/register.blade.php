@extends('layouts.auth')

@section('title', 'Daftar Akun - Kelompok 05')

@section('content')
<div class="w-full max-w-md">
    <div class="border border-zinc-800 bg-zinc-950 p-8 shadow-2xl">
        <!-- Header -->
        <div class="border-b border-zinc-800 pb-6 mb-6">
            <div class="font-mono text-[11px] text-zinc-500 uppercase tracking-wider mb-1">
                // REGISTRATION
            </div>
            <h1 class="text-xl font-bold text-white tracking-tight uppercase">
                Daftar Akses Pengguna
            </h1>
            <p class="text-xs text-zinc-400 mt-1">
                Daftarkan akun baru untuk mengelola portofolio karya kelompok.
            </p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                    Nama Lengkap
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                    @class([
                        'w-full px-3.5 py-2.5 bg-black border text-white text-sm font-mono focus:outline-none focus:border-white transition',
                        'border-rose-500' => $errors->has('name'),
                        'border-zinc-800' => !$errors->has('name'),
                    ])
                    placeholder="Nama Lengkap">
                @error('name')
                    <p class="mt-1 font-mono text-xs text-rose-400">! {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                    Alamat Email
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    @class([
                        'w-full px-3.5 py-2.5 bg-black border text-white text-sm font-mono focus:outline-none focus:border-white transition',
                        'border-rose-500' => $errors->has('email'),
                        'border-zinc-800' => !$errors->has('email'),
                    ])
                    placeholder="nama@email.com">
                @error('email')
                    <p class="mt-1 font-mono text-xs text-rose-400">! {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                    Kata Sandi (Min. 6 Karakter)
                </label>
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

            <div>
                <label for="password_confirmation" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                    Konfirmasi Kata Sandi
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white text-sm font-mono focus:outline-none focus:border-white transition"
                    placeholder="••••••••">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 bg-white hover:bg-zinc-200 text-black font-mono font-bold text-xs uppercase tracking-wider transition">
                    Daftar & Masuk Otomatis →
                </button>
            </div>
        </form>

        <div class="mt-6 pt-6 border-t border-zinc-800 text-center font-mono text-xs text-zinc-500">
            <span>Sudah memiliki akun?</span>
            <a href="{{ route('login') }}" class="text-white hover:underline ml-1">Masuk ke Sistem</a>
        </div>
    </div>
</div>
@endsection

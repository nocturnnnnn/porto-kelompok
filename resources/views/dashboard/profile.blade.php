@extends('layouts.dashboard')

@section('title', 'Profil Akun Admin')
@section('page_heading', 'Pengaturan Akun')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-zinc-950 border border-zinc-800 p-6 md:p-8">
        <div class="flex items-center gap-4 pb-6 mb-6 border-b border-zinc-800">
            <div class="w-14 h-14 bg-white text-black flex items-center justify-center text-xl font-bold font-mono">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h3 class="text-base font-bold text-white uppercase">{{ $user->name }}</h3>
                <p class="font-mono text-xs text-zinc-400 mt-0.5">{{ $user->email }}</p>
                <span class="inline-block mt-2 px-2 py-0.5 font-mono text-[10px] uppercase bg-black text-emerald-400 border border-emerald-500/30">
                    AKUN_ADMINISTRATOR // AKTIF
                </span>
            </div>
        </div>

        <form action="{{ route('dashboard.profile.update') }}" method="POST" class="space-y-5 font-mono text-xs">
            @csrf
            @method('PUT')

            <!-- Nama Pengguna -->
            <div>
                <label for="name" class="block uppercase text-zinc-400 mb-1.5">
                    Nama Akun
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                @error('name')
                    <p class="text-rose-400 mt-1">! {{ $message }}</p>
                @enderror
            </div>

            <!-- Email Akun -->
            <div>
                <label for="email" class="block uppercase text-zinc-400 mb-1.5">
                    Alamat Email Login
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                @error('email')
                    <p class="text-rose-400 mt-1">! {{ $message }}</p>
                @enderror
            </div>

            <!-- Bagian Ubah Password -->
            <div class="pt-6 border-t border-zinc-800 space-y-4">
                <div>
                    <h4 class="text-sm font-bold text-white uppercase">// GANTI KATA SANDI (OPSIONAL)</h4>
                    <p class="text-zinc-500 mt-1 font-sans">Kosongkan jika tidak ingin mengubah kata sandi lama.</p>
                </div>

                <div>
                    <label for="current_password" class="block uppercase text-zinc-400 mb-1.5">
                        Kata Sandi Saat Ini
                    </label>
                    <input type="password" id="current_password" name="current_password"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                        placeholder="Konfirmasi password lama">
                    @error('current_password')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="new_password" class="block uppercase text-zinc-400 mb-1.5">
                            Kata Sandi Baru (Min. 6)
                        </label>
                        <input type="password" id="new_password" name="new_password"
                            class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                            placeholder="••••••••">
                        @error('new_password')
                            <p class="text-rose-400 mt-1">! {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block uppercase text-zinc-400 mb-1.5">
                            Ulangi Sandi Baru
                        </label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                            placeholder="••••••••">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex items-center justify-end">
                <button type="submit" class="px-5 py-2.5 bg-white text-black font-bold uppercase hover:bg-zinc-200 transition">
                    Simpan Perubahan →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

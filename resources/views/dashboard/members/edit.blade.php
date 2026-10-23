@extends('layouts.dashboard')

@section('title', 'Edit Anggota - ' . $member->name)
@section('page_heading', 'Edit Data Anggota')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between font-mono">
        <div>
            <h2 class="text-base font-bold text-white uppercase tracking-tight">// EDIT: {{ $member->name }}</h2>
            <p class="text-xs text-zinc-500 font-sans">NIM: {{ $member->nim }} &bull; Perbarui identitas profil mahasiswa.</p>
        </div>
        <a href="{{ route('dashboard.members.index') }}" class="px-3 py-1.5 text-xs text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="bg-zinc-950 border border-zinc-800 p-6 md:p-8">
        <form action="{{ route('dashboard.members.update', $member) }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-mono text-xs">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block uppercase text-zinc-400 mb-1.5">
                        Nama Lengkap *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                    @error('name')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- NIM -->
                <div>
                    <label for="nim" class="block uppercase text-zinc-400 mb-1.5">
                        Nomor Induk Mahasiswa (NIM) *
                    </label>
                    <input type="text" id="nim" name="nim" value="{{ old('nim', $member->nim) }}" required
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                    @error('nim')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- Peran / Posisi -->
                <div>
                    <label for="role" class="block uppercase text-zinc-400 mb-1.5">
                        Peran dalam Kelompok *
                    </label>
                    <input type="text" id="role" name="role" value="{{ old('role', $member->role) }}" required
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                    @error('role')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Mahasiswa -->
                <div>
                    <label for="email" class="block uppercase text-zinc-400 mb-1.5">
                        Email Mahasiswa
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                    @error('email')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor HP / WhatsApp -->
                <div>
                    <label for="phone" class="block uppercase text-zinc-400 mb-1.5">
                        No. Telepon / WhatsApp
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                </div>

                <!-- Urutan Tampilan -->
                <div>
                    <label for="order" class="block uppercase text-zinc-400 mb-1.5">
                        Urutan Tampilan (1 - 4)
                    </label>
                    <input type="number" id="order" name="order" value="{{ old('order', $member->order) }}" min="1" max="10"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                </div>
            </div>

            <!-- Keahlian / Skills -->
            <div>
                <label for="skills" class="block uppercase text-zinc-400 mb-1.5">
                    Keahlian / Tech Stack (Pisahkan koma)
                </label>
                <input type="text" id="skills" name="skills" value="{{ old('skills', is_array($member->skills) ? implode(', ', $member->skills) : $member->skills) }}"
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
            </div>

            <!-- Bio -->
            <div>
                <label for="bio" class="block uppercase text-zinc-400 mb-1.5">
                    Bio Singkat & Kontribusi
                </label>
                <textarea id="bio" name="bio" rows="3"
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">{{ old('bio', $member->bio) }}</textarea>
            </div>

            <!-- Upload Foto Profil -->
            <div>
                <label class="block uppercase text-zinc-400 mb-1.5">
                    Ganti Foto Profil (Opsional)
                </label>
                <div class="flex items-center gap-4">
                    <img id="current-photo" src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-12 h-12 object-cover border border-zinc-700 shrink-0 grayscale">
                    <div class="flex-1">
                        <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)"
                            class="block w-full text-xs text-zinc-400 file:mr-4 file:py-2 file:px-3 file:border-0 file:text-xs file:font-bold file:bg-white file:text-black hover:file:bg-zinc-200 cursor-pointer">
                    </div>
                </div>
                <p class="text-[11px] text-zinc-500 mt-1">Kosongkan jika tidak ingin mengubah foto saat ini.</p>
                @error('photo')
                    <p class="text-rose-400 mt-1">! {{ $message }}</p>
                @enderror
            </div>

            <!-- Media Sosial / Tautan -->
            <div class="pt-4 border-t border-zinc-800">
                <span class="block text-zinc-500 uppercase mb-3">// TAUTAN PORTOFOLIO / SOSIAL (OPSIONAL)</span>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="github_url" class="block text-zinc-400 mb-1">GitHub URL</label>
                        <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $member->github_url) }}"
                            class="w-full px-3 py-2 bg-black border border-zinc-800 text-white text-xs focus:border-white"
                            placeholder="https://github.com/username">
                    </div>
                    <div>
                        <label for="linkedin_url" class="block text-zinc-400 mb-1">LinkedIn URL</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}"
                            class="w-full px-3 py-2 bg-black border border-zinc-800 text-white text-xs focus:border-white"
                            placeholder="https://linkedin.com/in/username">
                    </div>
                    <div>
                        <label for="instagram_url" class="block text-zinc-400 mb-1">Instagram URL</label>
                        <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $member->instagram_url) }}"
                            class="w-full px-3 py-2 bg-black border border-zinc-800 text-white text-xs focus:border-white"
                            placeholder="https://instagram.com/username">
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-zinc-800">
                <a href="{{ route('dashboard.members.index') }}" class="px-4 py-2 text-zinc-400 hover:text-white border border-zinc-800 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 bg-white text-black font-bold uppercase hover:bg-zinc-200 transition">
                    Perbarui Data Anggota →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('current-photo');
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

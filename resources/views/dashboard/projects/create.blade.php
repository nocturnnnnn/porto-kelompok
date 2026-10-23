@extends('layouts.dashboard')

@section('title', 'Tambah Proyek Portofolio')
@section('page_heading', 'Tambah Proyek')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between font-mono">
        <div>
            <h2 class="text-base font-bold text-white uppercase tracking-tight">// FORMULIR PROYEK BARU</h2>
            <p class="text-xs text-zinc-500 font-sans">Input detail karya portofolio kelompok.</p>
        </div>
        <a href="{{ route('dashboard.projects.index') }}" class="px-3 py-1.5 text-xs text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="bg-zinc-950 border border-zinc-800 p-6 md:p-8">
        <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-mono text-xs">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Judul Proyek -->
                <div>
                    <label for="title" class="block uppercase text-zinc-400 mb-1.5">
                        Judul Proyek / Aplikasi *
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                        placeholder="Contoh: Sistem Manajemen Keuangan UMKM">
                    @error('title')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori Proyek -->
                <div>
                    <label for="category" class="block uppercase text-zinc-400 mb-1.5">
                        Kategori Proyek *
                    </label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}" required list="category-suggestions"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                        placeholder="Pilih atau ketik kategori...">
                    <datalist id="category-suggestions">
                        <option value="Web Application">
                        <option value="RESTful API">
                        <option value="UI/UX Design">
                        <option value="E-Commerce">
                        <option value="Mobile App">
                    </datalist>
                    @error('category')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- Kontributor Anggota Kelompok -->
                <div>
                    <label for="member_id" class="block uppercase text-zinc-400 mb-1.5">
                        Kontributor Utama (Anggota Tim)
                    </label>
                    <select id="member_id" name="member_id"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                        <option value="">[ Kolaborasi Bersama Seluruh Tim ]</option>
                        @foreach($members as $m)
                            <option value="{{ $m->id }}" {{ old('member_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->name }} (NIM: {{ $m->nim }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tech Stack -->
                <div>
                    <label for="tech_stack" class="block uppercase text-zinc-400 mb-1.5">
                        Tech Stack (Pisahkan koma)
                    </label>
                    <input type="text" id="tech_stack" name="tech_stack" value="{{ old('tech_stack') }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                        placeholder="Laravel 13, MySQL, Tailwind CSS, Blade">
                </div>
            </div>

            <!-- Ringkasan Singkat (Excerpt) -->
            <div>
                <label for="excerpt" class="block uppercase text-zinc-400 mb-1.5">
                    Ringkasan Singkat (Kartu Preview)
                </label>
                <input type="text" id="excerpt" name="excerpt" value="{{ old('excerpt') }}" maxlength="255"
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                    placeholder="Deskripsi singkat fungsi proyek...">
            </div>

            <!-- Deskripsi Lengkap -->
            <div>
                <label for="description" class="block uppercase text-zinc-400 mb-1.5">
                    Deskripsi Lengkap & Fitur Proyek
                </label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                    placeholder="Jelaskan latar belakang, fitur, arsitektur, dan cara kerja proyek...">{{ old('description') }}</textarea>
            </div>

            <!-- Upload Thumbnail -->
            <div>
                <label class="block uppercase text-zinc-400 mb-1.5">
                    Thumbnail / Tangkapan Layar (Opsional)
                </label>
                <div class="flex items-center gap-4">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)"
                        class="block w-full text-xs text-zinc-400 file:mr-4 file:py-2 file:px-3 file:border-0 file:text-xs file:font-bold file:bg-white file:text-black hover:file:bg-zinc-200 cursor-pointer">
                    <div id="preview-wrapper" class="hidden shrink-0">
                        <img id="image-preview" src="" alt="Preview" class="w-16 h-12 object-cover border border-zinc-700">
                    </div>
                </div>
                @error('image')
                    <p class="text-rose-400 mt-1">! {{ $message }}</p>
                @enderror
            </div>

            <!-- Tautan Demo & GitHub -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 border-t border-zinc-800">
                <div>
                    <label for="demo_url" class="block uppercase text-zinc-400 mb-1.5">
                        Tautan Demo Live (Opsional)
                    </label>
                    <input type="url" id="demo_url" name="demo_url" value="{{ old('demo_url') }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:border-white"
                        placeholder="https://contoh-demo.test">
                </div>

                <div>
                    <label for="github_url" class="block uppercase text-zinc-400 mb-1.5">
                        Tautan GitHub Repo (Opsional)
                    </label>
                    <input type="url" id="github_url" name="github_url" value="{{ old('github_url') }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:border-white"
                        placeholder="https://github.com/kelompok/repo">
                </div>
            </div>

            <!-- Featured Checkbox -->
            <div class="p-4 bg-black border border-zinc-800 flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-white uppercase">// PROYEK UTAMA (FEATURED)</h4>
                    <p class="text-zinc-500 text-[11px] font-sans mt-0.5">Tampilkan proyek ini dengan label prioritas.</p>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="w-4 h-4 rounded-none bg-black border-zinc-700 text-white focus:ring-0">
                    <span class="text-xs uppercase text-zinc-400">Aktif</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-zinc-800">
                <a href="{{ route('dashboard.projects.index') }}" class="px-4 py-2 text-zinc-400 hover:text-white border border-zinc-800 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 bg-white text-black font-bold uppercase hover:bg-zinc-200 transition">
                    Simpan Proyek Portofolio →
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
                const preview = document.getElementById('image-preview');
                const wrapper = document.getElementById('preview-wrapper');
                preview.src = e.target.result;
                wrapper.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

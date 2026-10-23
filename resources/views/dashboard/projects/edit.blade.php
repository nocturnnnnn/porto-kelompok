@extends('layouts.dashboard')

@section('title', 'Edit Proyek - ' . $project->title)
@section('page_heading', 'Edit Portofolio Proyek')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between font-mono">
        <div>
            <h2 class="text-base font-bold text-white uppercase tracking-tight">// EDIT: {{ $project->title }}</h2>
            <p class="text-xs text-zinc-500 font-sans">Kategori: {{ $project->category }} &bull; Perbarui konten portofolio karya.</p>
        </div>
        <a href="{{ route('dashboard.projects.index') }}" class="px-3 py-1.5 text-xs text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="bg-zinc-950 border border-zinc-800 p-6 md:p-8">
        <form action="{{ route('dashboard.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-mono text-xs">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Judul Proyek -->
                <div>
                    <label for="title" class="block uppercase text-zinc-400 mb-1.5">
                        Judul Proyek / Aplikasi *
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                    @error('title')
                        <p class="text-rose-400 mt-1">! {{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori Proyek -->
                <div>
                    <label for="category" class="block uppercase text-zinc-400 mb-1.5">
                        Kategori Proyek *
                    </label>
                    <input type="text" id="category" name="category" value="{{ old('category', $project->category) }}" required list="category-suggestions"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
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
                            <option value="{{ $m->id }}" {{ old('member_id', $project->member_id) == $m->id ? 'selected' : '' }}>
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
                    <input type="text" id="tech_stack" name="tech_stack" value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack) }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
                </div>
            </div>

            <!-- Ringkasan Singkat (Excerpt) -->
            <div>
                <label for="excerpt" class="block uppercase text-zinc-400 mb-1.5">
                    Ringkasan Singkat (Kartu Preview)
                </label>
                <input type="text" id="excerpt" name="excerpt" value="{{ old('excerpt', $project->excerpt) }}" maxlength="255"
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">
            </div>

            <!-- Deskripsi Lengkap -->
            <div>
                <label for="description" class="block uppercase text-zinc-400 mb-1.5">
                    Deskripsi Lengkap & Fitur Proyek
                </label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Upload Thumbnail -->
            <div>
                <label class="block uppercase text-zinc-400 mb-1.5">
                    Ganti Thumbnail / Tangkapan Layar (Opsional)
                </label>
                <div class="flex items-center gap-4">
                    <img id="current-image" src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-16 h-12 object-cover border border-zinc-700 shrink-0 grayscale">
                    <div class="flex-1">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)"
                            class="block w-full text-xs text-zinc-400 file:mr-4 file:py-2 file:px-3 file:border-0 file:text-xs file:font-bold file:bg-white file:text-black hover:file:bg-zinc-200 cursor-pointer">
                    </div>
                </div>
                <p class="text-[11px] text-zinc-500 mt-1">Kosongkan jika tidak ingin mengubah thumbnail gambar saat ini.</p>
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
                    <input type="url" id="demo_url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:border-white">
                </div>

                <div>
                    <label for="github_url" class="block uppercase text-zinc-400 mb-1.5">
                        Tautan GitHub Repo (Opsional)
                    </label>
                    <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                        class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:border-white">
                </div>
            </div>

            <!-- Featured Checkbox -->
            <div class="p-4 bg-black border border-zinc-800 flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-white uppercase">// PROYEK UTAMA (FEATURED)</h4>
                    <p class="text-zinc-500 text-[11px] font-sans mt-0.5">Tampilkan proyek ini dengan label prioritas.</p>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
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
                    Perbarui Proyek Portofolio →
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
                const preview = document.getElementById('current-image');
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

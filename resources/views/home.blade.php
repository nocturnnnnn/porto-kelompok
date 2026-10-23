@extends('layouts.app')

@section('title', 'Portofolio Kelompok 05 - Pemrograman Web Sem 5')

@section('content')
<!-- ========================================== -->
<!-- HERO SECTION                               -->
<!-- ========================================== -->
<section id="hero" class="border-b border-zinc-800 bg-black pt-16 pb-20 md:pt-24 md:pb-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-6">
            
            <!-- Technical Tag -->
            <div class="font-mono text-xs text-zinc-500 uppercase tracking-widest flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-white"></span>
                <span>MK: PEMROGRAMAN WEB // SEMESTER 5 // KELOMPOK 05</span>
            </div>

            <!-- Stark Main Heading -->
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold text-white tracking-tight uppercase leading-[1.05]">
                Portofolio Terpadu.<br>
                <span class="text-zinc-500">Kelompok 05.</span>
            </h1>

            <!-- Direct Subtitle -->
            <p class="text-sm sm:text-base text-zinc-400 font-mono leading-relaxed max-w-2xl">
                Dokumentasi profil 4 anggota tim mahasiswa dan etalase karya proyek web berbasis Laravel 13 & MySQL.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-3 pt-3 font-mono text-xs">
                <a href="#members" class="px-5 py-3 bg-white text-black font-bold uppercase hover:bg-zinc-200 transition">
                    [ 01. TIM ANGGOTA ↓ ]
                </a>
                <a href="#projects" class="px-5 py-3 bg-black text-zinc-300 hover:text-white border border-zinc-800 hover:border-zinc-500 uppercase transition">
                    [ 02. ARSIP KARYA ↓ ]
                </a>
            </div>
        </div>

        <!-- System Stats Strip -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-16 pt-8 border-t border-zinc-900 font-mono">
            <div class="border-l border-zinc-800 pl-4">
                <span class="block text-2xl font-bold text-white">{{ str_pad($stats['total_members'], 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-xs text-zinc-500 uppercase">Anggota Tim</span>
            </div>
            <div class="border-l border-zinc-800 pl-4">
                <span class="block text-2xl font-bold text-white">{{ str_pad($stats['total_projects'], 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-xs text-zinc-500 uppercase">Karya Proyek</span>
            </div>
            <div class="border-l border-zinc-800 pl-4">
                <span class="block text-2xl font-bold text-white">PHP 8.5</span>
                <span class="text-xs text-zinc-500 uppercase">Laravel 13</span>
            </div>
            <div class="border-l border-zinc-800 pl-4">
                <span class="block text-2xl font-bold text-white">MYSQL</span>
                <span class="text-xs text-zinc-500 uppercase">Database</span>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 01. MEMBERS SECTION                        -->
<!-- ========================================== -->
<section id="members" class="border-b border-zinc-800 bg-zinc-950 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
            <div>
                <span class="font-mono text-xs text-zinc-500 uppercase tracking-widest block mb-2">// 01. TIM_MAHASISWA</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight uppercase">
                    Profil 4 Anggota Kelompok
                </h2>
            </div>
            <p class="font-mono text-xs text-zinc-400 max-w-md">
                Struktur tim mahasiswa dengan pembagian peran terkoordinasi untuk pengembangan sistem web.
            </p>
        </div>

        <!-- 4 Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($members as $index => $member)
                <div class="border border-zinc-800 bg-black p-5 flex flex-col justify-between hover:border-zinc-500 transition group">
                    <div>
                        <!-- Header with Index and NIM -->
                        <div class="flex items-center justify-between font-mono text-[11px] text-zinc-500 border-b border-zinc-900 pb-3 mb-4">
                            <span>[{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}/04]</span>
                            <span class="text-zinc-400">{{ $member->nim }}</span>
                        </div>

                        <!-- Photo Frame -->
                        <div class="w-full aspect-square bg-zinc-900 border border-zinc-800 overflow-hidden mb-4">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover grayscale contrast-125 group-hover:grayscale-0 transition duration-300">
                        </div>

                        <!-- Name & Role -->
                        <h3 class="font-bold text-white text-base leading-tight">
                            {{ $member->name }}
                        </h3>
                        <p class="font-mono text-xs text-zinc-400 mt-1">
                            {{ $member->role }}
                        </p>

                        <!-- Short Bio -->
                        <p class="text-xs text-zinc-400 mt-3 line-clamp-2 leading-relaxed">
                            {{ $member->bio ?: 'Mahasiswa aktif semester 5 berkontribusi pada pengembangan sistem kelompok.' }}
                        </p>

                        <!-- Skills Tags -->
                        <div class="flex flex-wrap gap-1.5 mt-4">
                            @foreach(array_slice($member->skills_array, 0, 3) as $skill)
                                <span class="font-mono text-[10px] px-2 py-0.5 border border-zinc-800 bg-zinc-900 text-zinc-300 uppercase">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-5 mt-5 border-t border-zinc-900 flex items-center justify-between font-mono text-xs">
                        <span class="text-zinc-600 text-[10px]">{{ $member->projects->count() }} PROYEK</span>
                        <button type="button" onclick="openMemberModal({{ $member->id }})" class="text-zinc-300 hover:text-white transition flex items-center gap-1">
                            <span>[DETAIL]</span>
                            <span>→</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-4 p-12 text-center border border-zinc-800 font-mono text-xs text-zinc-500">
                    [ BELUM ADA DATA ANGGOTA TERDAFTAR ]
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 02. PROJECTS SECTION                       -->
<!-- ========================================== -->
<section id="projects" class="border-b border-zinc-800 bg-black py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <span class="font-mono text-xs text-zinc-500 uppercase tracking-widest block mb-2">// 02. ARSIP_KARYA</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight uppercase">
                    Portofolio & Proyek Web
                </h2>
            </div>
            <p class="font-mono text-xs text-zinc-400 max-w-md">
                Karya web yang dihasilkan dari implementasi materi perkuliahan Pemrograman Web.
            </p>
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap items-center gap-2 mb-10 font-mono text-xs border-b border-zinc-800 pb-4">
            <button type="button" onclick="filterProjects(this, 'all')" class="filter-btn px-3 py-1.5 bg-white text-black font-bold uppercase transition">
                [ SEMUA ]
            </button>
            @foreach($categories as $category)
                <button type="button" onclick="filterProjects(this, '{{ $category }}')" class="filter-btn px-3 py-1.5 bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800 uppercase transition">
                    [ {{ $category }} ]
                </button>
            @endforeach
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-container">
            @forelse($projects as $project)
                <article class="project-card border border-zinc-800 bg-zinc-950 flex flex-col justify-between hover:border-zinc-500 transition group" data-category="{{ $project->category }}">
                    <div>
                        <!-- Thumbnail -->
                        <div class="w-full h-48 bg-zinc-900 border-b border-zinc-800 overflow-hidden relative">
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover grayscale contrast-125 group-hover:grayscale-0 transition duration-300">
                            @if($project->is_featured)
                                <span class="absolute top-3 left-3 px-2 py-0.5 bg-white text-black font-mono text-[10px] font-bold uppercase tracking-wider">
                                    UTAMA
                                </span>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-5">
                            <div class="font-mono text-[11px] text-zinc-500 uppercase mb-1">
                                [{{ $project->category }}]
                            </div>
                            <h3 class="font-bold text-white text-lg tracking-tight leading-snug">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-zinc-400 mt-2 line-clamp-2 leading-relaxed">
                                {{ $project->excerpt }}
                            </p>

                            <!-- Tech Stack -->
                            <div class="flex flex-wrap gap-1.5 mt-4">
                                @foreach($project->tech_stack_array as $tech)
                                    <span class="font-mono text-[10px] px-2 py-0.5 border border-zinc-800 bg-black text-zinc-400">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-5 pt-0 border-t border-zinc-900/60 mt-4 flex items-center justify-between font-mono text-xs">
                        <div class="text-[11px] text-zinc-500 truncate max-w-37.5">
                            @if($project->member)
                                {{ $project->member->name }}
                            @else
                                Seluruh Tim
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="text-zinc-400 hover:text-white">
                                    [REPO]
                                </a>
                            @endif
                            <button type="button" onclick="openProjectModal({{ $project->id }})" class="text-white hover:underline">
                                [DETAIL →]
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 p-12 text-center border border-zinc-800 font-mono text-xs text-zinc-500">
                    [ BELUM ADA PROYEK DITAMPILKAN ]
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 03. SYSTEM SPECS                           -->
<!-- ========================================== -->
<section id="about" class="border-b border-zinc-800 bg-zinc-950 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="mb-12">
            <span class="font-mono text-xs text-zinc-500 uppercase tracking-widest block mb-2">// 03. SPESIFIKASI_TUGAS</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight uppercase">
                Standar Teknis & Kesiapan Ujian
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 font-mono">
            <div class="border border-zinc-800 bg-black p-6 space-y-3">
                <span class="text-xs text-zinc-500">[01]</span>
                <h3 class="text-sm font-bold text-white uppercase">Batasan 4 Anggota</h3>
                <p class="text-xs text-zinc-400 leading-relaxed font-sans">
                    Sesuai instruksi tugas, kelompok terdiri dari maksimal 4 mahasiswa yang terdaftar dengan NIM resmi.
                </p>
            </div>

            <div class="border border-zinc-800 bg-black p-6 space-y-3">
                <span class="text-xs text-zinc-500">[02]</span>
                <h3 class="text-sm font-bold text-white uppercase">Laravel 13 & MySQL</h3>
                <p class="text-xs text-zinc-400 leading-relaxed font-sans">
                    Arsitektur MVC berbasis framework Laravel 13, database relasional MySQL, dan manajemen aset Vite modern.
                </p>
            </div>

            <div class="border border-zinc-800 bg-black p-6 space-y-3">
                <span class="text-xs text-zinc-500">[03]</span>
                <h3 class="text-sm font-bold text-white uppercase">Operasi CRUD Mandiri</h3>
                <p class="text-xs text-zinc-400 leading-relaxed font-sans">
                    Fungsi Create, Read, Update, dan Delete untuk anggota dan karya proyek dengan validasi data formulir.
                </p>
            </div>

            <div class="border border-zinc-800 bg-black p-6 space-y-3">
                <span class="text-xs text-zinc-500">[04]</span>
                <h3 class="text-sm font-bold text-white uppercase">Kesiapan Presentasi</h3>
                <p class="text-xs text-zinc-400 leading-relaxed font-sans">
                    Seluruh anggota memahami struktur kode dan siap mempresentasikan bagian teknis saat ditunjuk dosen.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 04. CONTACT SECTION                        -->
<!-- ========================================== -->
<section id="contact" class="bg-black py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Info -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="font-mono text-xs text-zinc-500 uppercase tracking-widest block mb-2">// 04. KONTAK</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight uppercase">
                        Hubungi Kelompok 05
                    </h2>
                </div>
                <p class="text-xs text-zinc-400 leading-relaxed font-mono">
                    Formulir komunikasi langsung untuk keperluan diskusi akademik, evaluasi dosen, atau saran proyek web.
                </p>

                <div class="border border-zinc-800 bg-zinc-950 p-6 space-y-4 font-mono text-xs">
                    <div>
                        <span class="text-zinc-500 block text-[11px] uppercase">Mata Kuliah:</span>
                        <span class="text-white font-semibold">Pemrograman Web (Semester 5)</span>
                    </div>
                    <div class="border-t border-zinc-900 pt-3">
                        <span class="text-zinc-500 block text-[11px] uppercase">Kapasitas:</span>
                        <span class="text-white font-semibold">4 Anggota Mahasiswa</span>
                    </div>
                    <div class="border-t border-zinc-900 pt-3">
                        <span class="text-zinc-500 block text-[11px] uppercase">Email Tim:</span>
                        <span class="text-white font-semibold">kelompok5@student.univ.ac.id</span>
                    </div>
                </div>
            </div>

            <!-- Right Form -->
            <div class="lg:col-span-7">
                <div class="border border-zinc-800 bg-zinc-950 p-6 md:p-8">
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="contact_name" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                                    Nama Pengirim *
                                </label>
                                <input type="text" id="contact_name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                                    placeholder="Nama Lengkap">
                                @error('name')
                                    <p class="font-mono text-[11px] text-rose-400 mt-1">! {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact_email" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                                    Alamat Email *
                                </label>
                                <input type="email" id="contact_email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                                    placeholder="nama@email.com">
                                @error('email')
                                    <p class="font-mono text-[11px] text-rose-400 mt-1">! {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="contact_subject" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                                Subjek Pesan
                            </label>
                            <input type="text" id="contact_subject" name="subject" value="{{ old('subject') }}"
                                class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                                placeholder="Subjek / Topik pesan">
                            @error('subject')
                                <p class="font-mono text-[11px] text-rose-400 mt-1">! {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_message" class="block font-mono text-xs uppercase text-zinc-400 mb-1.5">
                                Isi Pesan *
                            </label>
                            <textarea id="contact_message" name="message" rows="4" required
                                class="w-full px-3.5 py-2.5 bg-black border border-zinc-800 text-white font-mono text-xs focus:outline-none focus:border-white transition"
                                placeholder="Tuliskan masukan atau pesan Anda di sini...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="font-mono text-[11px] text-rose-400 mt-1">! {{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-3 bg-white hover:bg-zinc-200 text-black font-mono font-bold text-xs uppercase tracking-wider transition">
                            Kirim Pesan →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- DATA STORES FOR MODALS (JSON SAFE)         -->
<!-- ========================================== -->
<script type="application/json" id="data-members">@json($members)</script>
<script type="application/json" id="data-projects">@json($projects)</script>

<!-- ========================================== -->
<!-- MODALS                                     -->
<!-- ========================================== -->

<!-- 1. Member Detail Modal -->
<div id="memberModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="relative w-full max-w-lg bg-zinc-950 border border-zinc-800 p-6 md:p-8">
        <!-- Close Button -->
        <button type="button" onclick="closeMemberModal()" class="absolute top-4 right-4 font-mono text-xs text-zinc-500 hover:text-white">
            [× TUTUP]
        </button>

        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-zinc-900">
            <img id="m-modal-photo" src="" alt="" class="w-16 h-16 object-cover border border-zinc-800 shrink-0">
            <div>
                <h3 id="m-modal-name" class="text-lg font-bold text-white uppercase"></h3>
                <div class="font-mono text-xs text-zinc-400 mt-1 flex items-center gap-2">
                    <span id="m-modal-nim"></span>
                    <span>&bull;</span>
                    <span id="m-modal-role"></span>
                </div>
            </div>
        </div>

        <div class="space-y-4 font-mono text-xs">
            <div>
                <span class="text-zinc-500 uppercase tracking-wider block mb-1.5">// BIO & PROFIL</span>
                <p id="m-modal-bio" class="text-zinc-300 font-sans leading-relaxed bg-black p-3.5 border border-zinc-900"></p>
            </div>

            <div>
                <span class="text-zinc-500 uppercase tracking-wider block mb-1.5">// KEAHLIAN & STACK</span>
                <div id="m-modal-skills" class="flex flex-wrap gap-1.5"></div>
            </div>

            <div id="m-modal-contact-box" class="p-3 bg-black border border-zinc-900 space-y-1.5 text-[11px]">
                <div id="m-modal-email-row" class="text-zinc-400">
                    <span class="text-zinc-600">EMAIL:</span> <span id="m-modal-email" class="text-zinc-200"></span>
                </div>
                <div id="m-modal-phone-row" class="text-zinc-400">
                    <span class="text-zinc-600">TELP/WA:</span> <span id="m-modal-phone" class="text-zinc-200"></span>
                </div>
            </div>

            <div id="m-modal-links" class="flex flex-wrap gap-2 pt-2">
                <a id="m-modal-github" href="#" target="_blank" class="px-2.5 py-1 bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-800 transition">
                    [GITHUB]
                </a>
                <a id="m-modal-linkedin" href="#" target="_blank" class="px-2.5 py-1 bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-800 transition">
                    [LINKEDIN]
                </a>
                <a id="m-modal-instagram" href="#" target="_blank" class="px-2.5 py-1 bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-800 transition">
                    [INSTAGRAM]
                </a>
            </div>

            <div class="pt-4 border-t border-zinc-900 flex items-center justify-between text-zinc-500">
                <span>KELOMPOK 05 &bull; SEM 5</span>
                <button type="button" onclick="closeMemberModal()" class="px-3 py-1 bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-800">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 2. Project Detail Modal -->
<div id="projectModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="relative w-full max-w-2xl bg-zinc-950 border border-zinc-800 p-6 md:p-8">
        <!-- Close Button -->
        <button type="button" onclick="closeProjectModal()" class="absolute top-4 right-4 font-mono text-xs text-zinc-500 hover:text-white">
            [× TUTUP]
        </button>

        <div class="mb-4">
            <span id="p-modal-category" class="font-mono text-xs text-zinc-400 uppercase"></span>
            <h3 id="p-modal-title" class="text-xl font-bold text-white uppercase tracking-tight mt-1"></h3>
            <div id="p-modal-author" class="font-mono text-[11px] text-zinc-500 mt-1"></div>
        </div>

        <div class="mb-5 bg-black border border-zinc-900 overflow-hidden max-h-60">
            <img id="p-modal-image" src="" alt="" class="w-full h-full object-cover">
        </div>

        <div class="space-y-4 font-mono text-xs">
            <div>
                <span class="text-zinc-500 uppercase tracking-wider block mb-1.5">// DESKRIPSI KARYA</span>
                <div id="p-modal-desc" class="text-zinc-300 font-sans leading-relaxed whitespace-pre-line bg-black p-3.5 border border-zinc-900 max-h-48 overflow-y-auto"></div>
            </div>

            <div>
                <span class="text-zinc-500 uppercase tracking-wider block mb-1.5">// TECH STACK</span>
                <div id="p-modal-tech" class="flex flex-wrap gap-1.5"></div>
            </div>

            <div class="pt-4 border-t border-zinc-900 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <a id="p-modal-github" href="#" target="_blank" class="px-3 py-1.5 bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-800 transition">
                        [GITHUB REPO]
                    </a>
                    <a id="p-modal-demo" href="#" target="_blank" class="px-3 py-1.5 bg-white text-black font-bold hover:bg-zinc-200 transition">
                        [DEMO LIVE]
                    </a>
                </div>
                <button type="button" onclick="closeProjectModal()" class="px-3 py-1.5 bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Cached JSON Data
    const membersData = JSON.parse(document.getElementById('data-members').textContent || '[]');
    const projectsData = JSON.parse(document.getElementById('data-projects').textContent || '[]');

    // Project Category Filtering
    function filterProjects(btn, cat) {
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(b => {
            b.classList.remove('bg-white', 'text-black', 'font-bold');
            b.classList.add('bg-zinc-900', 'text-zinc-400');
        });
        if (btn) {
            btn.classList.add('bg-white', 'text-black', 'font-bold');
            btn.classList.remove('bg-zinc-900', 'text-zinc-400');
        }

        const cards = document.querySelectorAll('.project-card');
        cards.forEach(card => {
            if (cat === 'all' || card.getAttribute('data-category') === cat) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Member Modal
    function openMemberModal(id) {
        const member = membersData.find(m => m.id === id);
        if (!member) return;

        document.getElementById('m-modal-name').textContent = member.name;
        document.getElementById('m-modal-nim').textContent = 'NIM: ' + member.nim;
        document.getElementById('m-modal-role').textContent = member.role;
        document.getElementById('m-modal-bio').textContent = member.bio || 'Tidak ada deskripsi bio tambahan.';
        document.getElementById('m-modal-photo').src = member.photo_url || '';

        const skillsContainer = document.getElementById('m-modal-skills');
        skillsContainer.innerHTML = '';
        if (member.skills_array && member.skills_array.length > 0) {
            member.skills_array.forEach(skill => {
                const span = document.createElement('span');
                span.className = 'font-mono text-[10px] px-2 py-0.5 border border-zinc-800 bg-black text-zinc-300 uppercase';
                span.textContent = skill;
                skillsContainer.appendChild(span);
            });
        } else {
            skillsContainer.innerHTML = '<span class="text-zinc-600 text-xs font-mono">-</span>';
        }

        // Contact details
        const emailEl = document.getElementById('m-modal-email');
        const emailRow = document.getElementById('m-modal-email-row');
        if (member.email) {
            emailEl.textContent = member.email;
            emailRow.style.display = 'block';
        } else {
            emailRow.style.display = 'none';
        }

        const phoneEl = document.getElementById('m-modal-phone');
        const phoneRow = document.getElementById('m-modal-phone-row');
        if (member.phone) {
            phoneEl.textContent = member.phone;
            phoneRow.style.display = 'block';
        } else {
            phoneRow.style.display = 'none';
        }

        // Social Links
        const gh = document.getElementById('m-modal-github');
        if (member.github_url) {
            gh.href = member.github_url;
            gh.style.display = 'inline-block';
        } else {
            gh.style.display = 'none';
        }

        const li = document.getElementById('m-modal-linkedin');
        if (member.linkedin_url) {
            li.href = member.linkedin_url;
            li.style.display = 'inline-block';
        } else {
            li.style.display = 'none';
        }

        const ig = document.getElementById('m-modal-instagram');
        if (member.instagram_url) {
            ig.href = member.instagram_url;
            ig.style.display = 'inline-block';
        } else {
            ig.style.display = 'none';
        }

        const mModal = document.getElementById('memberModal');
        mModal.classList.remove('hidden');
        mModal.classList.add('flex');
    }

    function closeMemberModal() {
        const mModal = document.getElementById('memberModal');
        mModal.classList.add('hidden');
        mModal.classList.remove('flex');
    }

    // Project Modal
    function openProjectModal(id) {
        const project = projectsData.find(p => p.id === id);
        if (!project) return;

        document.getElementById('p-modal-title').textContent = project.title;
        document.getElementById('p-modal-category').textContent = '[' + project.category + ']';
        document.getElementById('p-modal-image').src = project.image_url || '';
        document.getElementById('p-modal-desc').textContent = project.description || project.excerpt || 'Tidak ada deskripsi detail.';

        const authorEl = document.getElementById('p-modal-author');
        if (project.member) {
            authorEl.textContent = '// KONTRIBUTOR: ' + project.member.name + ' (' + (project.member.nim || '') + ')';
        } else {
            authorEl.textContent = '// KONTRIBUTOR: SELURUH TIM MAHASISWA';
        }

        const techContainer = document.getElementById('p-modal-tech');
        techContainer.innerHTML = '';
        if (project.tech_stack_array && project.tech_stack_array.length > 0) {
            project.tech_stack_array.forEach(t => {
                const span = document.createElement('span');
                span.className = 'font-mono text-[10px] px-2 py-0.5 border border-zinc-800 bg-black text-zinc-300 uppercase';
                span.textContent = t;
                techContainer.appendChild(span);
            });
        } else {
            techContainer.innerHTML = '<span class="text-zinc-600 text-xs font-mono">-</span>';
        }

        const gh = document.getElementById('p-modal-github');
        if (project.github_url) {
            gh.href = project.github_url;
            gh.style.display = 'inline-block';
        } else {
            gh.style.display = 'none';
        }

        const demo = document.getElementById('p-modal-demo');
        if (project.demo_url) {
            demo.href = project.demo_url;
            demo.style.display = 'inline-block';
        } else {
            demo.style.display = 'none';
        }

        const pModal = document.getElementById('projectModal');
        pModal.classList.remove('hidden');
        pModal.classList.add('flex');
    }

    function closeProjectModal() {
        const pModal = document.getElementById('projectModal');
        pModal.classList.add('hidden');
        pModal.classList.remove('flex');
    }

    // Close modals on clicking outside or ESC key
    window.onclick = function(event) {
        const mModal = document.getElementById('memberModal');
        const pModal = document.getElementById('projectModal');
        if (event.target === mModal) closeMemberModal();
        if (event.target === pModal) closeProjectModal();
    }
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeMemberModal();
            closeProjectModal();
        }
    });
</script>
@endpush

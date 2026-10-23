@extends('layouts.dashboard')

@section('title', 'Kelola Portofolio Proyek')
@section('page_heading', 'Portofolio Karya Proyek')

@section('content')
<div class="space-y-6">
    <!-- Header with Search, Filter & Create Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 font-mono">
        <form method="GET" action="{{ route('dashboard.projects.index') }}" class="flex flex-wrap items-center gap-3 max-w-xl w-full">
            <div class="relative flex-1 min-w-50">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul, tech stack, pembuat..."
                    class="w-full pl-8 pr-4 py-2 bg-black border border-zinc-800 text-white text-xs placeholder-zinc-500 focus:outline-none focus:border-white transition">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-500 text-xs">
                    >
                </div>
            </div>

            <select name="category" onchange="this.form.submit()" class="px-3 py-2 bg-black border border-zinc-800 text-xs text-zinc-300 focus:outline-none focus:border-white">
                <option value="">[ SEMUA KATEGORI ]</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            @if($search || $category)
                <a href="{{ route('dashboard.projects.index') }}" class="px-2.5 py-2 text-xs text-zinc-500 hover:text-white border border-zinc-800">
                    [RESET]
                </a>
            @endif
        </form>

        <a href="{{ route('dashboard.projects.create') }}" class="px-4 py-2 bg-white text-black font-bold text-xs uppercase hover:bg-zinc-200 transition self-start md:self-auto">
            + Tambah Proyek Baru
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-zinc-950 border border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-zinc-800 bg-black text-[10px] font-mono uppercase tracking-wider text-zinc-500">
                        <th class="py-3 px-5">Karya / Thumbnail</th>
                        <th class="py-3 px-5">Kategori</th>
                        <th class="py-3 px-5">Kontributor</th>
                        <th class="py-3 px-5">Tech Stack</th>
                        <th class="py-3 px-5">Status</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900 text-xs font-mono">
                    @forelse($projects as $project)
                        <tr class="hover:bg-zinc-900/50 transition">
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-12 h-9 object-cover border border-zinc-800 shrink-0 grayscale">
                                    <div>
                                        <p class="font-bold text-white font-sans text-sm">{{ $project->title }}</p>
                                        <p class="text-[11px] text-zinc-500 line-clamp-1 mt-0.5 max-w-sm">{{ $project->excerpt }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-5">
                                <span class="px-2 py-0.5 bg-black text-zinc-300 border border-zinc-800 text-[10px] uppercase">
                                    {{ $project->category }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-zinc-400">
                                @if($project->member)
                                    <span>{{ $project->member->name }}</span>
                                @else
                                    <span class="text-zinc-600">Seluruh Tim</span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex flex-wrap gap-1 max-w-xs">
                                    @foreach(array_slice($project->tech_stack_array, 0, 3) as $tech)
                                        <span class="px-1.5 py-0.5 bg-black text-zinc-400 text-[10px] border border-zinc-800 uppercase">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($project->tech_stack_array) > 3)
                                        <span class="px-1 py-0.5 bg-black text-zinc-500 text-[10px]">+{{ count($project->tech_stack_array) - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-5">
                                @if($project->is_featured)
                                    <span class="px-2 py-0.5 bg-white text-black text-[10px] font-bold uppercase">
                                        UTAMA
                                    </span>
                                @else
                                    <span class="text-zinc-600">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('dashboard.projects.edit', $project) }}" class="px-2 py-1 text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition" title="Edit">
                                        EDIT
                                    </a>
                                    <form action="{{ route('dashboard.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portofolio {{ $project->title }}?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-zinc-500 hover:text-rose-400 border border-zinc-800 hover:border-rose-900 transition" title="Hapus">
                                            HAPUS
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-zinc-600 font-mono">
                                [ TIDAK ADA PROYEK DITEMUKAN ]
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
            <div class="p-4 border-t border-zinc-800 font-mono text-xs">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

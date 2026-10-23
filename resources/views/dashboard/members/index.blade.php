@extends('layouts.dashboard')

@section('title', 'Kelola Anggota Kelompok')
@section('page_heading', 'Daftar Anggota Kelompok (Maks. 4 Orang)')

@section('content')
<div class="space-y-6">
    <!-- Header with Search and Create Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 font-mono">
        <form method="GET" action="{{ route('dashboard.members.index') }}" class="relative max-w-md w-full">
            <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama, NIM, peran, atau skill..."
                class="w-full pl-9 pr-4 py-2 bg-black border border-zinc-800 text-white text-xs placeholder-zinc-500 focus:outline-none focus:border-white transition">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-500 text-xs">
                >
            </div>
            @if($search)
                <a href="{{ route('dashboard.members.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[11px] text-zinc-500 hover:text-white">
                    [RESET]
                </a>
            @endif
        </form>

        <a href="{{ route('dashboard.members.create') }}" class="px-4 py-2 bg-white text-black font-bold text-xs uppercase hover:bg-zinc-200 transition self-start sm:self-auto">
            + Tambah Anggota
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-zinc-950 border border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-zinc-800 bg-black text-[10px] font-mono uppercase tracking-wider text-zinc-500">
                        <th class="py-3 px-5"># Urut</th>
                        <th class="py-3 px-5">Profil Anggota</th>
                        <th class="py-3 px-5">NIM</th>
                        <th class="py-3 px-5">Peran</th>
                        <th class="py-3 px-5">Keahlian</th>
                        <th class="py-3 px-5">Proyek</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900 text-xs font-mono">
                    @forelse($members as $index => $member)
                        <tr class="hover:bg-zinc-900/50 transition">
                            <td class="py-4 px-5 text-zinc-500">
                                #{{ $member->order ?: $index + 1 }}
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-10 h-10 object-cover border border-zinc-800 shrink-0 grayscale">
                                    <div>
                                        <p class="font-bold text-white font-sans text-sm">{{ $member->name }}</p>
                                        <p class="text-[11px] text-zinc-500 mt-0.5">{{ $member->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-5 text-zinc-300 font-bold">
                                {{ $member->nim }}
                            </td>
                            <td class="py-4 px-5 text-zinc-400">
                                {{ $member->role }}
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex flex-wrap gap-1 max-w-xs">
                                    @foreach(array_slice($member->skills_array, 0, 3) as $skill)
                                        <span class="px-1.5 py-0.5 bg-black text-zinc-400 text-[10px] border border-zinc-800 uppercase">{{ $skill }}</span>
                                    @endforeach
                                    @if(count($member->skills_array) > 3)
                                        <span class="px-1 py-0.5 bg-black text-zinc-500 text-[10px]">+{{ count($member->skills_array) - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-5">
                                <span class="px-2 py-0.5 text-[10px] bg-black text-zinc-300 border border-zinc-800">
                                    {{ $member->projects_count }} karya
                                </span>
                            </td>
                            <td class="py-4 px-5 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('dashboard.members.edit', $member) }}" class="px-2 py-1 text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 transition" title="Edit">
                                        EDIT
                                    </a>
                                    <form action="{{ route('dashboard.members.destroy', $member) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota {{ $member->name }}?');" class="inline">
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
                            <td colspan="7" class="py-12 text-center text-zinc-600 font-mono">
                                [ TIDAK ADA DATA ANGGOTA DITEMUKAN ]
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
            <div class="p-4 border-t border-zinc-800 font-mono text-xs">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

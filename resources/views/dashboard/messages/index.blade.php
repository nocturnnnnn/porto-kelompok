@extends('layouts.dashboard')

@section('title', 'Pesan Masuk')
@section('page_heading', 'Kotak Masuk & Feedback')

@section('content')
<div class="space-y-6">
    <!-- Filter Bar -->
    <div class="flex items-center justify-between gap-4 font-mono text-xs">
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.messages.index') }}" class="px-3.5 py-1.5 transition {{ empty($status) ? 'bg-white text-black font-bold' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' }}">
                [ SEMUA ]
            </a>
            <a href="{{ route('dashboard.messages.index', ['status' => 'unread']) }}" class="px-3.5 py-1.5 transition {{ $status === 'unread' ? 'bg-white text-black font-bold' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' }}">
                [ BELUM DIBACA ]
            </a>
            <a href="{{ route('dashboard.messages.index', ['status' => 'read']) }}" class="px-3.5 py-1.5 transition {{ $status === 'read' ? 'bg-white text-black font-bold' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' }}">
                [ SUDAH DIBACA ]
            </a>
        </div>
    </div>

    <!-- Messages List -->
    <div class="space-y-4">
        @forelse($messages as $msg)
            <div class="p-5 bg-zinc-950 border {{ $msg->is_read ? 'border-zinc-900 opacity-70' : 'border-zinc-700' }} transition">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-zinc-900 border border-zinc-800 text-white flex items-center justify-center font-mono font-bold text-xs">
                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-white text-sm">{{ $msg->name }}</h4>
                                @if(!$msg->is_read)
                                    <span class="px-1.5 py-0.2 bg-white text-black font-mono text-[9px] font-bold uppercase">BARU</span>
                                @endif
                            </div>
                            <p class="font-mono text-xs text-zinc-500">{{ $msg->email }}</p>
                        </div>
                    </div>
                    <div class="font-mono text-[11px] text-zinc-500">
                        <span>{{ $msg->created_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                </div>

                @if($msg->subject)
                    <div class="mb-2 font-mono text-xs text-zinc-400">
                        <span class="text-zinc-500">// SUBJEK:</span> {{ $msg->subject }}
                    </div>
                @endif

                <p class="text-xs text-zinc-300 font-mono leading-relaxed bg-black p-3.5 border border-zinc-900">
                    {{ $msg->message }}
                </p>

                <div class="flex items-center justify-end gap-2 mt-4 pt-3 border-t border-zinc-900 font-mono text-xs">
                    <form action="{{ route('dashboard.messages.toggle', $msg) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-2.5 py-1 text-zinc-400 hover:text-white border border-zinc-800 transition">
                            {{ $msg->is_read ? '[TANDAI BELUM DIBACA]' : '[TANDAI SUDAH DIBACA]' }}
                        </button>
                    </form>

                    <form action="{{ route('dashboard.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2.5 py-1 text-zinc-500 hover:text-rose-400 border border-zinc-800 hover:border-rose-900 transition" title="Hapus Pesan">
                            [HAPUS]
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-zinc-950 border border-zinc-800 font-mono text-xs text-zinc-600">
                [ KOTAK PESAN KOSONG ]
            </div>
        @endforelse
    </div>

    @if($messages->hasPages())
        <div class="pt-4 font-mono text-xs">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection

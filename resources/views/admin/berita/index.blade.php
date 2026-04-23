@extends('layouts.admin')

@section('title', 'Kelola Informasi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Informasi</h2>
        <p class="text-sm text-gray-500">Kelola konten informasi website BMKG Amahai</p>
    </div>
    <a href="{{ route('admin.informasi.create') }}"
       class="inline-flex items-center gap-2 bg-bmkg-blue text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Informasi
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Informasi</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-left">Tanggal</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($beritas as $berita)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($berita->thumbnail_url)
                        <img src="{{ $berita->thumbnail_url }}" alt="" class="w-12 h-10 object-cover rounded-lg shrink-0">
                        @else
                        <div class="w-12 h-10 bg-gray-100 rounded-lg shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-800 truncate max-w-xs">{{ $berita->title }}</p>
                            <p class="text-xs text-gray-400 truncate">/informasi/{{ $berita->slug }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $berita->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $berita->is_published ? 'Dipublikasikan' : 'Draft' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $berita->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.informasi.edit', $berita) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-bmkg-blue bg-bmkg-sky rounded-lg hover:bg-blue-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <button type="button"
                                data-action="{{ route('admin.informasi.destroy', $berita) }}"
                                data-message="Hapus informasi &quot;{{ $berita->title }}&quot;?"
                                @click="$dispatch('open-delete-modal', { action: $el.dataset.action, message: $el.dataset.message })"
                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Belum ada informasi. <a href="{{ route('admin.informasi.create') }}" class="text-bmkg-blue font-medium hover:underline">Tambah informasi pertama</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($beritas->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $beritas->links() }}</div>
    @endif
</div>
@endsection

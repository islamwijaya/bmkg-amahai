@extends('layouts.admin')

@section('title', 'Kelola Buletin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Buletin</h2>
        <p class="text-sm text-gray-500">Kelola PDF buletin meteorologi BMKG Amahai</p>
    </div>
    <a href="{{ route('admin.buletin.create') }}"
       class="inline-flex items-center gap-2 bg-bmkg-blue text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Upload Buletin
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Judul / Edisi</th>
                <th class="px-6 py-4 text-left">Tahun</th>
                <th class="px-6 py-4 text-left">Bulan</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($bulletins as $bulletin)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($bulletin->cover_url)
                        <img src="{{ $bulletin->cover_url }}" alt="" class="w-10 h-14 object-cover rounded-lg shrink-0 shadow-sm">
                        @else
                        <div class="w-10 h-14 bg-red-50 rounded-lg shrink-0 flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ $bulletin->title }}</p>
                            <p class="text-xs text-gray-400">Edisi: {{ $bulletin->edition }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $bulletin->year }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $bulletin->month_name }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ $bulletin->file_url }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat PDF
                        </a>
                        <a href="{{ route('admin.buletin.edit', $bulletin) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-bmkg-blue bg-bmkg-sky rounded-lg hover:bg-blue-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <button type="button"
                                data-action="{{ route('admin.buletin.destroy', $bulletin) }}"
                                data-message="Hapus buletin &quot;{{ $bulletin->title }}&quot;? File PDF juga akan dihapus."
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Belum ada buletin. <a href="{{ route('admin.buletin.create') }}" class="text-bmkg-blue font-medium hover:underline">Upload buletin pertama</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($bulletins->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $bulletins->links() }}</div>
    @endif
</div>
@endsection

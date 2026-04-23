@extends('layouts.admin')

@section('title', 'Transparansi Kinerja')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Transparansi Kinerja</h2>
        <p class="text-sm text-gray-500">Kelola dokumen transparansi kinerja yang tampil di halaman publik</p>
    </div>
    <a href="{{ route('admin.transparansi.create') }}"
       class="inline-flex items-center gap-2 bg-bmkg-blue text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Unggah Dokumen
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Judul Dokumen</th>
                <th class="px-6 py-4 text-left">Kategori</th>
                <th class="px-6 py-4 text-center">Tahun</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($transparansis as $item)
            @php
                $badgeClass = match($item->category) {
                    'rencana'   => 'bg-blue-100 text-blue-700',
                    'laporan'   => 'bg-emerald-100 text-emerald-700',
                    'perjanjian'=> 'bg-cyan-100 text-cyan-700',
                    default     => 'bg-gray-100 text-gray-600',
                };
                $categoryLabel = match($item->category) {
                    'rencana'   => 'Rencana Kinerja',
                    'laporan'   => 'Laporan Kinerja',
                    'perjanjian'=> 'Perjanjian Kinerja',
                    default     => $item->category,
                };
            @endphp
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                            <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="text-xs text-bmkg-blue hover:underline flex items-center gap-1">
                                Buka PDF
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full {{ $badgeClass }}">{{ $categoryLabel }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center justify-center px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">{{ $item->year }}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.transparansi.edit', $item) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-bmkg-blue bg-bmkg-sky rounded-lg hover:bg-blue-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <button type="button"
                                data-action="{{ route('admin.transparansi.destroy', $item) }}"
                                data-message="Hapus dokumen &quot;{{ $item->title }}&quot;?"
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
                    Belum ada dokumen transparansi. <a href="{{ route('admin.transparansi.create') }}" class="text-bmkg-blue font-medium hover:underline">Unggah sekarang</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

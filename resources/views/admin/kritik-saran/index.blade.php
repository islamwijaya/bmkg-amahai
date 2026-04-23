@extends('layouts.admin')

@section('title', 'Kritik & Saran')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-bmkg-navy tracking-tight">Daftar Kritik & Saran</h2>
            <p class="text-gray-500 text-sm">Kelola masukan dan penilaian dari masyarakat untuk pelayanan BMKG Amahai.</p>
        </div>
    </div>

    {{-- Feedback Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 font-bold text-bmkg-navy">Tanggal</th>
                        <th class="px-6 py-4 font-bold text-bmkg-navy">Pengirim</th>
                        <th class="px-6 py-4 font-bold text-bmkg-navy">Jenis & Aspek</th>
                        <th class="px-6 py-4 font-bold text-bmkg-navy">Rating</th>
                        <th class="px-6 py-4 font-bold text-bmkg-navy">Pesan</th>
                        <th class="px-6 py-4 font-bold text-bmkg-navy text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($feedbacks as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-gray-500 font-medium">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                            <br>
                            <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $item->created_at->format('H:i') }} WIT</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $item->nama }}</div>
                            <div class="text-xs text-bmkg-blue hover:underline">
                                <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $item->jenis === 'kritik' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $item->jenis }}
                            </span>
                            <div class="text-xs text-gray-500 mt-1 font-medium">{{ $item->aspek }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-bmkg-gold">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $item->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase mt-1 block">
                                {{ ['Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'][$item->rating - 1] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 max-w-md">
                            <p class="text-gray-600 text-sm line-clamp-2 hover:line-clamp-none transition-all cursor-help" title="{{ $item->pesan }}">
                                {{ $item->pesan }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button 
                                @click="$dispatch('open-delete-modal', { 
                                    action: '{{ route('admin.kritik-saran.destroy', $item) }}',
                                    message: 'Apakah Anda yakin ingin menghapus masukan dari {{ $item->nama }}?'
                                })"
                                class="p-2 text-gray-400 hover:text-red-600 transition-colors"
                                title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                <p class="font-medium">Belum ada kritik atau saran yang masuk.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($feedbacks->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 flex justify-center">
            {{ $feedbacks->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

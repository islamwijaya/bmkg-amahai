@extends('layouts.admin')

@section('title', 'Kelola Pegawai (SDM)')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Pegawai (SDM)</h2>
        <p class="text-sm text-gray-500">Data pegawai tampil di halaman profil publik</p>
    </div>
    <a href="{{ route('admin.pegawai.create') }}"
       class="inline-flex items-center gap-2 bg-bmkg-blue text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Pegawai
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Pegawai</th>
                <th class="px-6 py-4 text-left">NIP</th>
                <th class="px-6 py-4 text-left">Jabatan</th>
                <th class="px-6 py-4 text-left">Sub Unit</th>
                <th class="px-6 py-4 text-center">Urutan</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pegawais as $pegawai)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($pegawai->foto_url)
                        <img src="{{ $pegawai->foto_url }}" alt="{{ $pegawai->nama }}" class="w-10 h-10 rounded-full object-cover shrink-0 ring-2 ring-gray-100">
                        @else
                        @php $initials = collect(explode(' ', trim($pegawai->nama)))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                        <div class="w-10 h-10 rounded-full bg-bmkg-navy flex items-center justify-center shrink-0">
                            <span class="text-white text-xs font-bold">{{ $initials }}</span>
                        </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ $pegawai->nama }}</p>
                            <p class="text-xs text-gray-400">{{ $pegawai->golongan }} — {{ $pegawai->pendidikan }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $pegawai->nip }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $pegawai->jabatan }}</td>
                <td class="px-6 py-4">
                    @if($pegawai->sub_unit)
                    <span class="inline-flex items-center px-2 py-1 text-[10px] font-semibold rounded-full bg-bmkg-sky text-bmkg-blue">{{ $pegawai->sub_unit->label() }}</span>
                    @else
                    <span class="text-xs text-gray-400">—</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">{{ $pegawai->urutan }}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.pegawai.edit', $pegawai) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-bmkg-blue bg-bmkg-sky rounded-lg hover:bg-blue-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <button type="button"
                                data-action="{{ route('admin.pegawai.destroy', $pegawai) }}"
                                data-message="Hapus data pegawai &quot;{{ $pegawai->nama }}&quot;?"
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
                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                    Belum ada data pegawai. <a href="{{ route('admin.pegawai.create') }}" class="text-bmkg-blue font-medium hover:underline">Tambah pegawai</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($pegawais->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $pegawais->links() }}</div>
    @endif
</div>
@endsection

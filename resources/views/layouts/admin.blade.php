<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-bmkg.png') }}">
    <title>@yield('title', 'Admin') — BMKG Amahai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bmkg: {
                            navy: '#003366', blue: '#0057A8', light: '#1A78C2',
                            gold: '#21AA93', lgold: '#E8C34A', sky: '#E8F4FF', dark: '#001F3F',
                        }
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>[x-cloak] { display: none !important; }</style>
    @stack('styles')
</head>
<body class="font-sans bg-gray-100 text-gray-800" x-data="{ sidebarOpen: true }">

<div class="flex h-screen overflow-hidden">
    {{-- SIDEBAR --}}
    <aside
        class="bg-bmkg-dark text-white flex flex-col transition-all duration-300 shrink-0 z-40"
        :class="sidebarOpen ? 'w-64' : 'w-16'"
    >
        {{-- Brand --}}
        <div class="flex items-center gap-3 px-4 py-4 border-b border-white/10 h-16 shrink-0">
            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0">
                <img src="{{ asset('assets/img/logo-bmkg.png') }}" alt="BMKG" class="w-6 h-6 object-contain">
            </div>
            <span x-show="sidebarOpen" x-cloak class="font-bold text-sm leading-tight">
                BMKG Amahai<br><span class="text-bmkg-gold text-xs font-normal">Admin Panel</span>
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 py-4 overflow-y-auto">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'admin.informasi.index', 'label' => 'Informasi', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                    ['route' => 'admin.buletin.index', 'label' => 'Buletin', 'icon' => 'M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['route' => 'admin.pegawai.index', 'label' => 'Pegawai (SDM)', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['route' => 'admin.transparansi.index', 'label' => 'Transparansi Kinerja', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['route' => 'admin.kritik-saran.index', 'label' => 'Kritik & Saran', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                    ['route' => 'admin.settings.index', 'label' => 'Pengaturan', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ];
            @endphp
            @foreach($navItems as $item)
            @php $isActive = request()->routeIs($item['route'].'*'); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-colors hover:bg-bmkg-blue/40 {{ $isActive ? 'bg-bmkg-blue/60 text-bmkg-lgold border-r-2 border-bmkg-lgold' : 'text-white/80' }}"
               :class="sidebarOpen ? '' : 'justify-center'"
               title="{{ !$item['label'] ? '' : $item['label'] }}">
                <svg class="w-5 h-5 shrink-0 {{ $isActive ? 'text-bmkg-lgold' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                </svg>
                <span x-show="sidebarOpen" x-cloak>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </nav>

        {{-- Bottom: View Site --}}
        <div class="border-t border-white/10 p-3 shrink-0">
            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center gap-2 px-3 py-2 text-xs text-white/60 hover:text-white rounded-lg hover:bg-white/10 transition-colors"
               :class="sidebarOpen ? '' : 'justify-center'">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span x-show="sidebarOpen" x-cloak>Lihat Website</span>
            </a>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- TOPBAR --}}
        <header class="bg-white shadow-sm h-16 flex items-center px-6 gap-4 shrink-0">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-bmkg-navy transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-bmkg-navy font-bold text-lg flex-1">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 text-sm text-red-500 hover:text-red-700 font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6">
            {{-- Flash Messages --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="mb-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>{{-- Global Hidden Delete Form --}}
<form id="global-delete-form" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

{{-- Delete Confirmation Modal (Alpine.js) --}}
<div x-data="deleteModal()" @open-delete-modal.window="open($event.detail)" x-cloak>
    <div x-show="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="absolute inset-0 bg-black/50" @click="isOpen = false"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl p-6 w-full max-w-sm" x-transition:enter="ease-out duration-200" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500" x-text="message"></p>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button @click="isOpen = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
                <button @click="submit()" class="px-4 py-2 text-sm font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
function deleteModal() {
    return {
        isOpen: false,
        formAction: '',
        message: '',
        open(detail) {
            this.formAction = detail.action;
            this.message = detail.message || 'Apakah Anda yakin ingin menghapus data ini?';
            this.isOpen = true;
        },
        submit() {
            const form = document.getElementById('global-delete-form');
            form.action = this.formAction;
            form.submit();
        }
    }
}
</script>

@stack('scripts')
</body>
</html>

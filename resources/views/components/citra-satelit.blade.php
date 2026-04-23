@php
    $lastUpdated = 'Sedang memperbarui...';
    try {
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists('satelit/last_updated.json')) {
            $data = json_decode(\Illuminate\Support\Facades\Storage::disk('public')->get('satelit/last_updated.json'), true);
            $lastUpdated = $data['formatted'] ?? '-';
        }
    } catch (\Exception $e) {
        $lastUpdated = '-';
    }
@endphp

<section class="max-w-7xl mx-auto px-4 py-8" 
         x-data="{ 
            region: 'maluku',
            selectedImage: null,
            openInfo: null,
            version: Date.now(),
            loading: false,
            lastUpdated: '{{ $lastUpdated }}',
            async syncData() {
                if (this.loading) return;
                this.loading = true;
                
                try {
                    const response = await fetch('{{ route('satelit.sync') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        this.version = Date.now();
                        this.lastUpdated = data.last_updated;
                    } else {
                        if (response.status === 429) {
                            alert('Sinkronisasi dibatasi. Silakan coba lagi dalam beberapa menit.');
                        } else {
                            alert('Gagal menyinkronkan data: ' + (data.message || 'Terjadi kesalahan.'));
                        }
                    }
                } catch (error) {
                    alert('Terjadi kesalahan saat menghubungi server.');
                } finally {
                    this.loading = false;
                }
            },
            init() {
                // Ensure lightbox handles ESC key
                window.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') this.selectedImage = null;
                });
            }
         }">
    {{-- Header with Dropdown --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-6 h-1 bg-bmkg-gold rounded-full"></span>
                <span class="text-bmkg-gold font-bold text-[10px] uppercase tracking-widest">Citra Satelit</span>
            </div>
            <div class="flex items-center gap-3">
                <h2 class="text-bmkg-navy font-bold text-2xl">Kondisi Atmosfer Terkini</h2>
            </div>
            <p class="text-gray-500 text-xs mt-1">Data dari Satelit Himawari-9 dan GSMaP</p>
        </div>
        
        <div class="flex items-center gap-3">
            <label for="region_select" class="text-xs font-bold text-bmkg-navy">Pilih Wilayah:</label>
            <select id="region_select" x-model="region" class="bg-white border border-gray-200 text-bmkg-navy text-xs rounded-lg focus:ring-bmkg-blue focus:border-bmkg-blue block px-3 py-2 shadow-sm transition-all outline-none cursor-pointer">
                <option value="indonesia">Indonesia</option>
                <option value="region4">Region 4</option>
                <option value="maluku">Maluku</option>
            </select>
        </div>
    </div>

    {{-- Image Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-10 gap-6 mb-8">
        {{-- Himawari-9 IR Enhanced --}}
        <div class="lg:col-span-3 bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-fit">
            <div class="p-3 bg-gray-50 border-b border-gray-100 flex items-center justify-between relative">
                <h3 class="font-bold text-bmkg-navy text-sm">Himawari-9 IR Enhanced</h3>
                {{-- Info Icon & Tooltip --}}
                <div class="relative flex items-center" 
                     x-data="{ showTooltip: false }" 
                     @mouseenter="showTooltip = true" 
                     @mouseleave="showTooltip = false">
                    <button class="text-bmkg-blue hover:text-bmkg-navy transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    </button>
                    {{-- Tooltip Content --}}
                    <div x-show="showTooltip" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute z-[60] right-0 top-6 w-52 p-3 bg-bmkg-navy text-white text-[10px] rounded-xl shadow-2xl leading-relaxed text-justify pointer-events-none"
                         style="display: none;">
                        Produk ini menunjukkan suhu puncak awan yang kemudian diklasifikasi dengan pewarnaan tertentu, dimana warna hitam atau biru menunjukkan tidak terdapat pembentukan awan yang banyak (cerah), sedangkan semakin dingin suhu puncak awan (jingga hingga merah) menunjukan pertumbuhan awan signifikan dan berpotensi Cumulonimbus.
                    </div>
                </div>
            </div>
            {{-- Image Container --}}
            <div class="relative flex-1 overflow-hidden flex items-center justify-center cursor-zoom-in"
                 @click="selectedImage = '/storage/satelit/hima_eh_' + region + '.png?v=' + version">
                <img :src="'/storage/satelit/hima_eh_' + region + '.png?v=' + version" 
                     class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.02]" 
                     alt="Satelit IR Enhanced">
            </div>
        </div>

        {{-- Himawari-9 Rainfall Potential --}}
        <div class="lg:col-span-3 bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-fit">
            <div class="p-3 bg-gray-50 border-b border-gray-100 flex items-center justify-between relative">
                <h3 class="font-bold text-bmkg-navy text-sm">Himawari-9 Rainfall Potential</h3>
                {{-- Info Icon & Tooltip --}}
                <div class="relative flex items-center" 
                     x-data="{ showTooltip: false }" 
                     @mouseenter="showTooltip = true" 
                     @mouseleave="showTooltip = false">
                    <button class="text-bmkg-blue hover:text-bmkg-navy transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    </button>
                    {{-- Tooltip Content --}}
                    <div x-show="showTooltip" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute z-[60] right-0 top-6 w-52 p-3 bg-bmkg-navy text-white text-[10px] rounded-xl shadow-2xl leading-relaxed text-justify pointer-events-none"
                         style="display: none;">
                        Produk yang dapat digunakan untuk mengestimasi potensi curah hujan yang disajikan berdasarkan kategori ringan, sedang, lebat, hingga sangat lebat, dengan menggunakan hubungan antara suhu puncak awan dengan curah hujan yang berpotensi dihasilkan.
                    </div>
                </div>
            </div>
            <div class="relative flex-1 overflow-hidden flex items-center justify-center cursor-zoom-in"
                 @click="selectedImage = '/storage/satelit/hima_rp_' + region + '.png?v=' + version">
                <img :src="'/storage/satelit/hima_rp_' + region + '.png?v=' + version" 
                     class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.02]" 
                     alt="Satelit Rainfall Potential">
            </div>
        </div>

        {{-- GSMaP HTH --}}
        <div class="lg:col-span-4 bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-fit">
            <div class="p-3 bg-gray-50 border-b border-gray-100 flex items-center justify-between relative">
                <h3 class="font-bold text-bmkg-navy text-sm">GSMaP Hari Tanpa Hujan (HTH)</h3>
                {{-- Info Icon & Tooltip --}}
                <div class="relative flex items-center" 
                     x-data="{ showTooltip: false }" 
                     @mouseenter="showTooltip = true" 
                     @mouseleave="showTooltip = false">
                    <button class="text-bmkg-blue hover:text-bmkg-navy transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    </button>
                    {{-- Tooltip Content --}}
                    <div x-show="showTooltip" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute z-[60] right-0 top-6 w-52 p-3 bg-bmkg-navy text-white text-[10px] rounded-xl shadow-2xl leading-relaxed text-justify pointer-events-none"
                         style="display: none;">
                        Perhitungan hari tanpa hujan (HTH) yang digunakan berdasarkan data GSMaP harian, sehingga diperoleh peta yang lebih detail untuk menentukan wilayah yang berpotensi terjadi kekeringan (Tersedia untuk cakupan Nasional).
                    </div>
                </div>
            </div>
            <div class="relative flex-1 overflow-hidden flex items-center justify-center cursor-zoom-in"
                 @click="selectedImage = '/storage/satelit/gsmap_hth_indonesia.png?v=' + version">
                <img :src="'/storage/satelit/gsmap_hth_indonesia.png?v=' + version" 
                     class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.02]" 
                     alt="GSMaP HTH">
                <div class="absolute bottom-2 left-2 bg-bmkg-blue/80 backdrop-blur-md px-2 py-1 rounded text-[8px] text-white" x-show="region !== 'indonesia'">
                    Data Regional Tidak Tersedia
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Info --}}
    <div class="flex items-center justify-center gap-2 text-gray-400">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="text-[10px] font-medium tracking-wide">Terakhir diperbarui: <span x-text="lastUpdated">{{ $lastUpdated }}</span></span>
    </div>

    {{-- LIGHTBOX MODAL --}}
    <div x-show="selectedImage" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="selectedImage = null"
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4 cursor-zoom-out"
         style="display: none;">
        
        <div class="relative max-w-7xl max-h-screen">
            <button @click="selectedImage = null" class="absolute -top-12 right-0 text-white hover:text-bmkg-gold transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <img :src="selectedImage" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl border-2 border-white/10" @click.stop>
            <p class="text-white/60 text-center mt-4 text-xs font-medium">Tekan ESC atau klik di mana saja untuk menutup</p>
        </div>
    </div>
</section>

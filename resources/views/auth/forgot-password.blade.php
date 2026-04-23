<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Interactive Developer Guide (Centered Modal) -->
    <div x-data="{ open: false }" class="z-50">
        <!-- Overlay & Container -->
        <div 
            x-show="open" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-[2px] z-[60] flex items-center justify-center p-4"
            style="display: none;"
            @click.self="open = false"
        >
            <!-- Modal Content (Sharp and Centered) -->
            <div 
                x-show="open" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="bg-white w-full max-w-xl max-h-[85vh] p-8 border border-gray-100 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.15)] overflow-hidden flex flex-col pointer-events-auto"
                @click.stop
            >
                <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4 flex-shrink-0">
                    <h3 class="text-base font-bold text-gray-800 uppercase tracking-widest flex items-center">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        Developer Reset Guide
                    </h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-800 p-2 rounded-full hover:bg-gray-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="space-y-6 overflow-y-auto pr-4 custom-scrollbar flex-grow text-left">
                    <!-- Opsi 1 -->
                    <div>
                        <h4 class="text-[11px] font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-md inline-block mb-3 uppercase tracking-wider">Opsi 1: Lewat File Manager aaPanel</h4>
                        <ol class="space-y-2 text-[11px] text-gray-500 leading-relaxed">
                            <li class="flex items-start">1. Buka dashboard aaPanel Anda.</li>
                            <li class="flex items-start">2. Masuk ke menu&nbsp;<span class="font-bold text-gray-700">Files</span>&nbsp;di sidebar kiri.</li>
                            <li class="flex items-start">
                                <div>
                                    3. Navigasi ke folder project:
                                    <code class="mt-1.5 block bg-gray-50 p-2 rounded-md border border-gray-100 text-[10px] text-gray-400 font-mono italic">www/wwwroot/bmkg-amahai/storage/logs/</code>
                                </div>
                            </li>
                            <li class="flex items-start">4. Cari file&nbsp;<span class="font-bold text-gray-700">laravel.log</span>, klik kanan >&nbsp;<span class="italic">Edit</span>.</li>
                            <li class="flex items-start">5. Gulir ke baris paling bawah (End of File).</li>
                            <li class="flex items-start">
                                <div>
                                    6. Link reset password ada di dalam log:
                                    <code class="mt-1.5 block bg-blue-50/50 p-2 rounded-md border border-blue-100 text-[10px] text-blue-600 font-mono break-all leading-normal">http://[domain]/admin/reset-password/...</code>
                                </div>
                            </li>
                            <li class="flex items-start text-emerald-600 font-medium">7. Salin link tersebut dan buka di browser baru.</li>
                        </ol>
                    </div>

                    <!-- Opsi 2 -->
                    <div class="pt-5 border-t border-gray-100">
                        <h4 class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md inline-block mb-3 uppercase tracking-wider">Opsi 2: Lewat Terminal (SSH)</h4>
                        <p class="text-[11px] text-gray-500 mb-3">Gunakan perintah ini untuk melihat log:</p>
                        <div class="bg-gray-900 rounded-lg p-3 border border-gray-800">
                            <code class="text-[10px] text-green-400 font-mono break-all leading-relaxed">
                                tail -n 100 /www/wwwroot/bmkg-amahai/storage/logs/laravel.log
                            </code>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t border-gray-100 text-center flex-shrink-0">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em]">Developer Access Only</p>
                </div>
            </div>
        </div>

        <!-- Toggle Button (Fixed at Bottom Right) -->
        <div class="fixed bottom-6 right-6">
            <button 
                @click="open = !open" 
                class="group flex items-center text-[11px] font-semibold text-gray-400 hover:text-blue-500 bg-white/50 backdrop-blur-sm py-2 px-4 rounded-full transition-all duration-300 focus:outline-none border border-transparent hover:border-gray-200"
            >
                <span class="underline decoration-dotted underline-offset-4 group-hover:decoration-blue-400">Reset sebagai developer</span>
            </button>
        </div>
    </div>
</x-guest-layout>

<div class="relative py-28 bg-purple-50 overflow-hidden pattern-circle">

    <!-- Top Ornament -->
    <svg class="absolute top-8 left-1/2 -translate-x-1/2 w-80 opacity-30" viewBox="0 0 400 120" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M20 100 C100 20, 300 20, 380 100" stroke="#C4B5FD" stroke-width="2" />
    </svg>

    {{-- <img src="{{ asset('assets/11.png') }}" class="absolute top-0 right-6 w-52" /> --}}
    <img src="{{ asset('assets/11.png') }}" class="absolute left-0 top-[40%] w-52  opacity-80 rotate-90 animate-pulse" />
    <img src="{{ asset('assets/11.png') }}"
        class="absolute right-0 top-[40%] w-52  opacity-80 scale-x-[-1] rotate-90 animate-pulse" />
    <!-- Frame -->
    <img src="{{ asset('assets/14.png') }}" class="absolute left-2 top-2 w-52  opacity-80 animate-pulse" />
    <img src="{{ asset('assets/14.png') }}"
        class="absolute right-2 top-2 w-52  opacity-80 animate-pulse scale-x-[-1]" />
    <img src="{{ asset('assets/14.png') }}"
        class="absolute left-2 bottom-2 w-52  opacity-80 animate-pulse scale-y-[-1]" />
    <img src="{{ asset('assets/14.png') }}"
        class="absolute right-2 bottom-2 w-52  opacity-80 animate-pulse scale-y-[-1] scale-x-[-1]" />

    <div class="relative max-w-xl mx-auto px-6 space-y-14 text-center">


        {{-- Akad Nikah --}}
        @if ($wedding->akad_date)
            <div class="bg-white/80 backdrop-blur rounded-3xl p-10 shadow-sm">

                <div class="mb-6 flex justify-center">
                    <div class="w-14 h-14 rounded-full border border-purple-300 flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <h3 class="text-xs tracking-[0.25em] uppercase text-purple-500 mb-3">
                    Akad Nikah
                </h3>

                <p class="font-wedding text-4xl text-gray-800 mb-2">
                    {{ $wedding->akad_date->format('d F Y') }}
                </p>

                <p class="text-sm text-gray-600 mb-4">
                    {{ $wedding->akad_date->format('l') }}
                </p>

                <div class="w-16 h-px bg-purple-300 mx-auto my-5"></div>

                <p class="text-sm text-gray-600 mb-3">
                    {{ $wedding->akad_start }} – {{ $wedding->akad_end }}
                </p>

                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $wedding->akad_location }}
                </p>
            </div>
        @endif

        {{-- Resepsi --}}
        @if ($wedding->reception_date)
            <div class="bg-white/80 backdrop-blur rounded-3xl p-10 shadow-sm">

                <div class="mb-6 flex justify-center">
                    <div class="w-14 h-14 rounded-full border border-purple-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8 c1.11 0 2.08.402 2.599 1M12 8V7 m0 1v8m0 0v1m0-1 c-1.11 0-2.08-.402-2.599-1 M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <h3 class="text-xs tracking-[0.25em] uppercase text-purple-500 mb-3">
                    Resepsi
                </h3>

                <p class="font-wedding text-4xl text-gray-800 mb-2">
                    {{ $wedding->reception_date->format('d F Y') }}
                </p>

                <p class="text-sm text-gray-600 mb-4">
                    {{ $wedding->reception_date->format('l') }}
                </p>

                <div class="w-16 h-px bg-purple-300 mx-auto my-5"></div>

                <p class="text-sm text-gray-600 mb-3">
                    {{ $wedding->reception_start }} – {{ $wedding->reception_end }}
                </p>

                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $wedding->reception_location }}
                </p>
            </div>
        @endif

    </div>

    <!-- Bottom Ornament -->
    <svg class="absolute bottom-8 left-1/2 -translate-x-1/2 w-80 opacity-30 rotate-180" viewBox="0 0 400 120"
        fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20 100 C100 20, 300 20, 380 100" stroke="#C4B5FD" stroke-width="2" />
    </svg>

</div>

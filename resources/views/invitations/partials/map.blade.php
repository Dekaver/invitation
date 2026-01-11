{{-- Map Section --}}
<div class="relative py-24 bg-white overflow-hidden">

    {{-- Heading --}}
    <div class="text-center mb-10 px-6">
        <h3 class="text-xs tracking-[0.25em] uppercase text-purple-500 mb-3">
            Lokasi Acara
        </h3>
        <h2 class="font-wedding text-4xl text-gray-800">
            Peta Lokasi
        </h2>
    </div>

    {{-- Map Card --}}
    <div class="relative max-w-5xl mx-auto px-6">
        <div class="rounded-3xl overflow-hidden shadow-lg border border-purple-200">

            {{-- Google Maps Embed --}}
            <iframe src="{{ $wedding->map_embed_url }}" class="w-full h-100 md:h-125 border-0" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

        </div>

        {{-- Address + Button --}}
        <div class="text-center mt-8">
            <p class="text-gray-700 leading-relaxed mb-4">
                {{ $wedding->akad_location ?? $wedding->reception_location }}
            </p>

            @if (!empty($wedding->map_url))
                <a href="{{ $wedding->map_url }}" target="_blank"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-purple-600 text-white text-sm tracking-wide hover:bg-purple-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.894L9 1m0 19l6-3m-6 3V1m6 16l5.447-2.724A2 2 0 0021 12.382V2.618a2 2 0 00-1.553-1.894L15 1m0 16V1" />
                    </svg>
                    Buka di Google Maps
                </a>
            @endif
        </div>
    </div>

</div>

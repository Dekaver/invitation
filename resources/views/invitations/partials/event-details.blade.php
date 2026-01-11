<!-- Event Details -->
<div class="grid md:grid-cols-2 gap-6">
    @if ($wedding->akad_date)
        <div class="bg-gray-50 rounded-lg p-8 text-center border-l-4 border-purple-500 hover:shadow-lg transition">
            <div class="mb-4">
                <svg class="w-12 h-12 mx-auto text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-purple-600 mb-2">Akad Nikah</h3>
            <p class="text-gray-700 font-semibold mb-2">
                {{ $wedding->akad_date->format('l, d F Y') }}
            </p>
            <p class="text-gray-600 mb-4">
                {{ $wedding->akad_date->format('H:i') }}
            </p>
            <p class="text-gray-700 font-medium">
                {{ $wedding->akad_location }}
            </p>
        </div>
    @endif

    @if ($wedding->reception_date)
        <div class="bg-gray-50 rounded-lg p-8 text-center border-l-4 border-pink-500 hover:shadow-lg transition">
            <div class="mb-4">
                <svg class="w-12 h-12 mx-auto text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-pink-600 mb-2">Reception</h3>
            <p class="text-gray-700 font-semibold mb-2">
                {{ $wedding->reception_date->format('l, d F Y') }}
            </p>
            <p class="text-gray-600 mb-4">
                {{ $wedding->reception_date->format('H:i') }}
            </p>
            <p class="text-gray-700 font-medium">
                {{ $wedding->reception_location }}
            </p>
        </div>
    @endif
</div>

{{-- Thank You Section --}}
<div class="relative py-28 bg-purple-50 overflow-hidden">

    <!-- Top Ornament -->
    <svg class="absolute top-8 left-1/2 -translate-x-1/2 w-80 opacity-20" viewBox="0 0 400 120" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M20 100 C100 20, 300 20, 380 100" stroke="#C4B5FD" stroke-width="2" />
    </svg>

    <div class="max-w-2xl mx-auto px-6 text-center space-y-6">

        <h3 class="text-xs tracking-[0.25em] uppercase text-purple-500 mb-2">
            Terima Kasih
        </h3>

        <h2 class="font-wedding text-4xl md:text-5xl text-gray-800 mb-4">
            Atas Kehadiran & Doa Anda
        </h2>

        <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
            Kami sangat bersyukur atas kehadiran, doa, dan ucapan terbaik dari semua teman dan keluarga.
            Semoga Allah SWT membalas kebaikan Anda dengan kebahagiaan dan keberkahan yang melimpah.
        </p>

        <p class="text-gray-600 mt-4 italic">
            – {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
        </p>

    </div>

    <!-- Bottom Ornament -->
    <svg class="absolute bottom-8 left-1/2 -translate-x-1/2 w-80 opacity-20 rotate-180" viewBox="0 0 400 120"
        fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20 100 C100 20, 300 20, 380 100" stroke="#C4B5FD" stroke-width="2" />
    </svg>

</div>

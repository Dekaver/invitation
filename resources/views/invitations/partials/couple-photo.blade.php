<!-- Couple Photo Section -->
<div class="h-full flex flex-col items-center justify-center p-8 text-center
           bg-center bg-cover bg-no-repeat relative"
    style="background-image: url('{{ asset('assets/prewedding.png') }}');">
    <!-- overlay agar teks tetap terbaca -->
    <div class="absolute inset-0 backdrop-blur-xs"></div>

    {{-- <div class="relative z-10">
        <h2
            class="text-3xl font-bold text-transparent bg-clip-text
                   bg-linear-to-r from-purple-600 to-pink-600">
            {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
        </h2>
    </div> --}}
</div>

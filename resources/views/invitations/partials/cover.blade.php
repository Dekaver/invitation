<div id="cover"
    class="relative min-h-screen flex flex-col items-center justify-center text-center px-6 overflow-hidden
           bg-linear-to-b from-purple-200 via-white to-purple-200">

    <!-- Decorative top -->
    <img src="{{ asset('assets/5.png') }}" class="absolute -top-6 -left-6 w-52 opacity-70 rotate-180" />
    <img src="{{ asset('assets/3.png') }}" class="absolute -top-6 left-1/2 -translate-x-1/2 w-56 opacity-80" />
    <img src="{{ asset('assets/5.png') }}" class="absolute -top-6 -right-6 w-52 opacity-70 rotate-x-180" />

    <!-- Decorative side -->
    <img src="{{ asset('assets/3.png') }}" class="absolute top-[20%] -left-20 w-48 opacity-60 rotate-90" />
    <img src="{{ asset('assets/3.png') }}" class="absolute top-[30%] -left-20 w-48 opacity-60 rotate-90 " />
    <img src="{{ asset('assets/3.png') }}" class="absolute top-[20%] -right-20 w-48 opacity-60 rotate-90 " />
    <img src="{{ asset('assets/3.png') }}" class="absolute top-[30%] -right-20 w-48 opacity-60 rotate-90 " />

    <!-- Decorative center -->
    <img src="{{ asset('assets/center.png') }}"
        class="absolute top-[35%] left-1/2 -translate-x-1/2 w-105 opacity-90 z-10 animate-in fade-in duration-1000 delay-0" />

    <!-- Content -->
    <div class="relative z-10 flex flex-col items-center space-y-3 -mt-16">
        <!-- Bismilah -->
        <span
            class="font-arabic uppercase tracking-[0.3em] text-2xl md:text-4xl text-purple-500
                   animate-in fade-in duration-1000">
            بِسْمِ ٱللَّٰهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
        </span>
        <!-- Subtitle -->
        <span
            class="uppercase tracking-[0.3em] text-xs md:text-sm text-purple-500
                   animate-in fade-in duration-1000">
            The Wedding Of
        </span>
        <!-- Bride -->
        <h2
            class="font-wedding text-4xl md:text-6xl font-bold text-transparent bg-clip-text
                   bg-linear-to-r from-purple-600 to-pink-500
                   animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-200 p-2">
            {{ $wedding->bride_short_name }}

        </h2>
        <!-- Divider -->
        <div class="flex items-center gap-4 animate-in fade-in duration-1000 delay-400">
            <span class="w-16 h-px bg-purple-300"></span>
            <span class="text-3xl text-purple-400 font-light">&</span>
            <span class="w-16 h-px bg-purple-300"></span>
        </div>
        <!-- Groom -->
        <h2
            class="font-wedding text-4xl md:text-6xl font-bold text-transparent bg-clip-text
                   bg-linear-to-r from-purple-600 to-pink-500
                   animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-600 p-2">
            {{ $wedding->groom_short_name }}
        </h2>
        <!-- Couple Photo -->
        <div class="w-56 h-56 md:w-64 md:h-64 rounded-full bg-cover bg-center ring-4 ring-white/70 shadow-xl animate-in fade-in duration-1000 delay-700"
            style="background-image: url('{{ asset('assets/prewedding.png') }}'); background-position: center 20%;">
        </div>
        <!-- Button -->
        <button id="openInvitation"
            class="mt-12 bg-linear-to-r from-purple-600 to-pink-500 text-white py-3 px-8 rounded-full hover:shadow-lg transition animate-bounce">
            Buka Undangan
        </button>
    </div>

    <!-- Decorative bottom -->
    <img src="{{ asset('assets/bottom.png') }}"
        class="absolute bottom-0 left-0 w-full opacity-80
               animate-in fade-in slide-in-from-bottom-5 duration-1000 delay-0" />
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('openInvitation');
            const cover = document.getElementById('cover');

            const main = document.getElementById('mainContent'); // konten undangan

            btn.addEventListener('click', function() {
                cover.classList.add('transition-opacity', 'duration-700', 'opacity-0');
                setTimeout(() => cover.style.display = 'none', 700);
                main.scrollIntoView({
                    behavior: 'smooth'
                });

                // play music
                if (music.paused) {
                    music.play();
                    playBtn.innerHTML = "⏸️"; // ganti icon saat play
                } else {
                    music.pause();
                    playBtn.innerHTML = "🎵"; // icon saat pause
                }
            });
        });
    </script>
@endpush

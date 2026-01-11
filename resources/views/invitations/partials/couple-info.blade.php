<!-- Couple Information -->
<div class="bg-purple-200-50 rounded-lg">
    <div
        class="relative h-screen flex flex-col items-center justify-center text-center px-6 overflow-hidden
           bg-linear-to-b from-purple-50 via-white to-purple-100">

        <!-- Decorative top -->
        <img src="{{ asset('assets/3.png') }}"
            class="absolute top-8 left-1/2 -translate-x-1/2 w-20 opacity-80
               animate-in fade-in slide-in-from-top-6 duration-1000 delay-200" />

        <!-- Background -->
        <img src="{{ asset('assets/frame.png') }}"
            class="pointer-events-none absolute inset-0 z-0 w-full h-full object-cover opacity-30
               animate-in fade-in duration-1500" />

        <!-- Content -->
        <div class="relative z-10 space-y-2 text-center">
            <h2
                class="font-wedding text-4xl md:text-6xl font-bold text-transparent bg-clip-text
                   bg-linear-to-r from-purple-600 to-pink-500
                   animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-300">
                {{ $wedding->groom_name }}
            </h2>

            <span
                class="block text-3xl md:text-4xl text-purple-500 font-light
                   animate-in fade-in duration-1000 delay-500">
                &
            </span>

            <h2
                class="font-wedding text-4xl md:text-6xl font-bold text-transparent bg-clip-text
                   bg-linear-to-r from-purple-600 to-pink-500
                   animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-700">
                {{ $wedding->bride_name }}
            </h2>
        </div>

        <!-- Decorative bottom -->
        <img src="{{ asset('assets/flower-bottom.png') }}"
            class="absolute bottom-8 left-1/2 -translate-x-1/2 w-24 opacity-80
               animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-900" />
    </div>



    <!-- Parents Information -->
    <div class="grid md:grid-cols-1 gap-8">
        <div class="h-svh flex flex-col justify-center text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Groom's Family</h3>
            <div class="space-y-2">
                <p class="text-gray-700">
                    <span class="font-semibold">{{ $wedding->groom_name }}</span>
                </p>
                <p class="text-gray-600 text-sm">
                    Son of {{ $wedding->groom_father ?? 'N/A' }} & {{ $wedding->groom_mother ?? 'N/A' }}
                </p>
            </div>
        </div>

        <div class="h-lvh flex flex-col justify-center text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Bride's Family</h3>
            <div class="space-y-2">
                <p class="text-gray-700">
                    <span class="font-semibold">{{ $wedding->bride_name }}</span>
                </p>
                <p class="text-gray-600 text-sm">
                    Daughter of {{ $wedding->bride_father ?? 'N/A' }} & {{ $wedding->bride_mother ?? 'N/A' }}
                </p>
            </div>
        </div>
    </div>
</div>

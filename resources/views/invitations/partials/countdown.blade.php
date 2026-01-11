{{-- Countdown Section --}}
<div class="relative py-24 bg-purple-50 text-center overflow-hidden">

    <h3 class="text-2xl tracking-[0.25em] uppercase text-purple-500 mb-4">
        Menuju Hari Bahagia
    </h3>

    <h2 class="font-wedding text-4xl text-gray-800 mb-10">
        Countdown
    </h2>

    <div id="countdown" class="flex justify-center gap-4 md:gap-6 text-center">
        <div class="bg-white/80 backdrop-blur rounded-2xl w-20 md:w-24 py-4 shadow-sm border border-purple-200">
            <span id="days">0</span>
            <small>Hari</small>
        </div>
        <div class="bg-white/80 backdrop-blur rounded-2xl w-20 md:w-24 py-4 shadow-sm border border-purple-200">
            <span id="hours">0</span>
            <small>Jam</small>
        </div>
        <div class="bg-white/80 backdrop-blur rounded-2xl w-20 md:w-24 py-4 shadow-sm border border-purple-200">
            <span id="minutes">0</span>
            <small>Menit</small>
        </div>
        <div class="bg-white/80 backdrop-blur rounded-2xl w-20 md:w-24 py-4 shadow-sm border border-purple-200">
            <span id="seconds">0</span>
            <small>Detik</small>
        </div>
    </div>
</div>
@push('head')
    <style>
        .count-box {
            @apply bg-white/80 backdrop-blur rounded-2xl w-20 md:w-24 py-4 shadow-sm border border-purple-200;
        }

        .count-box span {
            @apply block text-3xl md:text-4xl font-semibold text-purple-700;
        }

        .count-box small {
            @apply text-xs tracking-wide text-gray-500 uppercase;
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // GANTI TARGET TANGGAL DI SINI
            const targetDate = new Date("{{ $wedding->akad_date->format('Y-m-d') }}T{{ $wedding->akad_start }}")
                .getTime();

            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance <= 0) {
                    daysEl.innerHTML = 0;
                    hoursEl.innerHTML = 0;
                    minutesEl.innerHTML = 0;
                    secondsEl.innerHTML = 0;
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((distance / (1000 * 60)) % 60);
                const seconds = Math.floor((distance / 1000) % 60);

                daysEl.innerHTML = days;
                hoursEl.innerHTML = hours;
                minutesEl.innerHTML = minutes;
                secondsEl.innerHTML = seconds;
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    </script>
@endpush

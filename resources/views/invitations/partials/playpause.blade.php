<!-- Tombol Play Musik -->
<button id="playBtn" title="Putar Musik">
    <span>🎵</span>
</button>

<!-- Audio Background -->
<audio id="backgroundMusic" loop>
    <source src="{{ asset('assets/audio/backsound.mpeg') }}" type="audio/mpeg">
    Browsermu tidak mendukung audio.
</audio>

@push('head')
    <style>
        #playBtn {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #f2c6b8;
            /* soft wedding color */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 0 10px rgba(242, 198, 184, 0.5);
            animation: pulse 2s infinite;
        }

        #playBtn:hover {
            transform: scale(1.2);
            box-shadow: 0 0 20px rgba(242, 198, 184, 0.7);
        }

        /* Animasi pulse lembut */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        const playBtn = document.getElementById("playBtn");
        const music = document.getElementById("backgroundMusic");

        playBtn.addEventListener("click", () => {
            if (music.paused) {
                music.play();
                playBtn.innerHTML = "⏸️"; // ganti icon saat play
            } else {
                music.pause();
                playBtn.innerHTML = "🎵"; // icon saat pause
            }
        });
    </script>
@endpush

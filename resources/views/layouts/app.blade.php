<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Wedding Invitation')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700&display=swap" rel="stylesheet" />

    <style>
        .font-wedding {
            font-family: 'Great Vibes', cursive;
        }

        .font-arabic {
            font-family: 'Amiri', serif;
        }
    </style>
    <style>
        body {
            margin: 0;
            height: 100vh;
            background: #ccc;
            overflow: hidden;
        }

        /* container */
        .snow {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9999;
        }

        /* salju */
        .snow span {
            position: absolute;
            top: -10px;
            border-radius: 50%;
            background: white;
            opacity: .8;

            filter: drop-shadow(0 0 2px rgba(0, 0, 0, .35));

            animation: fall linear infinite;
            transition: transform 0.2s ease-out;
            /* respon kursor */
        }

        /* jatuh + miring */
        @keyframes fall {
            to {
                transform: translate(calc(var(--drift) * 1px),
                        110vh);
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/js/app.ts'])
    @stack('head')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        @yield('content')
    </div>
    <div class="snow"></div>
    @stack('scripts')
    <script>
        const snow = document.querySelector('.snow');
        const JUMLAH = 70;
        const RADIUS = 500; // jarak aman dari kursor

        const flakes = [];

        for (let i = 0; i < JUMLAH; i++) {
            const s = document.createElement('span');

            const size = Math.random() * 4 + 2;
            const drift = Math.random() * 120 - 60;

            s.style.width = size + 'px';
            s.style.height = size + 'px';
            s.style.left = Math.random() * 100 + '%';
            s.style.animationDuration = (10 + Math.random() * 20) + 's';
            s.style.animationDelay = (-Math.random() * 20) + 's';
            s.style.setProperty('--drift', drift);

            snow.appendChild(s);

            flakes.push({
                el: s,
                x: s.offsetLeft,
                y: Math.random() * window.innerHeight
            });
        }

        /* efek menjauh dari kursor */
        document.addEventListener('mousemove', e => {
            flakes.forEach(f => {
                const rect = f.el.getBoundingClientRect();
                const dx = rect.left - e.clientX;
                const dy = rect.top - e.clientY;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < RADIUS) {
                    const force = (RADIUS - dist) / RADIUS;
                    const moveX = dx * force * 0.6;
                    const moveY = dy * force * 0.6;

                    f.el.style.transform =
                        `translate(${moveX}px, ${moveY}px)`;
                } else {
                    f.el.style.transform = '';
                }
            });
        });
    </script>
</body>

</html>

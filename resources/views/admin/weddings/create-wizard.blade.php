<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Buat Undangan Pernikahan' }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/wedding-wizard.ts'])
</head>

<body class="antialiased">
    <div id="app">
        <!-- Vue App will be mounted here -->
        <div class="min-h-screen bg-gray-50 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumbs -->
                <nav class="mb-8">
                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                        <li><a href="{{ route('admin.index') }}" class="hover:text-gray-700">Dashboard</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li><a href="{{ route('admin.weddings.index') }}" class="hover:text-gray-700">Weddings</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li class="text-gray-900 font-medium">Create Wedding</li>
                    </ol>
                </nav>

                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Buat Undangan Pernikahan Baru</h1>
                    <p class="mt-2 text-gray-600">
                        Ikuti langkah-langkah berikut untuk membuat undangan pernikahan yang lengkap.
                    </p>
                </div>

                <!-- Vue Wedding Wizard Component -->
                <wedding-wizard @wedding-created="onWeddingCreated"></wedding-wizard>
            </div>
        </div>
    </div>

    <script>
        // Global configuration for Axios
        window.axios = window.axios || {};
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        // Vue app initialization
        window.app = window.app || {};

        // Handle wedding creation success
        window.onWeddingCreated = function(data) {
            // Show success message
            alert('Undangan pernikahan berhasil dibuat!\n\nURL: ' + data.url);

            // Redirect to wedding list or newly created wedding
            window.location.href = '{{ route('admin.weddings.index') }}';
        };
    </script>
</body>

</html>

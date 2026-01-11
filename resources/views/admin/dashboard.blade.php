@extends('layouts.app')

@section('title', 'Dashboard - Admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">Wedding Invitation Admin</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Hero Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Selamat Datang!</h2>
                <p class="text-gray-600 text-lg">Kelola pernikahan, tamu, dan keinginan tamu dengan mudah.</p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m0 0h6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Pernikahan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Wedding::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 6a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Tamu</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Guest::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Keinginan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Wish::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Manage Weddings -->
                <a href="{{ route('admin.weddings.index') }}" class="block group">
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200 h-full">
                        <div class="mb-4">
                            <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600">
                            Kelola Pernikahan
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Buat, edit, dan hapus data pernikahan. Kelola tema dan detail acara.
                        </p>
                        <div class="mt-4 text-blue-600 font-medium text-sm group-hover:underline">
                            Buka →
                        </div>
                    </div>
                </a>

                <!-- View Recent Weddings -->
                <div class="bg-white rounded-lg shadow-md p-6 h-full">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pernikahan Terbaru</h3>
                    <div class="space-y-3">
                        @forelse (\App\Models\Wedding::latest()->take(3)->get() as $wedding)
                            <a href="{{ route('admin.weddings.guests.index', $wedding->id) }}"
                                class="block text-sm text-blue-600 hover:text-blue-900 hover:underline">
                                {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
                                <span class="text-gray-400">({{ $wedding->guests->count() }} tamu)</span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada pernikahan</p>
                        @endforelse
                    </div>
                    <a href="{{ route('admin.weddings.index') }}"
                        class="mt-4 inline-block text-blue-600 hover:text-blue-900 font-medium text-sm">
                        Lihat Semua →
                    </a>
                </div>

                <!-- Quick Create -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white h-full">
                    <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.weddings.create') }}"
                            class="block bg-blue-700 hover:bg-blue-800 rounded px-4 py-2 text-center font-medium transition">
                            + Buat Pernikahan Baru
                        </a>
                        @if (\App\Models\Wedding::count() > 0)
                            <a href="{{ route('admin.weddings.index') }}"
                                class="block bg-blue-700 hover:bg-blue-800 rounded px-4 py-2 text-center font-medium transition">
                                Lihat Daftar Pernikahan
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent RSVP Activity -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas RSVP Terbaru</h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    @forelse (\App\Models\Guest::latest()->take(5)->get() as $guest)
                        <div class="flex items-center justify-between text-sm border-b pb-3">
                            <div>
                                <p class="font-medium text-gray-900">{{ $guest->name }}</p>
                                <p class="text-gray-600">
                                    {{ $guest->wedding->groom_name }} & {{ $guest->wedding->bride_name }}
                                </p>
                            </div>
                            <div class="text-right">
                                @if ($guest->rsvp_status === 'yes')
                                    <span
                                        class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">
                                        Akan Datang
                                    </span>
                                @elseif ($guest->rsvp_status === 'no')
                                    <span
                                        class="inline-block bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">
                                        Tidak Datang
                                    </span>
                                @else
                                    <span
                                        class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">
                                        Mungkin
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

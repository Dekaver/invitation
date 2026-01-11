@extends('layouts.app')

@section('title', "Wishes & Blessings - {$wedding->groom_name} & {$wedding->bride_name}")

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-pink-50 to-purple-50 py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">
                    Doa Restu & Ucapan
                </h1>
                <p class="text-gray-600">
                    untuk {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
                </p>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Wishes List -->
                <div class="md:col-span-2">
                    <div class="space-y-4">
                        @forelse($wishes as $wish)
                            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold text-gray-800">{{ $wish->guest_name }}</h3>
                                    <span class="text-gray-500 text-sm">
                                        {{ $wish->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $wish->message }}
                                </p>
                            </div>
                        @empty
                            <div class="bg-white rounded-lg shadow p-6 text-center">
                                <p class="text-gray-500">
                                    Belum ada ucapan. Jadilah yang pertama meninggalkan doa restu!
                                </p>
                            </div>
                        @endforelse

                        <!-- Pagination -->
                        @if ($wishes->hasPages())
                            <div class="mt-8">
                                {{ $wishes->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Wish Form Sidebar -->
                <div class="md:col-span-1">
                    <div id="form" class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tinggalkan Ucapan</h2>

                        @if ($errors->any())
                            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('invitations.wishes.store', ['wedding' => $wedding->slug]) }}"
                            class="space-y-4">
                            @csrf

                            <!-- Guest Name -->
                            <div>
                                <label for="guest_name" class="block font-semibold text-gray-700 mb-2">
                                    Nama Anda
                                </label>
                                <input type="text" id="guest_name" name="guest_name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    value="{{ old('guest_name') }}" required>
                                @error('guest_name')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block font-semibold text-gray-700 mb-2">
                                    Ucapan Anda
                                </label>
                                <textarea id="message" name="message" rows="6"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 resize-none"
                                    placeholder="Bagikan doa restu dan ucapan terbaik Anda..." required>{{ old('message') }}</textarea>
                                <p class="text-gray-500 text-xs mt-1">
                                    Maksimal 500 karakter
                                </p>
                                @error('message')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full px-4 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition">
                                Kirim Ucapan
                            </button>
                        </form>

                        <!-- Info Text -->
                        <p class="text-gray-500 text-xs mt-4 text-center">
                            Ucapan Anda akan terlihat oleh semua tamu
                        </p>
                    </div>
                </div>
            </div>

            <!-- Back Link -->
            <div class="mt-8 text-center">
                <a href="{{ route('invitations.show', ['wedding' => $wedding->slug]) }}"
                    class="text-purple-600 hover:text-purple-700 font-semibold">
                    ← Kembali ke Undangan
                </a>
            </div>
        </div>
    </div>
@endsection

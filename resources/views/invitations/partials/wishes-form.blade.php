<!-- Wishes Submission Form -->
<div class="bg-gray-50 rounded-lg p-8">
    <h3 class="text-2xl font-bold text-gray-800 mb-2">Bagikan Doa Restu Anda</h3>
    <p class="text-gray-600 mb-6">Kirimkan doa restu dan ucapan hangat Anda untuk pasangan bahagia</p>

    <form action="{{ route('invitations.wishes.store', $wedding->slug) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="guest_name" class="block text-sm font-medium text-gray-700 mb-2">
                Nama Anda
            </label>
            <input type="text" name="guest_name" id="guest_name" placeholder="Masukkan nama Anda"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('guest_name') @enderror"
                value="{{ old('guest_name') }}" required>
            @error('guest_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                Pesan Anda
            </label>
            <textarea name="message" id="message" placeholder="Bagikan doa restu dan ucapan hangat Anda..." rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('message') @enderror"
                required>{{ old('message') }}</textarea>
            <p class="text-gray-500 text-xs mt-1">Minimal 5 karakter, maksimal 500 karakter</p>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-linear-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-4 rounded-lg hover:shadow-lg transition">
            Kirim Doa Restu
        </button>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    </form>

    <div class="mt-6 p-4 bg-purple-50 rounded-lg border border-purple-200">
        <p class="text-sm text-purple-800">
            💝 Doa restu Anda akan terlihat di daftar tamu sebentar lagi
        </p>
    </div>
</div>

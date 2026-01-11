<!-- Wishes Submission Form -->
<div class="bg-gray-50 rounded-lg p-8">
    <h3 class="text-2xl font-bold text-gray-800 mb-2">Share Your Blessing</h3>
    <p class="text-gray-600 mb-6">Send your warm wishes and blessings for the happy couple</p>

    <form action="{{ route('invitations.wishes.store', $wedding->slug) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="guest_name" class="block text-sm font-medium text-gray-700 mb-2">
                Your Name
            </label>
            <input type="text" name="guest_name" id="guest_name" placeholder="Enter your name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('guest_name') border-red-500 @enderror"
                value="{{ old('guest_name') }}" required>
            @error('guest_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                Your Message
            </label>
            <textarea name="message" id="message" placeholder="Share your warm wishes and blessings..." rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('message') border-red-500 @enderror"
                required>{{ old('message') }}</textarea>
            <p class="text-gray-500 text-xs mt-1">Minimum 5 characters, maximum 500 characters</p>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-4 rounded-lg hover:shadow-lg transition">
            Send Blessing
        </button>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    </form>

    <div class="mt-6 p-4 bg-purple-50 rounded-lg border border-purple-200">
        <p class="text-sm text-purple-800">
            💝 Your blessing will be visible on the guest list shortly
        </p>
    </div>
</div>

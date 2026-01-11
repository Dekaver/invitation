@extends('admin.layout')

@section('title', 'Tambah Tamu')

@section('admin-content')
    <div class="max-w-2xl mx-auto">
        <form action="{{ route('admin.weddings.guests.store', $wedding->id) }}" method="POST"
            class="bg-white rounded-lg shadow p-8 space-y-6">
            @csrf

            <div class="space-y-6">
                <!-- Nama Tamu -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Tamu *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ahmad Rahman"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Telepon *
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        placeholder="+62 812-3456-7890"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                        required>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status RSVP -->
                <div>
                    <label for="rsvp_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status RSVP *
                    </label>
                    <select id="rsvp_status" name="rsvp_status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('rsvp_status') border-red-500 @enderror"
                        required onchange="handleRsvpChange()">
                        <option value="">-- Pilih Status --</option>
                        <option value="yes" {{ old('rsvp_status') == 'yes' ? 'selected' : '' }}>
                            ✓ Akan Datang
                        </option>
                        <option value="no" {{ old('rsvp_status') == 'no' ? 'selected' : '' }}>
                            ✗ Tidak Datang
                        </option>
                        <option value="maybe" {{ old('rsvp_status') == 'maybe' ? 'selected' : '' }}>
                            ? Mungkin
                        </option>
                    </select>
                    @error('rsvp_status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Tamu -->
                <div id="total_guest_container" class="hidden">
                    <label for="total_guest" class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah Tamu (termasuk diri sendiri) *
                    </label>
                    <select id="total_guest" name="total_guest"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('total_guest') border-red-500 @enderror">
                        <option value="">-- Pilih Jumlah --</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('total_guest') == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i > 1 ? 'orang' : 'orang' }}
                            </option>
                        @endfor
                    </select>
                    @error('total_guest')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Tamu
                </button>
                <a href="{{ route('admin.weddings.guests.index', $wedding->id) }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function handleRsvpChange() {
            const rsvpStatus = document.getElementById('rsvp_status').value;
            const totalGuestContainer = document.getElementById('total_guest_container');
            const totalGuestInput = document.getElementById('total_guest');

            if (rsvpStatus === 'yes') {
                totalGuestContainer.classList.remove('hidden');
                totalGuestInput.required = true;
            } else {
                totalGuestContainer.classList.add('hidden');
                totalGuestInput.required = false;
                totalGuestInput.value = '';
            }
        }

        // Panggil saat halaman load
        document.addEventListener('DOMContentLoaded', handleRsvpChange);
    </script>
@endsection

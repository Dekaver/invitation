@extends('admin.layout')

@section('title', 'Edit Pernikahan')

@section('admin-content')
    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.weddings.update', $wedding->id) }}" method="POST"
            class="bg-white rounded-lg shadow p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Slug -->
                <div class="md:col-span-2">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug (URL-friendly) *
                    </label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $wedding->slug) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                        required>
                    @error('slug')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Groom -->
                <div>
                    <label for="groom_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Pengantin Pria *
                    </label>
                    <input type="text" id="groom_name" name="groom_name"
                        value="{{ old('groom_name', $wedding->groom_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('groom_name') border-red-500 @enderror"
                        required>
                    @error('groom_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bride -->
                <div>
                    <label for="bride_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Pengantin Wanita *
                    </label>
                    <input type="text" id="bride_name" name="bride_name"
                        value="{{ old('bride_name', $wedding->bride_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bride_name') border-red-500 @enderror"
                        required>
                    @error('bride_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Groom Father -->
                <div>
                    <label for="groom_father" class="block text-sm font-medium text-gray-700 mb-2">
                        Ayah Pengantin Pria *
                    </label>
                    <input type="text" id="groom_father" name="groom_father"
                        value="{{ old('groom_father', $wedding->groom_father) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('groom_father') border-red-500 @enderror"
                        required>
                    @error('groom_father')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Groom Mother -->
                <div>
                    <label for="groom_mother" class="block text-sm font-medium text-gray-700 mb-2">
                        Ibu Pengantin Pria *
                    </label>
                    <input type="text" id="groom_mother" name="groom_mother"
                        value="{{ old('groom_mother', $wedding->groom_mother) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('groom_mother') border-red-500 @enderror"
                        required>
                    @error('groom_mother')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bride Father -->
                <div>
                    <label for="bride_father" class="block text-sm font-medium text-gray-700 mb-2">
                        Ayah Pengantin Wanita *
                    </label>
                    <input type="text" id="bride_father" name="bride_father"
                        value="{{ old('bride_father', $wedding->bride_father) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bride_father') border-red-500 @enderror"
                        required>
                    @error('bride_father')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bride Mother -->
                <div>
                    <label for="bride_mother" class="block text-sm font-medium text-gray-700 mb-2">
                        Ibu Pengantin Wanita *
                    </label>
                    <input type="text" id="bride_mother" name="bride_mother"
                        value="{{ old('bride_mother', $wedding->bride_mother) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bride_mother') border-red-500 @enderror"
                        required>
                    @error('bride_mother')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Akad Date -->
                <div>
                    <label for="akad_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Akad *
                    </label>
                    <input type="datetime-local" id="akad_date" name="akad_date"
                        value="{{ old('akad_date', $wedding->akad_date->format('Y-m-d\TH:i')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('akad_date') border-red-500 @enderror"
                        required>
                    @error('akad_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Akad Location -->
                <div>
                    <label for="akad_location" class="block text-sm font-medium text-gray-700 mb-2">
                        Lokasi Akad *
                    </label>
                    <input type="text" id="akad_location" name="akad_location"
                        value="{{ old('akad_location', $wedding->akad_location) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('akad_location') border-red-500 @enderror"
                        required>
                    @error('akad_location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reception Date -->
                <div>
                    <label for="reception_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Resepsi *
                    </label>
                    <input type="datetime-local" id="reception_date" name="reception_date"
                        value="{{ old('reception_date', $wedding->reception_date->format('Y-m-d\TH:i')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('reception_date') border-red-500 @enderror"
                        required>
                    @error('reception_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reception Location -->
                <div>
                    <label for="reception_location" class="block text-sm font-medium text-gray-700 mb-2">
                        Lokasi Resepsi *
                    </label>
                    <input type="text" id="reception_location" name="reception_location"
                        value="{{ old('reception_location', $wedding->reception_location) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('reception_location') border-red-500 @enderror"
                        required>
                    @error('reception_location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Theme -->
                <div class="md:col-span-2">
                    <label for="theme" class="block text-sm font-medium text-gray-700 mb-2">
                        Tema Undangan *
                    </label>
                    <select id="theme" name="theme"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('theme') border-red-500 @enderror"
                        required>
                        <option value="classic" {{ old('theme', $wedding->theme) == 'classic' ? 'selected' : '' }}>
                            Classic (Modern Gradient)
                        </option>
                        <option value="modern" {{ old('theme', $wedding->theme) == 'modern' ? 'selected' : '' }}>
                            Modern (Dark dengan Cyan)
                        </option>
                        <option value="elegant" {{ old('theme', $wedding->theme) == 'elegant' ? 'selected' : '' }}>
                            Elegant (Serif dengan Gold)
                        </option>
                    </select>
                    @error('theme')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.weddings.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

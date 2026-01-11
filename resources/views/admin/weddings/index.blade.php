@extends('admin.layout')

@section('title', 'Daftar Pernikahan')

@section('admin-content')
    <div class="space-y-6">
        <!-- Header dengan tombol tambah -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">Daftar Pernikahan</h2>
            <a href="{{ route('admin.weddings.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                + Tambah Pernikahan
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Pasangan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Tanggal Akad
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Tema
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Tamu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($weddings as $wedding)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $wedding->slug }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $wedding->akad_date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800 font-medium">
                                    {{ ucfirst($wedding->theme) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $wedding->guests->count() }} tamu
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                <a href="{{ route('admin.weddings.guests.index', $wedding->id) }}"
                                    class="text-green-600 hover:text-green-900 font-medium">
                                    Tamu
                                </a>
                                <a href="{{ route('admin.weddings.wishes.index', $wedding->id) }}"
                                    class="text-purple-600 hover:text-purple-900 font-medium">
                                    Keinginan
                                </a>
                                <a href="{{ route('admin.weddings.edit', $wedding->id) }}"
                                    class="text-blue-600 hover:text-blue-900 font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('admin.weddings.destroy', $wedding->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus pernikahan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                        Hapus
                                    </button>
                                </form>
                                <a href="{{ route('invitations.show', $wedding->slug) }}" target="_blank"
                                    class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                Belum ada pernikahan. <a href="{{ route('admin.weddings.create') }}"
                                    class="text-blue-600 hover:underline">Buat yang baru</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $weddings->links() }}
        </div>
    </div>
@endsection

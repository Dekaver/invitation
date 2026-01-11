@extends('admin.layout')

@section('title', 'Daftar Tamu - ' . $wedding->groom_name . ' & ' . $wedding->bride_name)

@section('admin-content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Daftar Tamu</h2>
                <p class="text-gray-600 mt-1">{{ $wedding->groom_name }} & {{ $wedding->bride_name }}</p>
            </div>
            <div class="space-x-3">
                <a href="{{ route('admin.weddings.guests.create', $wedding->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-block">
                    + Tambah Tamu
                </a>
                <a href="{{ route('admin.weddings.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg inline-block">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Total Tamu</p>
                <p class="text-3xl font-bold text-gray-900">{{ $guests->total() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Akan Datang</p>
                <p class="text-3xl font-bold text-green-600">{{ $wedding->guests()->where('rsvp_status', 'yes')->count() }}
                </p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Tidak Datang</p>
                <p class="text-3xl font-bold text-red-600">{{ $wedding->guests()->where('rsvp_status', 'no')->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Mungkin</p>
                <p class="text-3xl font-bold text-yellow-600">
                    {{ $wedding->guests()->where('rsvp_status', 'maybe')->count() }}</p>
            </div>
        </div>

        <!-- Tabel Tamu -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Nama Tamu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Telepon
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Status RSVP
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Jumlah Tamu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Link RSVP
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($guests as $guest)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $guest->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $guest->phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($guest->rsvp_status === 'yes')
                                    <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800 font-medium">
                                        ✓ Akan Datang
                                    </span>
                                @elseif ($guest->rsvp_status === 'no')
                                    <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800 font-medium">
                                        ✗ Tidak Datang
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800 font-medium">
                                        ? Mungkin
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $guest->total_guest ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <code
                                    class="bg-gray-100 px-2 py-1 rounded text-xs">{{ substr($guest->uuid, 0, 8) }}...</code>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                <a href="{{ route('admin.weddings.guests.edit', [$wedding->id, $guest->id]) }}"
                                    class="text-blue-600 hover:text-blue-900 font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('admin.weddings.guests.destroy', [$wedding->id, $guest->id]) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus tamu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Belum ada tamu. <a href="{{ route('admin.weddings.guests.create', $wedding->id) }}"
                                    class="text-blue-600 hover:underline">Tambah tamu</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $guests->links() }}
        </div>
    </div>
@endsection

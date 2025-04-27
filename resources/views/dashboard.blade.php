@section('title', 'Dashboard - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <!-- Modern Header -->
        <div class="flex items-center bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-lg shadow mb-6">
            <img src="{{ asset('app.svg') }}" alt="Logo" class="h-16 w-16 rounded-full bg-white p-2 shadow mr-4">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-white text-sm">Terakhir login: {{ Auth::user()->last_login_at ?? 'Belum pernah login' }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Ekstrakurikuler Aktif -->
                <div class="bg-white rounded-lg shadow p-6 flex items-center">
                    <div class="bg-blue-500 p-3 rounded-full mr-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Ekstrakurikuler Aktif</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $ekskul }}</div>
                    </div>
                </div>
                <!-- Tambahkan card statistik lain di sini jika ada -->
            </div>

            <!-- Berita Terbaru -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Berita Terbaru</h3>
                <div class="space-y-4">
                    @foreach ($berita as $b)
                        <div class="border-b pb-3">
                            <h5 class="font-semibold text-blue-600">{{ $b->judul }}</h5>
                            <p class="text-gray-700">{{ Str::limit($b->konten, 100) }}</p>
                            <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                <i class="fas fa-user"></i> {{ $b->user->name ?? 'Tidak diketahui' }}
                                <i class="fas fa-calendar-alt ml-3"></i> {{ $b->created_at->format('d-m-Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

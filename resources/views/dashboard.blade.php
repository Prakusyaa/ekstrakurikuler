@section('title', 'Dashboard - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-lg shadow mb-6">
            <img src="{{ asset('person.svg') }}" alt="Logo" class="h-14 w-14 rounded-full bg-white p-2 shadow mr-4">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-white text-sm">Role: {{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->role === 'admin')
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total User -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-blue-500 p-3 rounded-full mr-4">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Total User</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</div>
                        </div>
                    </div>

                    <!-- User Terverifikasi -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-green-500 p-3 rounded-full mr-4">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">User Terverifikasi</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $verifiedUsers }}</div>
                        </div>
                    </div>

                    <!-- User Belum Terverifikasi -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-yellow-500 p-3 rounded-full mr-4">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">User Belum Terverifikasi</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $unverifiedUsers }}</div>
                        </div>
                    </div>

                    <!-- Total Ekstrakurikuler -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-indigo-500 p-3 rounded-full mr-4">
                            <i class="fas fa-school text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Total Ekstrakurikuler</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $totalEkstrakurikuler }}</div>
                        </div>
                    </div>
                </div>

                <!-- Role Distribution -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Admin -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-purple-500 p-3 rounded-full mr-4">
                            <i class="fas fa-user-shield text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Admin</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $adminUsers }}</div>
                        </div>
                    </div>

                    <!-- Guru -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-blue-500 p-3 rounded-full mr-4">
                            <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Guru</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $guruUsers }}</div>
                        </div>
                    </div>

                    <!-- Siswa -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-green-500 p-3 rounded-full mr-4">
                            <i class="fas fa-user-graduate text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Siswa</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $siswaUsers }}</div>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'guru')
                <!-- Stats Grid for Guru -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Total Ekstrakurikuler -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-indigo-500 p-3 rounded-full mr-4">
                            <i class="fas fa-school text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Total Ekstrakurikuler</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $totalEkstrakurikuler }}</div>
                        </div>
                    </div>

                    <!-- Total Berita -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-blue-500 p-3 rounded-full mr-4">
                            <i class="fas fa-newspaper text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Total Berita</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $totalNews }}</div>
                        </div>
                    </div>

                    <!-- Berita Saya -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-green-500 p-3 rounded-full mr-4">
                            <i class="fas fa-user-edit text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Berita Saya</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $userNews }}</div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Stats Grid for Siswa -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Ekstrakurikuler yang Diikuti -->
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="bg-blue-500 p-3 rounded-full mr-4">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Ekstrakurikuler yang Diikuti</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $userEkstrakurikuler }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Berita Terbaru -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Berita Terbaru</h3>
                <div class="space-y-4">
                    @forelse ($userNews ?? $latestNews as $news)
                        <div class="border-b pb-3">
                            <h5 class="font-semibold text-blue-600">{{ $news->judul }}</h5>
                            <p class="text-gray-700">{{ Str::limit($news->konten, 100) }}</p>
                            <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                <i class="fas fa-user"></i> {{ $news->user->name ?? 'Tidak diketahui' }}
                                <i class="fas fa-calendar-alt ml-3"></i> {{ $news->created_at->format('d-m-Y') }}
                                <i class="fas fa-school ml-3"></i> {{ $news->ekstrakurikuler->nama ?? 'Tidak diketahui' }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            <i class="fas fa-newspaper text-4xl mb-2"></i>
                            <p>Tidak ada berita yang tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


@section('title', 'Ekstrakurikuler Saya - EkstrakurikulerKu.id')

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-lg shadow mb-6">
            <img src="{{ asset('app.svg') }}" alt="Logo" class="h-14 w-14 rounded-full bg-white p-2 shadow mr-4">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Ekstrakurikuler Saya</h2>
                <p class="text-white text-sm">Daftar ekstrakurikuler yang Anda ikuti</p>
            </div>
        </div>
    </x-slot>

    @if($ekstrakurikuler->isEmpty())
        <div class="text-center mt-8">
            <p class="text-gray-500 mb-4">Anda belum mengikuti ekstrakurikuler apapun.</p>
            <a href="{{ route('ekstrakurikuler') }}" class="btn btn-primary">Lihat Daftar Ekstrakurikuler</a>
        </div>
    @endif

    <!-- Card Section -->
    <div class="container mx-auto mt-8 mb-12 px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($ekstrakurikuler as $ekskul)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-blue-500 p-4">
                        <div class="flex items-center">
                            <div class="bg-white p-2 rounded-full mr-3">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                            <h5 class="text-xl font-bold text-white truncate">{{ $ekskul->ekstrakurikuler->nama }}</h5>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <div class="mb-4">
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>
                                <span class="font-medium">G. Pembimbing:</span>
                            </div>
                            <p class="text-gray-800">{{ $ekskul->ekstrakurikuler->guru_pembimbing }}</p>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span class="font-medium">Deskripsi:</span>
                            </div>
                            <p class="text-gray-700 line-clamp-3">{{ $ekskul->ekstrakurikuler->deskripsi }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="flex flex-col gap-2">
                            <!-- Modal Keluar -->
                            <div class="modal fade" id="leaveModal{{ $ekskul->ekstrakurikuler->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin keluar dari ekstrakurikuler {{ $ekskul->ekstrakurikuler->nama }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('keluar.ekstrakurikuler', $ekskul->ekstrakurikuler->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Ya, Keluar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <button type="button" 
                                    class="btn btn-danger w-full flex items-center justify-center"
                                    data-bs-toggle="modal"
                                    data-bs-target="#leaveModal{{ $ekskul->ekstrakurikuler->id }}">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Keluar
                            </button>
                            <a href="{{ route('ekstrakurikuler.detail', $ekskul->ekstrakurikuler->id) }}" 
                               class="btn btn-primary w-full flex items-center justify-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .empty-state {
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-icon {
        color: #9CA3AF;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-primary {
        background-color: #2563EB;
        border-color: #2563EB;
    }

    .btn-primary:hover {
        background-color: #1D4ED8;
        border-color: #1D4ED8;
    }

    .btn-danger {
        background-color: #DC2626;
        border-color: #DC2626;
    }

    .btn-danger:hover {
        background-color: #B91C1C;
        border-color: #B91C1C;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .modal-header {
        border-bottom: 1px solid #E5E7EB;
        padding: 1rem 1.5rem;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1F2937;
    }

    .modal-body {
        padding: 1.5rem;
        color: #4B5563;
    }

    .modal-footer {
        border-top: 1px solid #E5E7EB;
        padding: 1rem 1.5rem;
    }

    .btn-close {
        opacity: 0.5;
        transition: opacity 0.2s ease;
    }

    .btn-close:hover {
        opacity: 0.75;
    }
</style>
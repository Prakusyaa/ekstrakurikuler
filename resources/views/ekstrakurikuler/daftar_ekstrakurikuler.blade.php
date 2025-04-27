@section('title', 'Ekstrakurikuler - EkstrakurikulerKu.id')

<x-app-layout>
    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="confirmForm" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Ya, Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus ekstrakurikuler <span id="deleteEkskulName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keluar -->
    <div class="modal fade" id="leaveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin keluar dari ekstrakurikuler <span id="leaveEkskulName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="leaveForm" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Ya, Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Gabung -->
    <div class="modal fade" id="joinModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin bergabung dengan ekstrakurikuler <span id="joinEkskulName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="joinForm" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Ya, Gabung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="header">
        <div class="flex items-center bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-lg shadow mb-6">
            <img src="{{ asset('group.svg') }}" alt="Logo" class="h-14 w-14 rounded-full bg-white p-2 shadow mr-4">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Daftar Ekstrakurikuler</h2>
                <p class="text-white text-sm">Daftar ekstrakurikuler yang tersedia</p>
            </div>
        </div>
    </x-slot>

    <div class="top-section">
        <!-- Search Box -->
        <form action="{{ route('ekstrakurikuler') }}" method="GET" class="search-form">
            <div class="search-container">
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" 
                       name="search" 
                       class="search-input" 
                       placeholder="Cari ekstrakurikuler..." 
                       value="{{ request('search') }}"
                       autocomplete="off">
                <button type="submit" class="search-submit">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
        
        @if($ekstrakurikuler->isEmpty())
            <p class="empty-message">Tidak ada ekstrakurikuler yang ditemukan.</p>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button onclick="window.location.href='{{ route('ekstrakurikuler') }}'" 
                    class="action-button refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
            @if (Auth::user()->role != 'siswa')
            <button onclick="window.location.href='{{ route('tambah') }}'" 
                    class="action-button add">
                <i class="fas fa-plus"></i>
            </button>
            @endif
        </div>
    </div>

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
                            <h5 class="text-xl font-bold text-white truncate">{{ $ekskul->nama }}</h5>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <div class="mb-4">
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>
                                <span class="font-medium">G. Pembimbing:</span>
                            </div>
                            <p class="text-gray-800">{{ $ekskul->guru_pembimbing }}</p>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span class="font-medium">Deskripsi:</span>
                            </div>
                            <p class="text-gray-700 line-clamp-3">{{ $ekskul->deskripsi }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="flex flex-col gap-2">
                            @if (Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
                                <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" 
                                   class="btn btn-primary w-full flex items-center justify-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Detail
                                </a>
                                <button type="button" 
                                        class="btn btn-danger w-full flex items-center justify-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $ekskul->id }}">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus
                                </button>
                            @elseif (in_array($ekskul->id, $anggota))
                                <button type="button" 
                                        class="btn btn-danger w-full flex items-center justify-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaveModal{{ $ekskul->id }}">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Keluar
                                </button>
                                <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" 
                                   class="btn btn-primary w-full flex items-center justify-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Detail
                                </a>
                            @else
                                <button type="button" 
                                        class="btn btn-success w-full flex items-center justify-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#joinModal{{ $ekskul->id }}">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Bergabung
                                </button>
                                <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" 
                                   class="btn btn-primary w-full flex items-center justify-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Detail
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus -->
                <div class="modal fade" id="deleteModal{{ $ekskul->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus ekstrakurikuler {{ $ekskul->nama }}?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('ekstrakurikuler.destroy', $ekskul->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Keluar -->
                <div class="modal fade" id="leaveModal{{ $ekskul->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin keluar dari ekstrakurikuler {{ $ekskul->nama }}?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('keluar.ekstrakurikuler', $ekskul->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Ya, Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Gabung -->
                <div class="modal fade" id="joinModal{{ $ekskul->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin bergabung dengan ekstrakurikuler {{ $ekskul->nama }}?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('gabung.ekstrakurikuler', $ekskul->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Ya, Gabung</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<style>
    /* Header Styles */
    .header-container {
        display: flex;
        align-items: center;
        background: linear-gradient(to right, #2563EB, #60A5FA);
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .header-logo {
        height: 3.5rem;
        width: 3.5rem;
        border-radius: 50%;
        background-color: white;
        padding: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-right: 1rem;
    }

    .header-content {
        color: white;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .header-subtitle {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    /* Top Section Styles */
    .top-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
        margin-top: 2rem;
        gap: 1rem;
    }

    /* Search Form Styles */
    .search-form {
        flex: 1;
        max-width: 500px;
    }

    .search-container {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
    }

    .search-input {
        width: 100%;
        height: 2.75rem;
        padding-left: 2.5rem;
        padding-right: 2.5rem;
        border-radius: 0.5rem;
        border: 1px solid #E5E7EB;
        font-size: 0.95rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: #2563EB;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .search-submit {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #2563EB;
        transition: color 0.2s ease;
    }

    .search-submit:hover {
        color: #1D4ED8;
    }

    /* Action Buttons Styles */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .action-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        background-color: white;
        border-radius: 0.5rem;
        border: 1px solid #E5E7EB;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
        color: #4B5563;
    }

    .action-button:hover {
        background-color: #F3F4F6;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        color: #2563EB;
    }

    /* Card Styles */
    .card-container {
        padding: 0 2rem;
        margin: 2rem 0;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
    }

    @media (min-width: 768px) {
        .card-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .card-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: #2563EB;
        padding: 1rem;
    }

    .card-header-content {
        display: flex;
        align-items: center;
    }

    .card-icon {
        background-color: white;
        padding: 0.5rem;
        border-radius: 50%;
        margin-right: 0.75rem;
    }

    .card-icon i {
        color: #2563EB;
        font-size: 1.25rem;
    }

    .card-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-section {
        margin-bottom: 1.5rem;
    }

    .card-label {
        display: flex;
        align-items: center;
        color: #6B7280;
        margin-bottom: 0.5rem;
    }

    .card-label i {
        margin-right: 0.5rem;
    }

    .card-text {
        color: #1F2937;
        margin: 0;
    }

    .card-description {
        color: #4B5563;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    /* Button Styles */
    .button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .button:hover {
        transform: translateY(-2px);
    }

    .button i {
        margin-right: 0.5rem;
    }

    .button-primary {
        background-color: #2563EB;
        color: white;
    }

    .button-primary:hover {
        background-color: #1D4ED8;
    }

    .button-danger {
        background-color: #DC2626;
        color: white;
    }

    .button-danger:hover {
        background-color: #B91C1C;
    }

    .button-success {
        background-color: #059669;
        color: white;
    }

    .button-success:hover {
        background-color: #047857;
    }

    /* Empty State */
    .empty-message {
        text-align: center;
        margin-top: 1rem;
        color: #6B7280;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
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

    .btn-success {
        background-color: #059669;
        border-color: #059669;
    }

    .btn-success:hover {
        background-color: #047857;
        border-color: #047857;
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
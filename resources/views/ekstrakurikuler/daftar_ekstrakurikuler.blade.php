@section('title', 'Ekstrakurikuler - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ekstrakurikuler') }}
        </h2>
    </x-slot>

    <div class="top-section">
        <!-- Search Box -->
        <form action="{{ route('ekstrakurikuler') }}" method="GET" class="search-box shadow rounded">
            <div class="input-group">
                <input type="text" autocomplete="off" name="search" class="form-control" placeholder="Cari ekstrakurikuler..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">
                    <img class="icon" src="{{ asset('img/search.webp') }}" alt="Search" width="20">
                </button>
            </div>
        </form>
        
        @if($ekstrakurikuler->isEmpty())
            <p class="text-center mt-4">Tidak ada ekstrakurikuler yang ditemukan.</p>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            @if (Auth::user()->role == 'siswa')
            <div class="btn-icon refresh shadow rounded" onclick="window.location.href='{{ route('ekstrakurikuler') }}'">
                <img src="{{ asset('img/refresh.webp') }}" alt="Refresh"> 
            </div>
            @else
            <div class="btn-icon refresh shadow rounded" onclick="window.location.href='{{ route('ekstrakurikuler') }}'">
                <img src="{{ asset('img/refresh.webp') }}" alt="Refresh"> 
            </div>
            <div class="btn-icon add shadow rounded" onclick="window.location.href='{{ route('tambah') }}'">
                <img src="{{ asset('img/add.webp') }}" alt="Add"> 
            </div>
            @endif
        </div>
    </div>

    <!-- Card Section -->
    <div class="card-section container-fluid mt-4 mb-5">
        <div class="row g-4">
            @foreach ($ekstrakurikuler as $ekskul)
                <div class="col-md-4">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $ekskul->nama }}</b></h5>
                            <p class="card-subtitle"><b>G. Pembimbing: {{ $ekskul->guru_pembimbing }}</b></p>
                            <p class="card-text mt-1 mb-2">{{ Str::limit($ekskul->deskripsi, 100, '...') }}</p>

                            @if (Auth::user()->role == 'guru')
                                <div class="button-group">
                                    <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" class="btn btn-primary mt-1 w-100">Detail</a>
                                    <form action="{{ route('ekstrakurikuler.destroy', $ekskul->id) }}" method="POST" class="hapus mt-1 w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')">Hapus</button>
                                    </form>
                                </div>
                            @elseif (in_array($ekskul->id, $anggota))
                                <button type="button" class="btn btn-danger mt-3 w-100" data-bs-toggle="modal" data-bs-target="#keluarModal{{ $ekskul->id }}">
                                    Keluar
                                </button>
                                <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" class="btn btn-primary mt-1">Detail</a>
                            @else
                                <button type="button" class="btn btn-success mt-3 w-100" data-bs-toggle="modal" data-bs-target="#gabungModal{{ $ekskul->id }}">
                                    Bergabung
                                </button>
                                <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" class="btn btn-primary mt-1">Detail</a>
                            @endif
                        </div>
                    </div>
                </div>  

                <!-- Modal for Leaving -->
                <div class="modal fade" id="keluarModal{{ $ekskul->id }}" tabindex="-1" aria-labelledby="keluarModalLabel{{ $ekskul->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="keluarModalLabel{{ $ekskul->id }}">Konfirmasi Keluar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin keluar dari ekstrakurikuler {{ $ekskul->nama }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('keluar.ekstrakurikuler', $ekskul->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Ya, Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Joining -->
                <div class="modal fade" id="gabungModal{{ $ekskul->id }}" tabindex="-1" aria-labelledby="gabungModalLabel{{ $ekskul->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gabungModalLabel{{ $ekskul->id }}">Konfirmasi Bergabung</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin bergabung dengan ekstrakurikuler {{ $ekskul->nama }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('gabung.ekstrakurikuler', $ekskul->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Ya, Bergabung</button>
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
    .top-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
        margin-top: 2rem;
    }

    .search-box {
        display: flex;
        align-items: center;
        width: 400px;
        height: 60px;
        background-color: #FFFFFF;
        padding: 10px;
    }

    .btn-outline-primary {
        border-color: grey !important;
        transition: filter 0.3s ease;
    }

    .btn-outline-primary:hover {
        border-color: #2563EB !important;
    }

    .icon {
        filter: invert(0);
        transition: filter 0.3s ease;
    }

    .btn-outline-primary:hover .icon {
        filter: invert(1);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-icon:hover {
        background-color: #2563EB;
    }

    .btn-icon img {
        width: 22px;
        transition: filter 0.3s ease;
    }

    .btn-icon:hover img {
        filter: invert(1);
    }

    .card-section {
        padding: 0 2rem !important;
        padding-bottom: 2rem;
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
        border: none !important;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
    }

    .card-title {
        font-size: 25px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.5rem;
    }

    .card-subtitle {
        font-size: 16px;
        color: #6B7280;
        margin-bottom: 1rem;
    }

    .card-text {
        flex-grow: 1;
        margin-bottom: 1.5rem;
        color: #4B5563;
        line-height: 1.5;
    }

    .button-group {
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .button-group .btn {
        width: 100%;
    }

    .hapus {
        margin: 0;
    }

    .hapus button {
        white-space: nowrap;
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        border-bottom: 1px solid #E5E7EB;
    }

    .modal-footer {
        border-top: 1px solid #E5E7EB;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-form');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')) {
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus card dari DOM
                        const card = this.closest('.col-md-4');
                        card.remove();
                        
                        // Tampilkan pesan sukses
                        alert('Ekstrakurikuler berhasil dihapus');
                        
                        // Jika tidak ada card lagi, tampilkan pesan
                        const remainingCards = document.querySelectorAll('.col-md-4');
                        if (remainingCards.length === 0) {
                            const cardSection = document.querySelector('.card-section .row');
                            cardSection.innerHTML = '<div class="col-12"><p class="text-center mt-4">Tidak ada ekstrakurikuler yang ditemukan.</p></div>';
                        }
                    } else {
                        alert('Gagal menghapus ekstrakurikuler');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus ekstrakurikuler');
                });
            }
        });
    });
});
</script>
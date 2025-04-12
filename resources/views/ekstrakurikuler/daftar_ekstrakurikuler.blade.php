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
                            <p class="card-text mt-1">{{ Str::limit($ekskul->deskripsi, 100, '...') }}</p>

                            @if (Auth::user()->role == 'guru')
                                <br>
                            @elseif (in_array($ekskul->id, $anggota))
                                <form action="{{ route('keluar.ekstrakurikuler', $ekskul->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-3 w-100">Keluar</button>
                                </form>
                            @else
                                <form action="{{ route('gabung.ekstrakurikuler', $ekskul->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success mt-3 w-100">Bergabung</button>
                                </form>
                            @endif

                            <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" class="btn btn-primary mt-1">Detail</a>
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
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 25px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
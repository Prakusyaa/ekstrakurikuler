@section('title', 'Ekskul yang Diikuti - SMKN 5 SKA')

<style>
    .card-container {
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
        display: block;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ekstrakurikuler yang diikuti oleh') }} {{ ucfirst(Auth::user()->name) }}
        </h2>
    </x-slot>

    @if ($ekstrakurikuler->isEmpty())
        <p>Kamu belum mengikuti ekstrakurikuler mana pun.</p>
    @else
        <div class="card-container container-fluid mt-4 mb-5">
            <div class="row g-4">
                @foreach ($ekstrakurikuler as $anggota)
                    <div class="col-md-4">
                        <div class="card shadow rounded">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $anggota->ekstrakurikuler->nama }}</b></h5>
                                <p class="card-guru"><b>G. Pembimbing: {{ $anggota->ekstrakurikuler->guru_pembimbing }}</b></p>
                                <p class="card-description mt-1">{{ Str::limit($anggota->ekstrakurikuler->deskripsi, 100, '...') }}</p>
                                <form action="{{ route('keluar.ekstrakurikuler', $anggota->ekstrakurikuler->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-3 w-100">Keluar</button>
                                </form>    
                                <a href="{{ route('ekstrakurikuler.detail', $anggota->ekstrakurikuler->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>  
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
@section('title', 'Ekstrakurikuler - SMKN 5 SKA')

<style>
    .search-refresh-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
        margin-top: 2rem;
    }

    /* search box */
    .search-container {
        display: flex;
        align-items: center;
        width: 400px;
        height: 60px;
        background-color: #FFFFFF;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .search-button {
        border-color: grey !important;
        transition: filter 0.3s ease;
    }

    .search-button:hover {
        border-color: #2563EB !important;
    }

    .search-icon {
        filter: invert(0);
        transition: filter 0.3s ease;
    }

    .search-button:hover .search-icon {
        filter: invert(1);
    }

    /* refresh button */
    .refresh-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #FFFFFF;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .refresh-container:hover {
        background-color: #2563EB;
    }

    .refresh-container img {
        width: 22px;
        transition: filter 0.3s ease;
    }

    .refresh-container:hover img {
        filter: invert(1);
    }

    /* card */
    .card-container{
        padding: 0 2rem !important;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ekstrakurikuler') }}
        </h2>
    </x-slot>

    <div class="search-refresh-wrapper">
        <!-- search box -->
        <div class="search-container rounded">
            <div class="input-group">
                <input type="text" class="form-control rounded-start" placeholder="Cari ekstrakurikuler..." aria-label="Search">
                <button class="search-button btn btn-outline-primary">
                    <img class="search-icon" src="{{ asset('img/search.webp') }}" alt="Search" width="20">
                </button>
            </div>
        </div>

        <!-- refresh button -->
        <div class="refresh-container" onclick="location.reload();">
            <img src="{{ asset('img/refresh.webp') }}" alt="Refresh">
        </div>
    </div>

    <!-- card container -->
    <div class="card-container container-fluid mt-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body">
                        <h5 class="card-title">Ekstrakurikuler 1</h5>
                        <p class="card-text"></p>
                        <a href="" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body">
                        <h5 class="card-title">Ekstrakurikuler 2</h5>
                        <p class="card-text"></p>
                        <a href="" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body">
                        <h5 class="card-title">Ekstrakurikuler 3</h5>
                        <p class="card-text"></p>
                        <a href="" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('title', 'Ekstrakulikuler - SMKN 5 SKA')

<style>
    .search-container {
        display: flex;
        align-items: center;
        justify-content: start;
        width: 400px;
        height: 60px;
        background-color: #FFFFFF;
        margin-left: 2rem;
        margin-top: 2rem;
        padding: 10px;
    }

    .search-box {
        width: 330px;
        height: 30px;
        margin-top: 7px;
    }

    .search-button {
        border-color: grey !important;
    }

    .search-icon {
        filter: invert(0);
        transition: filter 0.3s ease;
    }

    .search-button:hover .search-icon {
        filter: invert(1);
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ekstrakulikuler') }}
        </h2>
    </x-slot>

    <!--
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::user()->role == 'admin')
                        <h1>Selamat datang admin</h1>
                        @elseif (Auth::user()->role == 'guru')
                        <h1>Selamat Datang  {{ Auth::user()->name }}</h1>
                        @elseif (Auth::user()->role == 'siswa')
                        <h1>Selamat Datang {{ Auth::user()->name }}</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    //-->

    <div class="search-container shadow rounded p-2">
        <div class="input-group">
            <input type="text" class="form-control rounded-start" placeholder="Cari ekstrakurikuler..." aria-label="Search">
            <button class="search-button btn btn-outline-primary">
                <img class="search-icon" src="{{ asset('img/search.webp') }}" alt="Search" width="20">
            </button>                    
        </div>
    </div>    
    
</x-app-layout>
@section('title', 'Ekstrakulikuler - SMKN 5 SKA')

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
     <body class="font-sans antialiased">
       <div class="page-container">

        {{-- Memanggil Sidebar --}}
        @include('partials.sidebar')

        <div class="main-content">

            {{-- Memanggil Header --}}
            @include('partials.header')

            {{-- Konten Utama yang berubah-ubah (Dashboard, Karyawan, dll) --}}
            <main class="dashboard-content">
                {{ $slot }}
            </main>

        </div>
    </div>

    {{-- POP UP NOTIFICATION RIGHT --}}
    @if(session('success') || session('with_danger'))
    <div x-data="{ showToast: true }" 
         x-init="setTimeout(() => showToast = false, 4000)"
         x-show="showToast"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         class="fixed top-6 right-6 z-[999999] flex items-center w-full max-w-xs p-4 space-x-3 text-gray-700 bg-white rounded-xl shadow-xl border-l-4 {{ session('success') ? 'border-green-500' : 'border-red-500' }}" 
         role="alert">
        
        <div class="inline-flex items-center justify-center flex-shrink-0 w-9 h-9 rounded-lg {{ session('success') ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
            <i class="fa-solid {{ session('success') ? 'fa-check' : 'fa-trash-can' }} text-lg"></i>
        </div>
        
        <div class="ml-3 text-sm font-bold text-gray-800">
            {{ session('success') ?? session('with_danger') }}
        </div>
        
        <button type="button" @click="showToast = false" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    @stack('scripts')
    </body>
</html>

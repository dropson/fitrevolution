<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fit Revolution') }}</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css"> --}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 bg-gray-100 antialiased" data-success="{{ session('success') }}" data-error="{{ session('error') }}">

    <div class="flex flex-col min-h-screen">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        @include('layouts.partials.header')

        <main class="flex-grow p-12 overflow-auto ">
            {{ $slot }}
        </main>
       
        @include('layouts.partials.footer')
    </div>
</body>

</html>

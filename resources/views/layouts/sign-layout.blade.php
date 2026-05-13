<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Sign In' }} | SIMRS - RSUD H. Abdul Manap</title>

    <!-- Sign page assets -->
    @vite(['resources/css/sign.css', 'resources/js/sign.js'])
</head>

<body x-data="{ 'loaded': true }" class="sign-layout">
    <x-common.preloader />

    @yield('content')
</body>

@stack('scripts')

</html>

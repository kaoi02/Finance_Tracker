@php
    $theme = \App\Models\Setting::get('theme', 'system');
    $currency = \App\Models\Setting::get('currency', 'RM');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ $theme === 'dark' ? 'dark' : ($theme === 'light' ? '' : '') }}" x-data="{ theme: '{{ $theme }}' }"
    :class="{ 'dark': theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
    @theme-updated.window="theme = $event.detail.theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234F46E5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><rect width='20' height='14' x='2' y='5' rx='2'/><line x1='2' x2='22' y1='10' y2='10'/><line x1='7' x2='7' y1='15' y2='15'/><line x1='11' x2='11' y1='15' y2='15'/></svg>">

    <!-- Google Fonts: Urbanist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Urbanist', sans-serif;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="bg-white dark:bg-gray-950 text-gray-900 dark:text-white selection:bg-primary selection:text-white relative">
    <!-- Gradient Background -->
    <div aria-hidden="true"
        class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20 pointer-events-none z-0">
        <div class="blur-[106px] h-56 bg-gradient-to-br from-primary to-purple-400 dark:from-blue-700"></div>
        <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-400 to-sky-300 dark:to-indigo-600"></div>
    </div>

    <x-app-header />

    <main class="space-y-40 mb-20 pt-24 relative z-10">
        <x-container>
            {{ $slot }}
        </x-container>
    </main>

    <x-app-footer />

    <x-toast />
    @livewireScripts
</body>

</html>
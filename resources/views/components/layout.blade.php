<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <main>
            <header>
                {{ $header }}
            </header>

            <div class="mx-auto px-4 sm:px-6 pb-12 max-w-5xl">
                {{ $slot }}
            </div>

            <footer class="text-center py-6 sm:py-8 mt-12 sm:mt-16">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-white/60 backdrop-blur-sm rounded-full shadow-sm border border-white/20">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-xs sm:text-sm text-slate-600 font-medium">Last updated: {{ date('F Y') }}</span>
                </div>
            </footer>
        </main>
    </body>
</html>

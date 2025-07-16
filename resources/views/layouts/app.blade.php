<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Stampede - Digital Bulletin Board')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dost-light min-h-screen">
    <header class="bg-dost-dark shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">
                    <a href="{{ route('wall') }}">Stampede</a>
                </h1>
                <nav>
                    <a href="{{ route('wall') }}" class="text-white hover:text-dost-blue mr-4">Wall</a>
                    <a href="{{ route('create-stamp') }}"
                        class="bg-dost-blue text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Create Stamp
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-dost-dark text-white text-center py-4 mt-8">
        <p>&copy; 2025 Stampede - Digital Bulletin Board</p>
    </footer>
</body>

</html>
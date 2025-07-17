<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'STAMPede')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-mono bg-dost-light">
    <div class="flex min-h-screen">
        <!-- Left Section -->
        <div class="fixed top-0 left-0 z-10 flex flex-col items-end w-[45%] h-screen px-4 py-12">
            <!-- Stampede Title -->
            <div class="flex items-center justify-center flex-1 p-0 m-0">
                <div class="origin-center transform rotate-90 translate-x-[7rem]">
                    <h1 class="text-[10rem] font-extrabold leading-[0.8] text-dost-blue tracking-wider m-0 p-0">
                        STAMP
                    </h1>
                    <h1 class="text-[10rem] font-extrabold leading-[0.8] text-dost-dark tracking-wider m-0 p-0">
                        EDE
                    </h1>
                </div>
            </div>

            <!-- Subtitle -->
            <div class="w-full mb-8 text-right">
                <p class="text-sm font-medium leading-snug tracking-wide text-gray-600">
                    Write it. Post it.<br>
                    Let the people see it.
                </p>
            </div>

            <!-- Navigation -->
            <nav class="mb-3 space-x-3">
                <a href="{{ route('wall') }}" 
                   class="text-dost-dark hover:text-dost-blue text-lg font-bold tracking-wide transition-colors duration-200 {{ request()->routeIs('wall') ? 'text-dost-blue' : '' }}">
                    WALL
                </a>
                <a href="{{ route('create-stamp') }}"
                   class="bg-dost-white text-dost-blue px-6 py-3 text-lg font-bold tracking-wide hover:bg-dost-blue hover:text-dost-light transition-colors duration-200 border-2 border-dost-blue {{ request()->routeIs('create-stamp') ? 'bg-blue-600' : '' }}">
                    CREATE
                </a>
            </nav>
        </div>

        <!-- Right Content Area -->
        <div class="ml-[45%] w-[55%] overflow-y-auto h-screen">
            <main class="py-8 pl-4 pr-64">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle (for responsive behavior) -->
    <div class="fixed z-50 md:hidden top-4 left-4">
        <button id="mobile-menu-toggle" class="p-2 text-white rounded bg-dost-dark">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden md:hidden bg-dost-dark bg-opacity-95">
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <div class="text-center">
                <h1 class="mb-2 text-3xl font-bold tracking-wider text-white">
                    STAMP
                </h1>
                <h1 class="text-3xl font-bold tracking-wider text-white">
                    EDE
                </h1>
            </div>
            
            <nav class="space-y-6 text-center">
                <a href="{{ route('wall') }}" 
                   class="block text-xl font-bold tracking-wide text-white transition-colors duration-200 hover:text-dost-blue">
                    WALL
                </a>
                <a href="{{ route('create-stamp') }}"
                   class="block px-8 py-4 text-xl font-bold tracking-wide text-white transition-colors duration-200 border-2 bg-dost-blue hover:bg-blue-600 border-dost-blue">
                    CREATE
                </a>
            </nav>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            
            if (mobileToggle && mobileSidebar) {
                mobileToggle.addEventListener('click', function() {
                    mobileSidebar.classList.toggle('hidden');
                });
                
                // Close mobile menu when clicking outside
                mobileSidebar.addEventListener('click', function(e) {
                    if (e.target === mobileSidebar) {
                        mobileSidebar.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
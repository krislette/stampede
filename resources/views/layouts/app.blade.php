<!-- ======================================================================
SYSTEM NAME: STAMPede
PURPOSE: Controller for stamp creation, display, and management
PROGRAMMER: Acelle Krislette L. Rosales
COPYRIGHT: © 2025 ITD. All rights reserved.
====================================================================== -->

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
    {{-- Layout logic based on current route --}}
    @if (request()->routeIs('create-stamp') || request()->routeIs('edit-stamp'))
        <!-- Full layout for create/edit -->
        <div class="min-h-screen">
            <main class="container px-4 py-8 mx-auto">
                @yield('content')
            </main>
        </div>
    @else
        <div class="flex min-h-screen">
            <!-- Left Section -->
            <div class="fixed top-0 left-0 z-10 flex flex-col items-end w-[35%] h-screen px-4 py-12">

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
                       class="bg-dost-light text-dost-blue px-6 py-3 text-lg font-bold tracking-wide hover:bg-dost-blue hover:text-dost-light transition-colors duration-200 border-2 border-dost-blue {{ request()->routeIs('create-stamp') ? 'bg-blue-600' : '' }}">
                        POST
                    </a>
                </nav>
            </div>

            <!-- Right Content Area -->
            <div class="ml-[35%] w-[65%] overflow-y-auto h-screen">
                <main class="py-8 pl-4 pr-56">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="fixed z-50 md:hidden top-4 left-4">
            <button id="mobile-menu-toggle" class="p-2 text-white rounded bg-dost-dark">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden md:hidden bg-dost-dark bg-opacity-95">
            <div class="flex flex-col items-center justify-center h-full space-y-8">
                <div class="text-center">
                    <h1 class="mb-2 text-3xl font-bold tracking-wider text-white">STAMP</h1>
                    <h1 class="text-3xl font-bold tracking-wider text-white">EDE</h1>
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
    @endif

    <!-- Toast Message Container -->
    <div id="toast" class="fixed flex items-center gap-2 px-4 py-3 text-sm transition-opacity duration-300 opacity-0 z-[9999] bottom-5 right-5 border">
        <span id="toast-message">Message</span>
    </div>

    <script>
        /**
         * Toggle mobile menu visibility
         */
        document.addEventListener('DOMContentLoaded', function () {
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileSidebar = document.getElementById('mobile-sidebar');

            if (mobileToggle && mobileSidebar) {
                mobileToggle.addEventListener('click', function () {
                    mobileSidebar.classList.toggle('hidden');
                });

                // Close menu when clicking outside
                mobileSidebar.addEventListener('click', function (e) {
                    if (e.target === mobileSidebar) {
                        mobileSidebar.classList.add('hidden');
                    }
                });
            }
        });

        /**
         * Show global toast message
         * @param {string} message
         * @param {boolean} isError
         */
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            const messageEl = document.getElementById('toast-message');

            messageEl.textContent = message;

            toast.classList.remove(
                'bg-dost-blue', 'border-dost-blue',
                'bg-dost-dark', 'border-dost-dark',
                'text-dost-light', 'text-dost-blue'
            );

            if (isError) {
                toast.classList.add('bg-dost-dark', 'border-dost-dark', 'text-dost-light');
            } else {
                toast.classList.add('bg-dost-blue', 'border-dost-blue', 'text-dost-light');
            }

            toast.classList.remove('opacity-0');
            toast.classList.add('opacity-100');

            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0');
            }, 3000);
        }
    </script>
</body>
</html>

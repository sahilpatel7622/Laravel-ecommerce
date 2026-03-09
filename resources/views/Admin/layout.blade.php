<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Gray 100 */
        }
    </style>
    
    @stack('styles')
</head>
<body class="flex h-screen overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }">

    <!-- Sidebar -->
    @include('Admin.partials.sidebar')

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 md:hidden" x-transition.opacity style="display: none;"></div>

    <!-- Main Content Wrapper -->
    <div class="flex flex-col flex-1 w-full overflow-hidden">
        
        <!-- Top Navbar -->
        @include('Admin.partials.header')

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto bg-gray-50 focus:outline-none">
            <div class="px-6 py-8 mx-auto max-w-7xl">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>

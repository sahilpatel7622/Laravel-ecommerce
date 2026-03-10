<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-indigo-900 text-white transition-transform duration-300 ease-in-out md:static md:translate-x-0 flex flex-col shadow-xl">
    
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center h-16 bg-indigo-950 border-b border-indigo-800">
        <span class="text-2xl font-extrabold tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-200"><a href="/admin/dashboard">The E-Comm Admin</a></span>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-100 bg-indigo-800' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-lg group transition-colors">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>
        
        <a href="{{ route('admin.products') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.products') || request()->routeIs('admin.products.*') ? 'text-indigo-100 bg-indigo-800' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-lg group transition-colors">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.products') || request()->routeIs('admin.products.*') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <span class="font-medium">Products</span>
        </a>

        <a href="{{ route('admin.orders') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.orders') || request()->routeIs('admin.orders.*') ? 'text-indigo-100 bg-indigo-800' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-lg group transition-colors">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.orders') || request()->routeIs('admin.orders.*') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <span class="font-medium">Orders</span>
        </a>

        <a href="{{ route('admin.payments') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.payments') || request()->routeIs('admin.payments.*') ? 'text-indigo-100 bg-indigo-800' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-lg group transition-colors">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.payments') || request()->routeIs('admin.payments.*') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
            <span class="font-medium">Payments</span>
        </a>

        <a href="{{ route('admin.categories') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.categories') || request()->routeIs('admin.categories.*') ? 'text-indigo-100 bg-indigo-800' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-lg group transition-colors">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.categories') || request()->routeIs('admin.categories.*') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5a1.99 1.99 0 0 1 1.414.586l7 7a2 2 0 0 1 0 2.828l-7 7a2 2 0 0 1-2.828 0l-7-7A1.994 1.994 0 0 1 3 12V7a4 4 0 0 1 4-4z" />
            </svg>
            <span class="font-medium">Categories</span>
        </a>

        <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users') ? 'text-indigo-100 bg-indigo-800' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-lg group transition-colors">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="font-medium">Users</span>
        </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 bg-indigo-950 border-t border-indigo-800">
        <a href="{{ route('admin.logout') }}" class="flex items-center px-4 py-2 text-sm text-indigo-200 hover:text-white transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
        </a>
    </div>
</aside>

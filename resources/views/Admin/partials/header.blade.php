<header class="flex items-center justify-between h-16 px-6 bg-white border-b shadow-sm z-30">
    <!-- Mobile Menu Toggle -->
    <button @click="sidebarOpen = true" class="p-1 mr-4 text-gray-500 rounded-lg md:hidden hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    
    <div class="flex-1 px-4 flex justify-end">
        
        <div class="ml-4 flex items-center md:ml-6">
            <!-- Profile dropdown -->
            <div class="relative ml-3" x-data="{ userMenuOpen: false }">
                <div>
                    <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" class="flex items-center text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        @php
                            $admin = \App\Models\Admin_usermodel::find(session('admin_id'));
                            $adminName = $admin ? $admin->name : 'Admin';
                            $adminInitial = strtoupper(substr($adminName, 0, 1));
                        @endphp
                        <span class="mr-3 font-medium text-gray-700 hidden md:block">{{ $adminName }}</span>
                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold border border-indigo-200">
                            {{ $adminInitial }}
                        </div>
                    </button>
                </div>
                
                <!-- Dropdown Menu -->
                <div x-show="userMenuOpen" x-transition.opacity class="absolute right-0 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" style="display: none;">
                    <div class="px-4 py-2 text-sm text-gray-900 border-b border-gray-100 font-semibold">{{ $adminName }}</div>
                    <div class="border-t border-gray-100"></div>
                    <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-red-600 font-medium" role="menuitem">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</header>

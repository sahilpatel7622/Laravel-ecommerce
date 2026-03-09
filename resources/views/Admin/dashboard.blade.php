@extends('Admin.layout')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4">

        <!-- Total Products (Purple) -->
        <div class="relative overflow-hidden bg-purple-600 rounded-xl shadow-sm transition-all hover:-translate-y-1">
            <div class="p-5 flex flex-col h-full bg-gradient-to-br from-purple-600 to-purple-800 relative z-10">
                <h3 class="text-xs font-bold text-purple-100 uppercase tracking-wider mb-1">Total Products</h3>
                <div class="text-3xl font-extrabold text-white mb-4">{{ $totalProducts }}</div>
                <a href="{{ route('admin.products') }}"
                    class="text-xs font-medium text-white hover:text-purple-100 mt-auto flex items-center justify-between border-t border-purple-400/30 pt-3">
                    View Details
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <!-- Background Icon -->
            <svg class="absolute -bottom-4 -right-4 w-24 h-24 text-purple-400/30 -rotate-12 transform" fill="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z">
                </path>
            </svg>
        </div>

        <!-- Total Orders (Blue) -->
        <div class="relative overflow-hidden bg-blue-600 rounded-xl shadow-sm transition-all hover:-translate-y-1">
            <div class="p-5 flex flex-col h-full bg-gradient-to-br from-blue-500 to-blue-700 relative z-10">
                <h3 class="text-xs font-bold text-blue-100 uppercase tracking-wider mb-1">Total Orders</h3>
                <div class="text-3xl font-extrabold text-white mb-4">{{ $totalOrders }}</div>
                <a href="{{ route('admin.orders') }}"
                    class="text-xs font-medium text-white hover:text-blue-100 mt-auto flex items-center justify-between border-t border-blue-400/30 pt-3">
                    View Details
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <!-- Background Icon -->
            <svg class="absolute -bottom-4 -right-4 w-24 h-24 text-blue-400/30 -rotate-12 transform" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                    clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Total Users (Teal) -->
        <div class="relative overflow-hidden bg-teal-500 rounded-xl shadow-sm transition-all hover:-translate-y-1">
            <div class="p-5 flex flex-col h-full bg-gradient-to-br from-teal-400 to-teal-600 relative z-10">
                <h3 class="text-xs font-bold text-teal-100 uppercase tracking-wider mb-1">Total Users</h3>
                <div class="text-3xl font-extrabold text-white mb-4">{{ $totalUsers }}</div>
                <a href="{{ route('admin.users') }}"
                    class="text-xs font-medium text-white hover:text-teal-100 mt-auto flex items-center justify-between border-t border-teal-400/30 pt-3">
                    View Details
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <!-- Background Icon -->
            <svg class="absolute -bottom-4 -right-4 w-24 h-24 text-teal-200/30 -rotate-12 transform" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
            </svg>
        </div>

        <!-- Total Payments (Green) -->
        <div class="relative overflow-hidden bg-emerald-500 rounded-xl shadow-sm transition-all hover:-translate-y-1">
            <div class="p-5 flex flex-col h-full bg-gradient-to-br from-emerald-400 to-emerald-600 relative z-10">
                <h3 class="text-xs font-bold text-emerald-100 uppercase tracking-wider mb-1">Total Payments</h3>
                <div class="text-3xl font-extrabold text-white mb-4">₹{{ number_format($totalPayments) }}</div>
                <a href="{{ route('admin.payments') }}"
                    class="text-xs font-medium text-white hover:text-emerald-100 mt-auto flex items-center justify-between border-t border-emerald-400/30 pt-3">
                    View Details
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <!-- Background Icon -->
            <svg class="absolute -bottom-4 -right-4 w-24 h-24 text-emerald-300/30 -rotate-12 transform" fill="currentColor"
                viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                <path fill-rule="evenodd"
                    d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Recent Orders Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Recent Transactions</h3>
            <a href="{{ route('admin.orders') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View
                all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Transaction ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Amount
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                #{{ $order->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                {{ $order->product ? $order->product->price : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ strtolower($order->status) == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ strtolower($order->status) == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ strtolower($order->status) == 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                    {{ strtolower($order->status) == 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ strtolower($order->status) == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-900">No recent transactions</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
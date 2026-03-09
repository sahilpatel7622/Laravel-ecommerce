@extends('Admin.layout')
@section('title', 'Manage Orders')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold text-gray-900">Orders Management</h1>
        <p class="text-sm text-gray-500">View and update customer order statuses</p>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-lg font-medium leading-6 text-gray-900">All Orders ({{ $orders->count() }})</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Info</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Details</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <!-- Order Info -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">#{{ $order->id }}</div>
                        <div class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                    </td>
                    
                    <!-- Customer Details -->
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ ucfirst($order->user ? $order->user->name : 'Unknown User') }}</div>
                    </td>
                    
                    <!-- Product Details -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($order->product)
                                <div class="flex-shrink-0 h-10 w-10 mr-3">
                                    <img class="h-10 w-10 rounded-md object-cover border border-gray-200" src="{{ filter_var($order->product->gallery, FILTER_VALIDATE_URL) ? $order->product->gallery : asset($order->product->gallery) }}" alt="">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 max-w-[150px] truncate" title="{{ $order->product->name }}">{{ $order->product->name }}</div>
                                    <div class="text-xs font-semibold text-gray-700 mt-0.5">₹{{ number_format($order->amount, 0) }}</div>
                                </div>
                            @else
                                <div class="text-sm text-red-500 italic">Product Deleted</div>
                            @endif
                        </div>
                    </td>

                    <!-- Payment -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 font-medium capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</div>
                        <div class="mt-1">
                            @if($order->payment_status === 'paid' || $order->payment_status === 'done' || $order->payment_status === 'completed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($order->payment_status) }}</span>
                            @endif
                        </div>
                    </td>

                    <!-- Status Update Form -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="status" class="block w-full pl-3 pr-10 py-1.5 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md 
                                {{ strtolower($order->status) == 'pending' ? 'text-yellow-700 bg-yellow-50 font-medium' : '' }}
                                {{ strtolower($order->status) == 'processing' ? 'text-blue-700 bg-blue-50 font-medium' : '' }}
                                {{ strtolower($order->status) == 'shipped' ? 'text-indigo-700 bg-indigo-50 font-medium' : '' }}
                                {{ strtolower($order->status) == 'delivered' ? 'text-green-700 bg-green-50 font-medium' : '' }}
                                {{ strtolower($order->status) == 'cancelled' ? 'text-red-700 bg-red-50 font-medium' : '' }}
                            " onchange="this.form.submit()">
                                <option value="Pending" {{ strtolower($order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ strtolower($order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Shipped" {{ strtolower($order->status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ strtolower($order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ strtolower($order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            
                            <!-- Hidden submit button just in case JS fails -->
                            <noscript>
                                <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs hover:bg-indigo-700">Go</button>
                            </noscript>
                        </form>
                    </td>

                    <!-- Address -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 whitespace-normal min-w-[200px]">
                            {{ $order->address }}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="text-lg font-medium text-gray-900">No orders found</p>
                            <p class="mt-1 text-gray-500">There are currently no orders in the database.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

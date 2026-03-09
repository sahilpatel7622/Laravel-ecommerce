@extends('Admin.layout')
@section('title', 'Manage Orders')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold text-gray-900">Payment Management</h1>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-lg font-medium leading-6 text-gray-900">All Payments ({{ $orders->count() }})</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product id</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <!-- Transaction Info -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">#{{ $order->id }}</div>
                        <div class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                    </td>
                    
                    <!-- Customer Details -->
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ ucfirst($order->user ? $order->user->name : 'Unknown User') }}</div>
                    </td>

                    <!-- Product ID -->
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $order->product ? $order->product->id : 'N/A' }}</div>
                    </td>
                    
                    <!-- Amount Details -->
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">
                            @if($order->amount)
                                ₹{{ is_numeric($order->amount) ? number_format($order->amount, 0) : $order->amount }}
                            @else
                                {{ $order->product ? $order->product->price : 'N/A' }}
                            @endif
                        </div>
                    </td>

                    <!-- Payment Method -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 font-medium capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</div>
                    </td>

                    <!-- Setup Payment Status Dropdown -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <form action="{{ route('admin.payments.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="payment_status" class="block w-full pl-3 pr-10 py-1.5 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md 
                                {{ strtolower($order->payment_status) == 'pending' ? 'text-yellow-700 bg-yellow-50 font-medium' : '' }}
                                {{ strtolower($order->payment_status) == 'completed' || strtolower($order->payment_status) == 'paid' || strtolower($order->payment_status) == 'done' ? 'text-green-700 bg-green-50 font-medium' : '' }}
                                {{ strtolower($order->payment_status) == 'failed' ? 'text-red-700 bg-red-50 font-medium' : '' }}
                                {{ strtolower($order->payment_status) == 'refunded' ? 'text-gray-700 bg-gray-100 font-medium' : '' }}
                            " onchange="this.form.submit()">
                                <option value="pending" {{ strtolower($order->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ (strtolower($order->payment_status) == 'completed' || strtolower($order->payment_status) == 'paid' || strtolower($order->payment_status) == 'done') ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ strtolower($order->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ strtolower($order->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                            
                            <!-- Hidden submit button just in case JS fails -->
                            <noscript>
                                <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs hover:bg-indigo-700">Go</button>
                            </noscript>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium text-gray-900">No payments found</p>
                            <p class="mt-1 text-gray-500">There are currently no payment records in the database.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

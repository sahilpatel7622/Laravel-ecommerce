@extends('Admin.layout')
@section('title', 'Order Details')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h1>
            <p class="text-sm text-gray-500">
                Placed on {{ $order->created_at->format('M d, Y - h:i A') }}
            </p>
        </div>

        <a href="{{ route('admin.orders') }}" 
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">
           ← Back to Orders
        </a>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Customer Info -->
        <div class="bg-white shadow rounded-xl p-5 border">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Customer Details</h2>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $order->user->number ?? 'N/A' }}</p>
        </div>

        <!-- Order Status -->
        <div class="bg-white shadow rounded-xl p-5 border">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Status</h2>
            
            <p class="mb-2">
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded text-sm
                    @if($order->status == 'Pending') bg-yellow-100 text-yellow-700
                    @elseif($order->status == 'Processing') bg-blue-100 text-blue-700
                    @elseif($order->status == 'Shipped') bg-indigo-100 text-indigo-700
                    @elseif($order->status == 'Delivered') bg-green-100 text-green-700
                    @elseif($order->status == 'Cancelled') bg-red-100 text-red-700
                    @endif
                ">
                    {{ $order->status }}
                </span>
            </p>

            <p>
                <strong>Payment:</strong>
                <span class="px-2 py-1 rounded text-sm
                    {{ $order->payment_status == 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </p>

            <p class="mt-2">
                <strong>Method:</strong> {{ ucfirst(str_replace('_',' ',$order->payment_method)) }}
            </p>
        </div>

        <!-- Product Info -->
        <div class="bg-white shadow rounded-xl p-5 border md:col-span-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Product Details</h2>

            @forelse($order->items as $item)
                <div class="flex items-center gap-4 mb-4 pb-4 border-b last:border-0 last:pb-0 last:mb-0">
                    @if($item->product)
                        <img src="{{ asset($item->product->gallery) }}" 
                             class="w-24 h-24 object-cover rounded border">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $item->product->name }} (x{{ $item->quantity }})
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">
                                {{ Str::limit($item->product->description, 60) }}
                            </p>
                            <p class="mt-2 font-bold text-gray-800">
                                ₹{{ number_format((float) str_replace(['₹', '$', '€', '£', ',', ' '], '', $item->product->price) * $item->quantity, 0) }}
                            </p>
                        </div>
                    @else
                        <p class="text-red-500 italic">Product not available (deleted)</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 italic">No products found for this order.</p>
            @endforelse
        </div>

        <!-- Address -->
        <div class="bg-white shadow rounded-xl p-5 border md:col-span-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Shipping Address</h2>
            <p class="text-gray-700">{{ $order->address }}</p>
        </div>

    </div>

</div>
@endsection
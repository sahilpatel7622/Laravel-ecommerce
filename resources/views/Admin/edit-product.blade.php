@extends('Admin.layout')
@section('title', 'Edit Product')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-sm text-gray-500">Update details for {{ $product->name }}</p>
    </div>
    <a href="{{ route('admin.products') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
        Back to Products
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl mx-auto cursor-pointer">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Product Information</h3>
    </div>
    <div class="px-6 py-6">
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 gap-y-6 gap-x-6 sm:grid-cols-2">
                
                <!-- Name -->
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border" required>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <div class="mt-1">
                        <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border" required>
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price (Include Currency Symbol)</label>
                    <div class="mt-1">
                        <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border" required>
                    </div>
                </div>

                <!-- Gallery Image -->
                <div class="sm:col-span-2">
                    <label for="gallery" class="block text-sm font-medium text-gray-700">Product Image (Optional)</label>
                    <div class="mt-1 flex items-center gap-4">
                        <img src="{{ filter_var($product->gallery, FILTER_VALIDATE_URL) ? $product->gallery : asset($product->gallery) }}" alt="Preview" class="h-12 w-12 object-cover rounded-md border border-gray-200">
                        <input type="file" name="gallery" id="gallery" accept="image/*" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border bg-white">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Leave blank to keep the current image.</p>
                </div>

                <!-- Description -->
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.products') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cancel</a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('Layout')
@section('content')
<div class="bg-gray-100 dark:bg-gray-900">
    <div class="header bg-white dark:bg-gray-800 h-16 px-10 py-8 border-b-2 border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-gray-400 dark:text-gray-500">
            <span class="text-green-700 dark:text-green-400 tracking-wider font-thin text-md"><a href="{{ route('dashboard') }}">Dashboard</a></span>
            <span>/</span>
            <span class="tracking-wide text-md"><span class="text-base text-gray-900 dark:text-white">Products</span></span>
            <span>/</span>
        </div>
    </div>
    <div class="header my-3 h-12 px-10 flex items-center justify-between">
        <h1 class="font-medium text-2xl text-gray-900 dark:text-white">All Products</h1>
    </div>
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
    });
</script>
@endif

        <div class="flex flex-col mx-3 mt-6 lg:flex-row">
            <!-- product Form -->
            <div class="w-full lg:w-1/3 m-1">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <form action="{{ route('add.product') }}" method="POST" enctype="multipart/form-data" class="w-full bg-white dark:bg-gray-800 shadow-md p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                   <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Select Category</label>
                        <select name="category_id" required class="appearance-none block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium border border-gray-400 dark:border-gray-600 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#98c01d] dark:focus:border-green-400">
                            <option value="" disabled selected>-- Select a Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">product Name</label>
                        <input type="text" name="product_name" placeholder="product Name" required class="appearance-none block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium border border-gray-400 dark:border-gray-600 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#98c01d] dark:focus:border-green-400" />
                    </div>

                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">product price</label>
                        <input rows="4" name="product_price" required class="appearance-none block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium border border-gray-400 dark:border-gray-600 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#98c01d] dark:focus:border-green-400"></input>
                    </div>

                    <div class="w-full px-3 mb-6">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">product Image</label>
                        <label class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center justify-center rounded-xl border-2 border-dashed border-green-400 dark:border-green-500 bg-white dark:bg-gray-700 p-6 text-center" for="dropzone-file">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-800 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <h2 class="mt-4 text-xl font-medium text-gray-700 dark:text-gray-300 tracking-wide">Upload Image</h2>
                            <p class="mt-2 text-gray-500 dark:text-gray-400 tracking-wide">SVG, PNG, JPG or GIF</p>
                            <input id="dropzone-file" type="file" name="product_image" accept="image/png, image/jpeg, image/webp" class="hidden" />
                        </label>
                    </div>
                    <div class="w-full px-3 mb-6">
                        <button type="submit" class="w-full bg-green-700 text-white font-bold py-3 px-3 rounded-lg hover:bg-green-600 transition-colors">Add product</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- product Table -->
        <div class="w-full lg:w-2/3 m-1 bg-white dark:bg-gray-800 shadow-lg text-lg rounded-sm border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto rounded-lg p-3">
                <table class="table-auto w-full">
                    <thead class="text-sm font-semibold uppercase text-gray-800 dark:text-gray-200 bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="p-2 text-left">S.NO</th>
                            <th class="p-2 text-left">Category</th>
                            <th class="p-2 text-left">product Image</th>
                            <th class="p-2 text-left">product name</th>
                            <th class="p-2 text-left">Price</th>
                            <th class="p-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 dark:text-gray-300">
                        @foreach ($products as $index => $product)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="p-2">{{ $index + 1 }}</td>
                               <td class="p-2">{{ $product->category->category_name ?? 'N/A' }}</td>

                               <td class="p-2">
                                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded-md">
                                </td>
                                <td class="p-2">{{ $product->product_name }}</td>
                                <td class="p-2">{{ $product->product_price }}</td>
                                <td class="p-2">
                                    <div class="flex justify-center space-x-2">
                                        
                                        <a href="javascript:void(0);" 
                                            data-id="{{ $product->id }}" 
                                            class="rounded-md hover:bg-red-100 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 p-2 flex items-center delete-product transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Delete
                                            </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-product').forEach(function (button) {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form to submit DELETE request
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/delete-product/${productId}`;
                        
                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        
                        // Add method override for DELETE
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        
                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection

@extends('Layout')
@section('content')

<div class="bg-gray-100 dark:bg-gray-900">
    <div class="header bg-white dark:bg-gray-800 h-16 px-10 py-8 border-b-2 border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-gray-400 dark:text-gray-500">
            <span class="text-green-700 dark:text-green-400 tracking-wider font-thin text-md"><a href="{{ route('dashboard') }}">Dashboard</a></span>
            <span>/</span>
            <span class="text-green-700 dark:text-green-400 tracking-wider font-thin text-md"><a href="{{ route('bank-details.index') }}">Bank Details</a></span>
            <span>/</span>
            <span class="tracking-wide text-md"><span class="text-base text-gray-900 dark:text-white">Add Bank Details</span></span>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Add New Bank Details</h2>
            </div>
            
            <div class="p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('bank-details.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bank Name *</label>
                            <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Account Number *</label>
                            <input type="text" id="account_number" name="account_number" value="{{ old('account_number') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="ifsc_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">IFSC Code *</label>
                            <input type="text" id="ifsc_code" name="ifsc_code" value="{{ old('ifsc_code') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="branch" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Branch</label>
                            <input type="text" id="branch" name="branch" value="{{ old('branch') }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="is_default" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_default" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Set as default bank details
                        </label>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('bank-details.index') }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Bank Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

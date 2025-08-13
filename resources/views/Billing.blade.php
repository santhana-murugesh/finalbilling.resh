@extends('Layout')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300" x-data="billingApp()">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300"><span x-text="settings ? settings.company_name : 'Reshma Crackers'"></span> </h1>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300">
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full transition-colors duration-300">Order #<span x-text="nextOrderNumber"></span></span>
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full transition-colors duration-300">{{ now()->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button @click="showSettings = true" class="p-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                    <button @click="showHistory = true" class="p-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            
            <!-- Left Panel - Products & Search -->
            <div class="w-full lg:w-2/3 space-y-6">
                
                <!-- Search & Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 transition-colors duration-300">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Search Bar -->
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                x-model="searchQuery" 
                                placeholder="Search products by name, category, or price..."
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                            >
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="flex space-x-2">
                            <button @click="showCustomerModal = true" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Customer</span>
                            </button>
                            <button @click="showTransportModal = true" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-300 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                                <span>Transport</span>
                            </button>
                            <button @click="applyDiscount" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-300 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span>Discount</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 transition-colors duration-300">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 transition-colors duration-300">Categories</h3>
                    <div class="flex flex-wrap gap-2">
                        <button 
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                            :class="selectedCategory === null ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'"
                            @click="selectedCategory = null">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span>All Products</span>
                            </span>
                        </button>
                        @foreach ($categories as $category)
                            <button 
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                                :class="selectedCategory === {{ $category->id }} ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'"
                                @click="selectedCategory = {{ $category->id }}">
                                {{ $category->category_name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 transition-colors duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white transition-colors duration-300">Products</h3>
                        <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300">
                            <span x-text="filteredProducts.length"></span> products found
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($products as $product)
                            <template x-if="isProductVisible({{ $product->id }}, '{{ strtolower($product->product_name) }}', {{ $product->category_id }}, {{ $product->product_price }})">
                                <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 cursor-pointer overflow-hidden"
                                     @click="addToCart({ id: {{ $product->id }}, name: '{{ $product->product_name }}', price: {{ $product->product_price }}, image: '{{ asset('storage/' . $product->product_image) }}' })">
                                    
                                    <!-- Product Image -->
                                    <div class="relative h-40 overflow-hidden">
                                        <img src="{{ asset('storage/' . $product->product_image) }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" 
                                             loading="lazy"
                                             alt="{{ $product->product_name }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2 transition-colors duration-300">{{ $product->product_name }}</h4>
                                        <div class="flex justify-between items-center">
                                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400 transition-colors duration-300">₹{{ number_format($product->product_price, 2) }}</span>
                                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quick Add Button -->
                                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click.stop="quickAdd({{ $product->id }})" 
                                                class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Panel - Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 flex flex-col h-[calc(100vh-200px)] lg:sticky lg:top-6 transition-colors duration-300">
                    
                    <!-- Order Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Order Summary</h2>
                        <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300">
                            <span x-text="cart.length"></span> items
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div x-show="selectedCustomer" class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-700 transition-colors duration-300">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium text-blue-900 dark:text-blue-200 transition-colors duration-300" x-text="selectedCustomer.name"></div>
                                <div class="text-sm text-blue-700 dark:text-blue-300 transition-colors duration-300" x-text="selectedCustomer.phone"></div>
                            </div>
                            <button @click="selectedCustomer = null" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="flex-1 overflow-y-auto space-y-3 pr-2">
                        <template x-for="(item, index) in cart" :key="item.id">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600 transition-colors duration-300">
                                <div class="flex items-start gap-3">
                                    <img :src="item.image" :alt="item.name" class="w-12 h-12 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <div class="font-medium text-sm text-gray-900 dark:text-white truncate transition-colors duration-300" x-text="item.name"></div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300">₹<span x-text="item.price.toFixed(2)"></span> each</div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center mt-2 space-x-2">
                                            <button @click="decrement(item.id)" 
                                                    class="w-6 h-6 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 rounded flex items-center justify-center transition-colors duration-300">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <input type="number" min="1" x-model.number="item.quantity" 
                                                   class="w-12 text-center border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300" />
                                            <button @click="increment(item.id)" 
                                                    class="w-6 h-6 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 rounded flex items-center justify-center transition-colors duration-300">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="text-sm font-bold text-blue-600 dark:text-blue-400 transition-colors duration-300">₹<span x-text="(item.price * item.quantity).toFixed(2)"></span></span>
                                        <button @click="removeItem(item.id)" 
                                                class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        
                        <!-- Empty Cart -->
                        <div x-show="cart.length === 0" class="text-center py-8 text-gray-500 dark:text-gray-400 transition-colors duration-300">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                            <p>Your cart is empty</p>
                            <p class="text-sm">Add products to get started</p>
                        </div>
                    </div>

                    <!-- Totals -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4 space-y-3 transition-colors duration-300">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-300 transition-colors duration-300">Subtotal:</span>
                            <span class="font-medium text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="subtotal.toFixed(2)"></span></span>
                        </div>
                        
                        <!-- Discount -->
                        <div x-show="discountPercentage > 0" class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-300 transition-colors duration-300">Discount (<span x-text="discountPercentage"></span>%):</span>
                            <span class="text-green-600 dark:text-green-400 font-medium transition-colors duration-300">-₹<span x-text="discountAmount.toFixed(2)"></span></span>
                        </div>
                        
                        <!-- Tax -->
                        <div class="flex justify-between text-sm" x-show="selectedCustomer && selectedCustomer.state !== 'Tamil Nadu'">
                            <span class="text-gray-600 dark:text-gray-300 transition-colors duration-300">IGST (<span x-text="settings ? settings.tax_rate : 18"></span>%):</span>
                            <span class="font-medium text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="igstAmount.toFixed(2)"></span></span>
                        </div>
                        <div class="flex justify-between text-sm" x-show="selectedCustomer && selectedCustomer.state === 'Tamil Nadu'">
                            <span class="text-gray-600 dark:text-gray-300 transition-colors duration-300">CGST (<span x-text="(settings ? settings.tax_rate : 18) / 2"></span>%):</span>
                            <span class="font-medium text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="cgstAmount.toFixed(2)"></span></span>
                        </div>
                        <div class="flex justify-between text-sm" x-show="selectedCustomer && selectedCustomer.state === 'Tamil Nadu'">
                            <span class="text-gray-600 dark:text-gray-300 transition-colors duration-300">SGST (<span x-text="(settings ? settings.tax_rate : 18) / 2"></span>%):</span>
                            <span class="font-medium text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="sgstAmount.toFixed(2)"></span></span>
                        </div>
                        
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-3 transition-colors duration-300">
                            <div class="flex justify-between text-lg font-bold text-blue-600 dark:text-blue-400 transition-colors duration-300">
                                <span>Total:</span>
                                <span>₹<span x-text="totalAmount.toFixed(2)"></span></span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2 pt-4">
                            <button @click="storeOrder" 
                                    :disabled="cart.length === 0"
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-[1.02]">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Complete Order</span>
                                </span>
                            </button>
                            
                            <button @click="clearCart" 
                                    x-show="cart.length > 0"
                                    class="w-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300">
                                Clear Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Modal -->
    <div x-show="showCustomerModal" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
         @click.outside="showCustomerModal = false">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-md p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white transition-colors duration-300">Customer Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Customer Name *</label>
                    <input type="text" x-model="customerForm.name" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Mobile Number *</label>
                    <input type="tel" x-model="customerForm.phone" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">GST Number</label>
                    <input type="text" x-model="customerForm.gst_number" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Aadhar Number (Optional)</label>
                    <input type="text" x-model="customerForm.aadhar_number" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">State</label>
                    <select x-model="customerForm.state" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                        <option value="">Select State</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="Assam">Assam</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Goa">Goa</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Ladakh">Ladakh</option>
                        <option value="Puducherry">Puducherry</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Email (Optional)</label>
                    <input type="email" x-model="customerForm.email" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Address (Optional)</label>
                    <textarea x-model="customerForm.address" rows="3" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button @click="showCustomerModal = false" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 transition-colors duration-300">Cancel</button>
                <button @click="saveCustomer" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Save Customer</button>
            </div>
        </div>
    </div>

    <!-- Discount Modal -->
    <div x-show="showDiscountModal" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
         @click.outside="showDiscountModal = false">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-md p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white transition-colors duration-300">Apply Discount</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Discount Percentage</label>
                    <input type="number" x-model="discountPercentage" min="0" max="100" step="0.01" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300">
                    <p>Subtotal: ₹<span x-text="subtotal.toFixed(2)"></span></p>
                    <p>Discount Amount: ₹<span x-text="discountAmount.toFixed(2)"></span></p>
                    <p>Final Amount: ₹<span x-text="(subtotal - discountAmount).toFixed(2)"></span></p>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button @click="removeDiscount" class="px-4 py-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-300">Remove Discount</button>
                <button @click="showDiscountModal = false" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 transition-colors duration-300">Cancel</button>
                <button @click="applyDiscountConfirm" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Apply</button>
            </div>
        </div>
    </div>

    <!-- Transport Modal -->
    <div x-show="showTransportModal" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
         @click.outside="showTransportModal = false">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-md p-6 transition-colors duration-300">
            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white transition-colors duration-300">Select Transport</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-300">Transport Company</label>
                    <select x-model="selectedTransportId" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                        <option value="">Select Transport</option>
                        <template x-for="transport in transports" :key="transport.id">
                            <option :value="transport.id" x-text="transport.name"></option>
                        </template>
                    </select>
                </div>
                <div x-show="selectedTransportId">
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            <p><strong>Name:</strong> <span x-text="transports.find(t => t.id == selectedTransportId)?.name || 'Not found'"></span></p>
                            <p x-show="transports.find(t => t.id == selectedTransportId)?.phone"><strong>Phone:</strong> <span x-text="transports.find(t => t.id == selectedTransportId)?.phone"></span></p>
                            <p x-show="transports.find(t => t.id == selectedTransportId)?.email"><strong>Email:</strong> <span x-text="transports.find(t => t.id == selectedTransportId)?.email"></span></p>
                            <p x-show="transports.find(t => t.id == selectedTransportId)?.vehicle_number"><strong>Vehicle:</strong> <span x-text="transports.find(t => t.id == selectedTransportId)?.vehicle_number"></span></p>
                            <p x-show="transports.find(t => t.id == selectedTransportId)?.address"><strong>Address:</strong> <span x-text="transports.find(t => t.id == selectedTransportId)?.address"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button @click="showTransportModal = false" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 transition-colors duration-300">Cancel</button>
                <button @click="saveTransport" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Select Transport</button>
            </div>
        </div>
    </div>

    <!-- Bill Preview Modal -->
    <div x-show="showModal" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-4xl p-6 max-h-[90vh] overflow-y-auto transition-colors duration-300">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-blue-600 dark:text-blue-400 transition-colors duration-300">Bill Preview</h2>
                <button @click="showModal = false" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div id="billContent" class="text-sm font-sans bg-white dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700 rounded-lg transition-colors duration-300">
                <!-- Company Header -->
                <div class="text-center mb-6">
                    <div x-show="settings && settings.logo" class="mb-2">
                        <img :src="'/storage/' + settings.logo" alt="Company Logo" class="h-12 mx-auto object-contain">
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white mb-1 transition-colors duration-300" x-text="settings ? settings.company_name : 'Reshma Crackers'"></div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300" x-text="settings ? settings.company_address : '302/3B NARANAPURAM PUDHUR, SIVAKASI 626189'"></div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300">
                        <span x-text="settings ? 'Exp Lic No :01/2021' : 'Exp Lic No :01/2021'"></span>
                    </div>
                    <div x-show="settings && settings.gst_number" class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300" x-text="'GST: ' + settings.gst_number"></div>
                </div>

                <!-- Bill Details -->
                <div class="flex justify-between items-start mb-4 text-sm">
                    <div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Bill To:</strong></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer ? orderPreview.customer.name : 'Walk-in Customer'"></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer ? orderPreview.customer.phone : ''"></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer ? orderPreview.customer.address : ''"></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer ? orderPreview.customer.email : ''"></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer && orderPreview.customer.gst_number ? 'GST: ' + orderPreview.customer.gst_number : ''"></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer && orderPreview.customer.aadhar_number ? 'Aadhar: ' + orderPreview.customer.aadhar_number : ''"></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.customer && orderPreview.customer.state ? 'State: ' + orderPreview.customer.state : ''"></div>
                    </div>
                    <div class="text-right">
                        <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Bill No:</strong> <span x-text="orderPreview.number"></span></div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Date:</strong> {{ now()->format('d-m-Y') }}</div>
                        <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Time:</strong> {{ now()->format('h:i A') }}</div>
                    </div>
                </div>

                <!-- Transport Details -->
                <div x-show="orderPreview.transport" class="mb-4 text-sm">
                    <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Transport:</strong></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.transport ? orderPreview.transport.name : 'No name'"></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.transport ? orderPreview.transport.phone : ''"></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.transport && orderPreview.transport.vehicle_number ? 'Vehicle: ' + orderPreview.transport.vehicle_number : ''"></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="orderPreview.transport ? orderPreview.transport.address : ''"></div>
                </div>

                <!-- Products Table -->
                <table class="w-full mb-4 border-collapse border border-gray-300 dark:border-gray-600 text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 text-center text-gray-900 dark:text-white transition-colors duration-300">S.No</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 text-left text-gray-900 dark:text-white transition-colors duration-300">Product Name</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 text-right text-gray-900 dark:text-white transition-colors duration-300">Rate</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 text-center text-gray-900 dark:text-white transition-colors duration-300">Qty</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 text-right text-gray-900 dark:text-white transition-colors duration-300">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in orderPreview.items" :key="item.id">
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 p-2 text-center text-gray-900 dark:text-white transition-colors duration-300" x-text="index + 1"></td>
                                <td class="border border-gray-300 dark:border-gray-600 p-2 text-gray-900 dark:text-white transition-colors duration-300" x-text="item.name"></td>
                                <td class="border border-gray-300 dark:border-gray-600 p-2 text-right text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="item.price.toFixed(2)"></span></td>
                                <td class="border border-gray-300 dark:border-gray-600 p-2 text-center text-gray-900 dark:text-white transition-colors duration-300" x-text="item.quantity"></td>
                                <td class="border border-gray-300 dark:border-gray-600 p-2 text-right text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="(item.price * item.quantity).toFixed(2)"></span></td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <!-- Totals -->
                <div class="flex justify-end">
                    <table class="text-sm">
                        <tr>
                            <td class="pr-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Subtotal:</td>
                            <td class="text-right text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="orderPreview.subtotal"></span></td>
                        </tr>
                        <tr x-show="orderPreview.discount > 0">
                            <td class="pr-4 font-medium text-green-600 dark:text-green-400 transition-colors duration-300">Discount:</td>
                            <td class="text-right text-green-600 dark:text-green-400 transition-colors duration-300">-₹<span x-text="orderPreview.discount"></span></td>
                        </tr>
                        <tr x-show="orderPreview.customer && orderPreview.customer.state !== 'Tamil Nadu'">
                            <td class="pr-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">IGST (<span x-text="settings ? settings.tax_rate : 18"></span>%):</td>
                            <td class="text-right text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="igstAmount.toFixed(2)"></span></td>
                        </tr>
                        <tr x-show="orderPreview.customer && orderPreview.customer.state === 'Tamil Nadu'">
                            <td class="pr-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">CGST (<span x-text="(settings ? settings.tax_rate : 18) / 2"></span>%):</td>
                            <td class="text-right text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="cgstAmount.toFixed(2)"></span></td>
                        </tr>
                        <tr x-show="orderPreview.customer && orderPreview.customer.state === 'Tamil Nadu'">
                            <td class="pr-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">SGST (<span x-text="(settings ? settings.tax_rate : 18) / 2"></span>%):</td>
                            <td class="text-right text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="sgstAmount.toFixed(2)"></span></td>
                        </tr>
                        <tr class="border-t border-gray-300 dark:border-gray-600 transition-colors duration-300">
                            <td class="pr-4 font-bold text-lg text-gray-900 dark:text-white transition-colors duration-300">Total:</td>
                            <td class="text-right font-bold text-lg text-blue-600 dark:text-blue-400 transition-colors duration-300">₹<span x-text="orderPreview.total"></span></td>
                        </tr>
                    </table>
                </div>
                
                <!-- Bank Details -->
                <div class="mt-6 text-sm" x-show="bankDetails">
                    <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Bank Details:</strong></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="bankDetails ? 'Bank: ' + bankDetails.bank_name + (bankDetails.branch ? ', ' + bankDetails.branch : '') : ''"></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="bankDetails ? 'A/c No: ' + bankDetails.account_number : ''"></div>
                    <div class="text-gray-900 dark:text-white transition-colors duration-300" x-text="bankDetails ? 'IFSC: ' + bankDetails.ifsc_code : ''"></div>
                </div>

                <!-- Signature Section -->
                <div class="mt-8 flex justify-end items-end">
                    <div class="text-center">
                        <div class="border-t-2 border-gray-400 w-32 h-16"></div>
                        <div class="text-xs text-gray-600 dark:text-gray-300 mt-1">Authorized Signature</div>
                    </div>
                </div>

                <!-- Total in Words -->
                <div class="mt-4 text-sm text-center">
                    <div class="text-gray-900 dark:text-white transition-colors duration-300">
                        <strong>Amount in Words:</strong> <span x-text="numberToWords(parseFloat(orderPreview.total))"></span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center text-xs text-gray-600 dark:text-gray-300 transition-colors duration-300">
                    <p class="mb-2">Thank you for your business!</p>
                    <p class="italic">This bill is valid for 3 days from the date of issue</p>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-4">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors duration-300">Close</button>
                <button @click="printBill" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Print Bill</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div x-show="showToast" 
         x-transition 
         class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span x-text="toastMessage"></span>
    </div>
</div>

<script>
    function billingApp() {
        return {
            selectedCategory: null,
            searchQuery: '',
            cart: [],
            showToast: false,
            toastMessage: '',
            nextOrderNumber: '',
            showModal: false,
            showCustomerModal: false,
            showTransportModal: false,
            showDiscountModal: false,
            discountPercentage: 0,
            selectedCustomer: null,
            selectedTransportId: null,
            selectedTransport: null,
            transports: [],
            settings: null,
            bankDetails: null,
            customerForm: {
                name: '',
                phone: '',
                email: '',
                address: '',
                gst_number: '',
                aadhar_number: '',
                state: ''
            },
            orderPreview: {
                number: '',
                items: [],
                subtotal: '',
                discount: '',
                tax: '',
                total: ''
            },
            
            init() {
                this.fetchNextOrderNumber();
                this.loadCartFromStorage();
                this.loadSettings();
                this.loadTransports();
                this.loadBankDetails();
            },
            
            fetchNextOrderNumber() {
                fetch('/next-order-number')
                    .then(res => res.json())
                    .then(data => {
                        this.nextOrderNumber = data.next_order_number;
                    });
            },
            
            loadSettings() {
                fetch('/api/settings')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.settings) {
                            this.settings = data.settings;
                        }
                    })
                    .catch(err => {
                        console.error('Failed to load settings:', err);
                    });
            },
            
            loadTransports() {
                fetch('/api/transports')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.transports) {
                            this.transports = data.transports;
                        }
                    })
                    .catch(err => {
                        console.error('Failed to load transports:', err);
                    });
            },
            
            loadBankDetails() {
                fetch('/api/bank-details/default')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.bankDetails) {
                            this.bankDetails = data.bankDetails;
                        }
                    })
                    .catch(err => {
                        console.error('Failed to load bank details:', err);
                    });
            },
            
            get filteredProducts() {
                // This will be used for product filtering logic
                return [];
            },
            
            isProductVisible(productId, productName, categoryId, price) {
                const matchesSearch = this.searchQuery === '' || 
                    productName.includes(this.searchQuery.toLowerCase()) ||
                    price.toString().includes(this.searchQuery);
                
                const matchesCategory = this.selectedCategory === null || this.selectedCategory === categoryId;
                
                return matchesSearch && matchesCategory;
            },
            
            get subtotal() {
                return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            },
            
            get discountAmount() {
                return (this.subtotal * this.discountPercentage) / 100;
            },
            
            get igstAmount() {
                const taxableAmount = this.subtotal - this.discountAmount;
                const customerState = this.selectedCustomer ? this.selectedCustomer.state : null;
                
                // If customer is from Tamil Nadu (same state), no IGST
                if (customerState === 'Tamil Nadu') {
                    return 0;
                }
                
                // If customer is from different state, apply IGST
                const taxRate = this.settings ? this.settings.tax_rate : 18;
                return (taxableAmount * taxRate) / 100;
            },
            
            get cgstAmount() {
                const taxableAmount = this.subtotal - this.discountAmount;
                const customerState = this.selectedCustomer ? this.selectedCustomer.state : null;
                
                // If customer is from Tamil Nadu (same state), apply CGST
                if (customerState === 'Tamil Nadu') {
                    const taxRate = this.settings ? this.settings.tax_rate : 18;
                    return (taxableAmount * (taxRate / 2)) / 100;
                }
                
                // If customer is from different state, no CGST
                return 0;
            },
            
            get sgstAmount() {
                const taxableAmount = this.subtotal - this.discountAmount;
                const customerState = this.selectedCustomer ? this.selectedCustomer.state : null;
                
                // If customer is from Tamil Nadu (same state), apply SGST
                if (customerState === 'Tamil Nadu') {
                    const taxRate = this.settings ? this.settings.tax_rate : 18;
                    return (taxableAmount * (taxRate / 2)) / 100;
                }
                
                // If customer is from different state, no SGST
                return 0;
            },
            
            get taxAmount() {
                return this.igstAmount + this.cgstAmount + this.sgstAmount;
            },
            
            get totalAmount() {
                return this.subtotal - this.discountAmount + this.taxAmount;
            },
            
            addToCart(product) {
                const existing = this.cart.find(p => p.id === product.id);
                if (existing) {
                    existing.quantity += 1;
                } else {
                    this.cart.push({ ...product, quantity: 1 });
                }
                this.saveCartToStorage();
                this.showToastMessage('Item added to cart!');
            },
            
            quickAdd(productId) {
                const product = this.cart.find(p => p.id === productId);
                if (product) {
                    product.quantity += 1;
                    this.saveCartToStorage();
                    this.showToastMessage('Quantity updated!');
                }
            },
            
            increment(id) {
                const item = this.cart.find(p => p.id === id);
                if (item) {
                    item.quantity++;
                    this.saveCartToStorage();
                }
            },
            
            decrement(id) {
                const item = this.cart.find(p => p.id === id);
                if (item && item.quantity > 1) {
                    item.quantity--;
                    this.saveCartToStorage();
                }
            },
            
            removeItem(id) {
                this.cart = this.cart.filter(p => p.id !== id);
                this.saveCartToStorage();
                this.showToastMessage('Item removed from cart!');
            },
            
            clearCart() {
                this.cart = [];
                this.saveCartToStorage();
                this.showToastMessage('Cart cleared!');
            },
            
            saveCustomer() {
                if (this.customerForm.name && this.customerForm.phone) {
                    this.selectedCustomer = { ...this.customerForm };
                    this.showCustomerModal = false;
                    this.customerForm = { name: '', phone: '', email: '', address: '', gst_number: '', aadhar_number: '', state: '' };
                    this.showToastMessage('Customer information saved!');
                }
            },
            
            saveTransport() {
                if (this.selectedTransportId) {
                    this.selectedTransport = this.transports.find(t => t.id == this.selectedTransportId);
                    this.showTransportModal = false;
                    this.showToastMessage('Transport selected!');
                }
            },
            
            applyDiscount() {
                this.showDiscountModal = true;
            },
            
            applyDiscountConfirm() {
                this.showDiscountModal = false;
                this.showToastMessage('Discount applied!');
            },
            
            removeDiscount() {
                this.discountPercentage = 0;
                this.showDiscountModal = false;
                this.showToastMessage('Discount removed!');
            },
            
            storeOrder() {
                if (this.cart.length === 0) return;
                
                fetch('/store-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        cart: this.cart,
                        total: this.totalAmount,
                        customer: this.selectedCustomer,
                        transport: this.selectedTransport,
                        discount: this.discountAmount,
                        tax: this.taxAmount,
                        igst: this.igstAmount,
                        cgst: this.cgstAmount,
                        sgst: this.sgstAmount
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.orderPreview = {
                        number: data.order_number ?? this.nextOrderNumber,
                        items: [...this.cart],
                        subtotal: this.subtotal.toFixed(2),
                        discount: this.discountAmount.toFixed(2),
                        tax: this.taxAmount.toFixed(2),
                        total: this.totalAmount.toFixed(2),
                        customer: this.selectedCustomer ? { ...this.selectedCustomer } : null,
                        transport: this.selectedTransport ? { ...this.selectedTransport } : null
                    };
                    this.showModal = true;
                    this.cart = [];
                    this.selectedCustomer = null;
                    this.selectedTransport = null;
                    this.selectedTransportId = null;
                    this.discountPercentage = 0;
                    this.saveCartToStorage();
                    this.fetchNextOrderNumber();
                })
                .catch(err => {
                    console.error('Order storage failed', err);
                    this.showToastMessage('Error saving order!', 'error');
                });
            },
            
            printBill() {
                // Generate print content with proper customer information
                const customerName = this.orderPreview.customer ? this.orderPreview.customer.name : 'Walk-in Customer';
                const customerPhone = this.orderPreview.customer ? this.orderPreview.customer.phone : '';
                const customerAddress = this.orderPreview.customer ? this.orderPreview.customer.address : '';
                const customerEmail = this.orderPreview.customer ? this.orderPreview.customer.email : '';
                
                // Calculate taxes for print
                const taxableAmount = parseFloat(this.orderPreview.subtotal) - parseFloat(this.orderPreview.discount);
                const customerState = this.orderPreview.customer ? this.orderPreview.customer.state : null;
                const taxRate = this.settings ? this.settings.tax_rate : 18;
                
                let igstAmount = 0;
                let cgstAmount = 0;
                let sgstAmount = 0;
                
                if (customerState === 'Tamil Nadu') {
                    // Same state - CGST + SGST
                    cgstAmount = (taxableAmount * (taxRate / 2)) / 100;
                    sgstAmount = (taxableAmount * (taxRate / 2)) / 100;
                } else {
                    // Different state - IGST
                    igstAmount = (taxableAmount * taxRate) / 100;
                }
                
                const printContent = `
                    <div class="text-sm font-sans bg-white p-6 border rounded-lg">
                        <!-- Company Header -->
                        <div class="text-center mb-6">
                            ${this.settings && this.settings.logo ? `<div class="mb-2"><img src="/storage/${this.settings.logo}" alt="Company Logo" style="max-height: 60px; max-width: 200px; object-fit: contain;"></div>` : ''}
                            <div class="text-2xl font-bold text-gray-900 mb-1">${this.settings ? this.settings.company_name : 'Company Name'}</div>
                            <div class="text-sm text-gray-600">${this.settings ? this.settings.company_address : '302/3B NARANAPURAM PUDHUR, SIVAKASI 626189'}</div>
                            <div class="text-sm text-gray-600">
                                <span>Exp Lic No :01/2021</span>
                            </div>
                            ${this.settings && this.settings.gst_number ? `<div class="text-sm text-gray-600">GST: ${this.settings.gst_number}</div>` : ''}
                        </div>

                        <!-- Bill Details -->
                        <div class="flex justify-between items-start mb-4 text-sm">
                            <div>
                                <div class="text-gray-900"><strong>Bill To:</strong></div>
                                <div class="text-gray-900">${customerName}</div>
                                ${customerPhone ? `<div class="text-gray-900">${customerPhone}</div>` : ''}
                                ${customerAddress ? `<div class="text-gray-900">${customerAddress}</div>` : ''}
                                ${customerEmail ? `<div class="text-gray-900">${customerEmail}</div>` : ''}
                                ${this.orderPreview.customer && this.orderPreview.customer.gst_number ? `<div class="text-gray-900">GST: ${this.orderPreview.customer.gst_number}</div>` : ''}
                                ${this.orderPreview.customer && this.orderPreview.customer.aadhar_number ? `<div class="text-gray-900">Aadhar: ${this.orderPreview.customer.aadhar_number}</div>` : ''}
                                ${this.orderPreview.customer && this.orderPreview.customer.state ? `<div class="text-gray-900">State: ${this.orderPreview.customer.state}</div>` : ''}
                            </div>
                            <div style="text-align: right;">
                                <div class="text-gray-900"><strong>Bill No:</strong> ${this.orderPreview.number}</div>
                                <div class="text-gray-900"><strong>Date:</strong> ${new Date().toLocaleDateString('en-IN')}</div>
                                <div class="text-gray-900"><strong>Time:</strong> ${new Date().toLocaleTimeString('en-IN', {hour: '2-digit', minute: '2-digit'})}</div>
                            </div>
                        </div>

                        <!-- Transport Details -->
                        ${this.orderPreview.transport ? `
                        <div class="mb-4 text-sm">
                            <div class="text-gray-900"><strong>Transport:</strong></div>
                            <div class="text-gray-900">${this.orderPreview.transport.name || 'No name'}</div>
                            ${this.orderPreview.transport.phone ? `<div class="text-gray-900">${this.orderPreview.transport.phone}</div>` : ''}
                            ${this.orderPreview.transport.vehicle_number ? `<div class="text-gray-900">Vehicle: ${this.orderPreview.transport.vehicle_number}</div>` : ''}
                            ${this.orderPreview.transport.address ? `<div class="text-gray-900">${this.orderPreview.transport.address}</div>` : ''}
                        </div>
                        ` : ''}

                        <!-- Products Table -->
                        <table class="w-full mb-4 border-collapse border border-gray-300 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 p-2 text-center">S.No</th>
                                    <th class="border border-gray-300 p-2 text-left">Product Name</th>
                                    <th class="border border-gray-300 p-2 text-right">Rate</th>
                                    <th class="border border-gray-300 p-2 text-center">Qty</th>
                                    <th class="border border-gray-300 p-2 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${this.orderPreview.items.map((item, index) => `
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-center">${index + 1}</td>
                                        <td class="border border-gray-300 p-2">${item.name}</td>
                                        <td class="border border-gray-300 p-2 text-right">₹${parseFloat(item.price).toFixed(2)}</td>
                                        <td class="border border-gray-300 p-2 text-center">${item.quantity}</td>
                                        <td class="border border-gray-300 p-2 text-right">₹${(item.price * item.quantity).toFixed(2)}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>

                        <!-- Totals -->
                        <div class="flex justify-end">
                            <table class="text-sm">
                                <tr>
                                    <td class="pr-4 font-medium">Subtotal:</td>
                                    <td class="text-right">₹${parseFloat(this.orderPreview.subtotal).toFixed(2)}</td>
                                </tr>
                                ${parseFloat(this.orderPreview.discount) > 0 ? `
                                    <tr>
                                        <td class="pr-4 font-medium text-green-600">Discount:</td>
                                        <td class="text-right text-green-600">-₹${parseFloat(this.orderPreview.discount).toFixed(2)}</td>
                                    </tr>
                                ` : ''}
                                ${customerState !== 'Tamil Nadu' ? `
                                <tr>
                                    <td class="pr-4 font-medium">IGST (${taxRate}%):</td>
                                    <td class="text-right">₹${igstAmount.toFixed(2)}</td>
                                </tr>
                                ` : ''}
                                ${customerState === 'Tamil Nadu' ? `
                                <tr>
                                    <td class="pr-4 font-medium">CGST (${taxRate / 2}%):</td>
                                    <td class="text-right">₹${cgstAmount.toFixed(2)}</td>
                                </tr>
                                <tr>
                                    <td class="pr-4 font-medium">SGST (${taxRate / 2}%):</td>
                                    <td class="text-right">₹${sgstAmount.toFixed(2)}</td>
                                </tr>
                                ` : ''}
                                <tr class="border-t">
                                    <td class="pr-4 font-bold text-lg">Total:</td>
                                    <td class="text-right font-bold text-lg text-blue-600">₹${parseFloat(this.orderPreview.total).toFixed(2)}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <!-- Bank Details -->
                        ${this.bankDetails ? `
                        <div class="mt-6 text-sm">
                            <div class="text-gray-900"><strong>Bank Details:</strong></div>
                            <div class="text-gray-900">Bank: ${this.bankDetails.bank_name}${this.bankDetails.branch ? ', ' + this.bankDetails.branch : ''}</div>
                            <div class="text-gray-900">A/c No: ${this.bankDetails.account_number}</div>
                            <div class="text-gray-900">IFSC: ${this.bankDetails.ifsc_code}</div>
                        </div>
                        ` : ''}

                        <!-- Signature Section -->
                        <div class="mt-8 flex justify-end items-end">
                            <div class="text-center">
                                <div class="border-t-2 border-gray-400 w-32 h-16"></div>
                                <div class="text-xs text-gray-600 mt-1">Authorized Signature</div>
                            </div>
                        </div>

                        <!-- Total in Words -->
                        <div class="mt-4 text-sm text-center">
                            <div class="text-gray-900">
                                <strong>Amount in Words:</strong> ${this.numberToWords(parseFloat(this.orderPreview.total))}
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mt-6 text-center text-xs text-gray-600">
                            <p class="mb-2">Thank you for your business!</p>
                            <p class="italic">This bill is valid for 3 days from the date of issue</p>
                        </div>
                    </div>
                `;
                
                const printWindow = window.open('', '', 'width=800,height=600');
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Print Bill - ${this.orderPreview.number}</title>
                            <style>
                                * {
                                    font-family: Arial, sans-serif;
                                }
                                body {
                                    padding: 20px;
                                    margin: 0;
                                    font-size: 14px;
                                    color: #000;
                                }
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    margin: 10px 0;
                                }
                                th, td {
                                    border: 1px solid #000;
                                    padding: 8px;
                                    text-align: left;
                                }
                                th {
                                    background-color: #f9f9f9;
                                }
                                .text-right {
                                    text-align: right;
                                }
                                .text-center {
                                    text-align: center;
                                }
                                .font-bold {
                                    font-weight: bold;
                                }
                                .text-lg {
                                    font-size: 18px;
                                }
                                .text-2xl {
                                    font-size: 24px;
                                }
                                .text-sm {
                                    font-size: 12px;
                                }
                                .text-xs {
                                    font-size: 10px;
                                }
                                .border-t {
                                    border-top: 1px solid #000;
                                }
                                .mb-4 {
                                    margin-bottom: 16px;
                                }
                                .mb-6 {
                                    margin-bottom: 24px;
                                }
                                .mt-6 {
                                    margin-top: 24px;
                                }
                                .p-2 {
                                    padding: 8px;
                                }
                                .p-6 {
                                    padding: 24px;
                                }
                                .pr-4 {
                                    padding-right: 16px;
                                }
                                .text-gray-600 {
                                    color: #4b5563;
                                }
                                .text-gray-900 {
                                    color: #111827;
                                }
                                .text-blue-600 {
                                    color: #2563eb;
                                }
                                .text-green-600 {
                                    color: #059669;
                                }
                                .bg-gray-100 {
                                    background-color: #f3f4f6;
                                }
                                .border {
                                    border: 1px solid #d1d5db;
                                }
                                .border-gray-300 {
                                    border-color: #d1d5db;
                                }
                                .rounded-lg {
                                    border-radius: 8px;
                                }
                                .italic {
                                    font-style: italic;
                                }
                                .flex {
                                    display: flex;
                                }
                                .justify-between {
                                    justify-content: space-between;
                                }
                                .justify-end {
                                    justify-content: flex-end;
                                }
                                .items-start {
                                    align-items: flex-start;
                                }
                                .items-end {
                                    align-items: flex-end;
                                }
                                .mt-8 {
                                    margin-top: 32px;
                                }
                                .w-32 {
                                    width: 128px;
                                }
                                .h-16 {
                                    height: 64px;
                                }
                                .border-t-2 {
                                    border-top: 2px solid #9ca3af;
                                }
                                .border-gray-400 {
                                    border-color: #9ca3af;
                                }
                                hr {
                                    margin: 8px 0;
                                    border: none;
                                    border-top: 1px solid #d1d5db;
                                }
                            </style>
                        </head>
                        <body>
                            ${printContent}
                            <script>
                                window.onload = function() {
                                    window.print();
                                    window.onafterprint = function() {
                                        window.close();
                                    }
                                }
                            <\/script>
                        </body>
                    </html>
                `);
                printWindow.document.close();
            },
            
            showToastMessage(message, type = 'success') {
                this.toastMessage = message;
                this.showToast = true;
                setTimeout(() => this.showToast = false, 3000);
            },
            
            saveCartToStorage() {
                localStorage.setItem('billingCart', JSON.stringify(this.cart));
            },
            
            loadCartFromStorage() {
                const savedCart = localStorage.getItem('billingCart');
                if (savedCart) {
                    this.cart = JSON.parse(savedCart);
                }
            },
            
            numberToWords(num) {
                const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
                const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
                const teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                
                function convertLessThanOneThousand(n) {
                    if (n === 0) return '';
                    
                    if (n < 10) return ones[n];
                    if (n < 20) return teens[n - 10];
                    if (n < 100) {
                        return tens[Math.floor(n / 10)] + (n % 10 !== 0 ? ' ' + ones[n % 10] : '');
                    }
                    if (n < 1000) {
                        return ones[Math.floor(n / 100)] + ' Hundred' + (n % 100 !== 0 ? ' and ' + convertLessThanOneThousand(n % 100) : '');
                    }
                }
                
                function convert(n) {
                    if (n === 0) return 'Zero';
                    
                    const crore = Math.floor(n / 10000000);
                    const lakh = Math.floor((n % 10000000) / 100000);
                    const thousand = Math.floor((n % 100000) / 1000);
                    const remainder = n % 1000;
                    
                    let result = '';
                    
                    if (crore > 0) {
                        result += convertLessThanOneThousand(crore) + ' Crore ';
                    }
                    if (lakh > 0) {
                        result += convertLessThanOneThousand(lakh) + ' Lakh ';
                    }
                    if (thousand > 0) {
                        result += convertLessThanOneThousand(thousand) + ' Thousand ';
                    }
                    if (remainder > 0) {
                        result += convertLessThanOneThousand(remainder);
                    }
                    
                    return result.trim();
                }
                
                const rupees = Math.floor(num);
                const paise = Math.round((num - rupees) * 100);
                
                let result = convert(rupees) + ' Rupees';
                if (paise > 0) {
                    result += ' and ' + convert(paise) + ' Paise';
                }
                
                return result + ' Only';
            }
        }
    }
</script>

@endsection

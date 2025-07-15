@extends('Layout')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300" x-data="orderHistoryApp()">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Order History</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('billings.page') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                        New Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg transition-colors duration-300">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300 transition-colors duration-300">Today's Orders</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300" x-text="stats.today_orders || 0"></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 dark:bg-green-900/20 rounded-lg transition-colors duration-300">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300 transition-colors duration-300">Today's Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="(stats.today_revenue || 0).toFixed(2)"></span></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/20 rounded-lg transition-colors duration-300">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300 transition-colors duration-300">Month Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300">₹<span x-text="(stats.month_revenue || 0).toFixed(2)"></span></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 dark:bg-orange-900/20 rounded-lg transition-colors duration-300">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300 transition-colors duration-300">Pending Orders</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300" x-text="stats.pending_orders || 0"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" x-model="searchQuery" placeholder="Search by order number, customer name..." 
                           class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                </div>
                <div class="flex gap-2">
                    <select x-model="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <select x-model="paymentFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                        <option value="">All Payments</option>
                        <option value="pending">Pending</option>
                        <option value="received">Received</option>
                    </select>
                    <button @click="loadOrders" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                        Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden transition-colors duration-300">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Items</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider transition-colors duration-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <template x-for="order in filteredOrders" :key="order.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white transition-colors duration-300" x-text="order.order_number"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white transition-colors duration-300" x-text="order.customer?.name || 'Walk-in Customer'"></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300" x-text="order.customer?.phone || ''"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white transition-colors duration-300" x-text="getItemCount(order.cart) + ' items'"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white transition-colors duration-300" x-text="'₹' + parseFloat(order.total).toFixed(2)"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                          :class="getStatusBadgeClass(order.order_status)" 
                                          x-text="order.order_status"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                              :class="getPaymentBadgeClass(order.payment_status)" 
                                              x-text="order.payment_status"></span>
                                        <select @change="updatePaymentStatus(order.id, $event.target.value)" 
                                                class="text-xs border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                                            <option value="pending" :selected="order.payment_status === 'pending'">Pending</option>
                                            <option value="received" :selected="order.payment_status === 'received'">Received</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300" x-text="formatDate(order.created_at)"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button @click="viewOrder(order.id)" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors duration-300">View</button>
                                        <button @click="editOrder(order.id)" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 transition-colors duration-300">Edit</button>
                                        <button @click="deleteOrder(order.id)" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors duration-300">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            
            <!-- Empty State -->
            <div x-show="filteredOrders.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white transition-colors duration-300">No orders found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">Get started by creating a new order.</p>
                <div class="mt-6">
                    <a href="{{ route('billings.page') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                        New Order
                    </a>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div x-show="orders.length > 0" class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-700 dark:text-gray-300 transition-colors duration-300">
                Showing <span x-text="(currentPage - 1) * perPage + 1"></span> to <span x-text="Math.min(currentPage * perPage, totalOrders)"></span> of <span x-text="totalOrders"></span> results
            </div>
            <div class="flex space-x-2">
                <button @click="previousPage" :disabled="currentPage === 1" 
                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-300">
                    Previous
                </button>
                <button @click="nextPage" :disabled="currentPage >= totalPages" 
                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-300">
                    Next
                </button>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div x-show="showOrderModal" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
         @click.outside="showOrderModal = false">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-4xl p-6 max-h-[90vh] overflow-y-auto transition-colors duration-300">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Order Details</h2>
                <button @click="showOrderModal = false" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div x-show="selectedOrder" class="space-y-6">
                <!-- Order Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2 transition-colors duration-300">Order Information</h3>
                        <div class="space-y-2 text-sm">
                            <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Order Number:</strong> <span x-text="selectedOrder.order_number"></span></div>
                            <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Date:</strong> <span x-text="formatDate(selectedOrder.created_at)"></span></div>
                            <div class="text-gray-900 dark:text-white transition-colors duration-300">
                                <strong>Status:</strong> 
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                          :class="getStatusBadgeClass(selectedOrder.order_status)" 
                                          x-text="selectedOrder.order_status"></span>
                                    <select @change="updateOrderStatus(selectedOrder.id, 'order_status', $event.target.value)" 
                                            class="text-xs border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                                        <option value="pending" :selected="selectedOrder.order_status === 'pending'">Pending</option>
                                        <option value="processing" :selected="selectedOrder.order_status === 'processing'">Processing</option>
                                        <option value="completed" :selected="selectedOrder.order_status === 'completed'">Completed</option>
                                        <option value="cancelled" :selected="selectedOrder.order_status === 'cancelled'">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-gray-900 dark:text-white transition-colors duration-300">
                                <strong>Payment:</strong> 
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                          :class="getPaymentBadgeClass(selectedOrder.payment_status)" 
                                          x-text="selectedOrder.payment_status"></span>
                                    <select @change="updateOrderStatus(selectedOrder.id, 'payment_status', $event.target.value)" 
                                            class="text-xs border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300">
                                        <option value="pending" :selected="selectedOrder.payment_status === 'pending'">Pending</option>
                                        <option value="received" :selected="selectedOrder.payment_status === 'received'">Received</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2 transition-colors duration-300">Customer Information</h3>
                        <div class="space-y-2 text-sm">
                            <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Name:</strong> <span x-text="selectedOrder.customer?.name || 'Walk-in Customer'"></span></div>
                            <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Phone:</strong> <span x-text="selectedOrder.customer?.phone || 'N/A'"></span></div>
                            <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Email:</strong> <span x-text="selectedOrder.customer?.email || 'N/A'"></span></div>
                            <div class="text-gray-900 dark:text-white transition-colors duration-300"><strong>Address:</strong> <span x-text="selectedOrder.customer?.address || 'N/A'"></span></div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 transition-colors duration-300">Order Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase transition-colors duration-300">Product</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase transition-colors duration-300">Price</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase transition-colors duration-300">Qty</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase transition-colors duration-300">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <template x-for="item in selectedOrder.cart" :key="item.id">
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-900 dark:text-white transition-colors duration-300" x-text="item.name"></td>
                                        <td class="px-4 py-2 text-sm text-gray-900 dark:text-white text-right transition-colors duration-300">₹<span x-text="parseFloat(item.price).toFixed(2)"></span></td>
                                        <td class="px-4 py-2 text-sm text-gray-900 dark:text-white text-center transition-colors duration-300" x-text="item.quantity"></td>
                                        <td class="px-4 py-2 text-sm text-gray-900 dark:text-white text-right transition-colors duration-300">₹<span x-text="(item.price * item.quantity).toFixed(2)"></span></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Totals -->
                <div class="flex justify-end">
                    <div class="w-64 space-y-2 text-sm">
                        <div class="flex justify-between text-gray-900 dark:text-white transition-colors duration-300">
                            <span>Subtotal:</span>
                            <span>₹<span x-text="parseFloat(selectedOrder.subtotal).toFixed(2)"></span></span>
                        </div>
                        <div x-show="selectedOrder.discount > 0" class="flex justify-between text-green-600 dark:text-green-400 transition-colors duration-300">
                            <span>Discount:</span>
                            <span>-₹<span x-text="parseFloat(selectedOrder.discount).toFixed(2)"></span></span>
                        </div>
                        <div class="flex justify-between text-gray-900 dark:text-white transition-colors duration-300">
                            <span>Tax:</span>
                            <span>₹<span x-text="parseFloat(selectedOrder.tax).toFixed(2)"></span></span>
                        </div>
                        <div class="flex justify-between font-bold text-lg border-t border-gray-200 dark:border-gray-600 pt-2 text-gray-900 dark:text-white transition-colors duration-300">
                            <span>Total:</span>
                            <span>₹<span x-text="parseFloat(selectedOrder.total).toFixed(2)"></span></span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-600 transition-colors duration-300">
                    <button @click="printOrder(selectedOrder)" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                        Print Bill
                    </button>
                    <button @click="editOrder(selectedOrder.id)" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                        Edit Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function orderHistoryApp() {
        return {
            orders: [],
            selectedOrder: null,
            showOrderModal: false,
            searchQuery: '',
            statusFilter: '',
            paymentFilter: '',
            stats: {},
            settings: {},
            currentPage: 1,
            perPage: 20,
            totalOrders: 0,
            totalPages: 0,
            
            init() {
                this.loadStats();
                this.loadOrders();
                this.loadSettings();
            },
            
            get filteredOrders() {
                return this.orders.filter(order => {
                    const matchesSearch = !this.searchQuery || 
                        order.order_number.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        (order.customer?.name && order.customer.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    
                    const matchesStatus = !this.statusFilter || order.order_status === this.statusFilter;
                    const matchesPayment = !this.paymentFilter || order.payment_status === this.paymentFilter;
                    
                    return matchesSearch && matchesStatus && matchesPayment;
                });
            },
            
            loadStats() {
                fetch('/order-stats')
                    .then(res => res.json())
                    .then(data => {
                        this.stats = data;
                    });
            },
            
            loadOrders() {
                fetch(`/api/order-history?page=${this.currentPage}`)
                    .then(res => res.json())
                    .then(data => {
                        this.orders = data.data;
                        this.totalOrders = data.total;
                        this.totalPages = Math.ceil(data.total / this.perPage);
                    });
            },
            
            loadSettings() {
                fetch('/api/settings')
                    .then(res => res.json())
                    .then(data => {
                        this.settings = data.settings || {};
                    })
                    .catch(error => {
                        console.error('Error loading settings:', error);
                        this.settings = {};
                    });
            },
            
            viewOrder(orderId) {
                fetch(`/order/${orderId}`)
                    .then(res => res.json())
                    .then(data => {
                        this.selectedOrder = data.order;
                        
                        // Parse cart data if it's a JSON string
                        if (typeof this.selectedOrder.cart === 'string') {
                            try {
                                this.selectedOrder.cart = JSON.parse(this.selectedOrder.cart);
                            } catch (e) {
                                console.error('Error parsing cart data:', e);
                                this.selectedOrder.cart = [];
                            }
                        }
                        
                        console.log('Selected order with parsed cart:', this.selectedOrder);
                        this.showOrderModal = true;
                    });
            },
            
            editOrder(orderId) {
                // Redirect to billing page with order data
                window.location.href = `/reshma-billing?edit=${orderId}`;
            },
            
            deleteOrder(orderId) {
                if (confirm('Are you sure you want to delete this order?')) {
                    fetch(`/order/${orderId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.loadOrders();
                        this.loadStats();
                    });
                }
            },
            
            updatePaymentStatus(orderId, newStatus) {
                this.updateOrderStatus(orderId, 'payment_status', newStatus);
            },
            
            updateOrderStatus(orderId, statusType, newStatus) {
                const updateData = {};
                updateData[statusType] = newStatus;
                
                fetch(`/order/${orderId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(updateData)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Update the order in the local array
                        const orderIndex = this.orders.findIndex(order => order.id === orderId);
                        if (orderIndex !== -1) {
                            this.orders[orderIndex][statusType] = newStatus;
                        }
                        
                        // Update selected order if it's the same order
                        if (this.selectedOrder && this.selectedOrder.id === orderId) {
                            this.selectedOrder[statusType] = newStatus;
                        }
                        
                        // Update stats
                        this.loadStats();
                    } else {
                        alert(data.message || `Error updating ${statusType}. Please try again.`);
                    }
                })
                .catch(error => {
                    console.error(`Error updating ${statusType}:`, error);
                    alert(`Error updating ${statusType}. Please try again.`);
                });
            },
            
            printOrder(order) {
                console.log('Printing order:', order);
                console.log('Settings:', this.settings);
                
                // Create print content
                const printContent = this.generateBillContent(order);
                console.log('Generated print content:', printContent);
                
                const printWindow = window.open('', '', 'width=800,height=600');
                if (!printWindow) {
                    alert('Please allow popups to print the bill');
                    return;
                }
                
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Print Bill - ${order.order_number}</title>
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
                                    console.log('Print window loaded, triggering print...');
                                    setTimeout(function() {
                                        window.print();
                                    }, 500);
                                    window.onafterprint = function() {
                                        console.log('Print completed, closing window...');
                                        window.close();
                                    }
                                }
                            <\/script>
                        </body>
                    </html>
                `);
                printWindow.document.close();
            },
            
            generateBillContent(order) {
                const settings = this.settings || {};
                const customer = order.customer || {};
                
                // Parse cart data - it might be a JSON string or already an array
                let cartItems = [];
                if (typeof order.cart === 'string') {
                    try {
                        cartItems = JSON.parse(order.cart);
                    } catch (e) {
                        console.error('Error parsing cart data:', e);
                        cartItems = [];
                    }
                } else if (Array.isArray(order.cart)) {
                    cartItems = order.cart;
                }
                
                console.log('Cart items for print:', cartItems);
                
                // Format date function for print
                const formatDateForPrint = (dateString) => {
                    return new Date(dateString).toLocaleDateString('en-IN', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                };
                
                return `
                    <div class="text-sm font-sans bg-white p-6 border rounded-lg">
                        <!-- Company Header -->
                        <div class="text-center mb-6">
                            <div class="text-2xl font-bold text-gray-900 mb-1">${settings.company_name || 'Company Name'}</div>
                            <div class="text-sm text-gray-600">${settings.company_address || '302/3B NARANAPURAM PUDHUR, SIVAKASI 626189'}</div>
                            <div class="text-sm text-gray-600">
                                <span>Phone: ${settings.company_phone || '+91 8248384330'}</span>
                                ${settings.company_email ? ` | <span>Email: ${settings.company_email}</span>` : ''}
                            </div>
                            ${settings.gst_number ? `<div class="text-sm text-gray-600">GST: ${settings.gst_number}</div>` : ''}
                        </div>

                        <!-- Bill Details -->
                        <div class="flex justify-between items-start mb-4 text-sm">
                            <div>
                                <div class="text-gray-900"><strong>Bill To:</strong></div>
                                <div class="text-gray-900">${customer.name || 'Walk-in Customer'}</div>
                                <div class="text-gray-900">${customer.phone || ''}</div>
                                <div class="text-gray-900">${customer.address || ''}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-gray-900"><strong>Bill No:</strong> ${order.order_number}</div>
                                <div class="text-gray-900"><strong>Date:</strong> ${formatDateForPrint(order.created_at)}</div>
                            </div>
                        </div>

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
                                ${cartItems.map((item, index) => `
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
                                    <td class="text-right">₹${parseFloat(order.subtotal).toFixed(2)}</td>
                                </tr>
                                ${order.discount > 0 ? `
                                    <tr>
                                        <td class="pr-4 font-medium text-green-600">Discount:</td>
                                        <td class="text-right text-green-600">-₹${parseFloat(order.discount).toFixed(2)}</td>
                                    </tr>
                                ` : ''}
                                <tr>
                                    <td class="pr-4 font-medium">GST (18%):</td>
                                    <td class="text-right">₹${parseFloat(order.tax).toFixed(2)}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="pr-4 font-bold text-lg">Total:</td>
                                    <td class="text-right font-bold text-lg text-blue-600">₹${parseFloat(order.total).toFixed(2)}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="mt-6 text-center text-xs text-gray-600">
                            <p class="mb-2">Thank you for your business!</p>
                            <p class="italic">This bill is valid for 3 days from the date of issue</p>
                        </div>
                    </div>
                `;
            },
            
            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.loadOrders();
                }
            },
            
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.loadOrders();
                }
            },
            
            getItemCount(cart) {
                return cart.reduce((total, item) => total + item.quantity, 0);
            },
            
            formatDate(dateString) {
                return new Date(dateString).toLocaleDateString('en-IN', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            },
            
            getStatusBadgeClass(status) {
                return {
                    'pending': 'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-200',
                    'processing': 'bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-200',
                    'completed': 'bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200',
                    'cancelled': 'bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-200'
                }[status] || 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200';
            },
            
            getPaymentBadgeClass(status) {
                return {
                    'pending': 'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-200',
                    'received': 'bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200'
                }[status] || 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200';
            }
        }
    }
</script>

@endsection 
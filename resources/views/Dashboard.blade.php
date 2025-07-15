@extends('Layout')
@section('content')

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <div>
                <div class="flex h-screen overflow-y-hidden bg-gray-50 dark:bg-gray-900" x-data="setup()"
                    x-init="$refs.loading.classList.add('hidden')">
                    <div class="flex flex-col flex-1 h-full overflow-hidden">
                        <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50 dark:bg-gray-900">
                            <div
                                class="flex flex-col items-start justify-between pb-6 space-y-4 border-b border-gray-200 dark:border-gray-700 lg:items-center lg:space-y-0 lg:flex-row">
                                <h1 class="text-2xl font-semibold whitespace-nowrap text-gray-900 dark:text-white">Dashboard</h1>
                                <div class="flex space-x-3">
                                    <a href="{{ route('billings.page') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        New Order
                                    </a>
                                    <a href="{{ route('order.history') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        Order History
                                    </a>
                                </div>
                            </div>

                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <!-- Stats Cards -->
                            <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                                <div class="p-6 transition-shadow border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                                    <div class="flex items-start justify-between">
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-blue-100">Today's Orders</span>
                                            <span class="text-2xl font-bold" x-text="stats.today_orders || 0">0</span>
                                        </div>
                                        <div class="p-3 bg-blue-400 rounded-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-blue-100">Orders processed today</span>
                                    </div>
                                </div>

                                <div class="p-6 transition-shadow border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg bg-gradient-to-r from-green-500 to-green-600 text-white">
                                    <div class="flex items-start justify-between">
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-green-100">Today's Revenue</span>
                                            <span class="text-2xl font-bold">₹<span x-text="(stats.today_revenue || 0).toFixed(2)">0.00</span></span>
                                        </div>
                                        <div class="p-3 bg-green-400 rounded-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-green-100">Revenue generated today</span>
                                    </div>
                                </div>

                                <div class="p-6 transition-shadow border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="flex items-start justify-between">
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-purple-100">Month Revenue</span>
                                            <span class="text-2xl font-bold">₹<span x-text="(stats.month_revenue || 0).toFixed(2)">0.00</span></span>
                                        </div>
                                        <div class="p-3 bg-purple-400 rounded-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-purple-100">Revenue this month</span>
                                    </div>
                                </div>

                                <div class="p-6 transition-shadow border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white">
                                    <div class="flex items-start justify-between">
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-orange-100">Pending Orders</span>
                                            <span class="text-2xl font-bold" x-text="stats.pending_orders || 0">0</span>
                                        </div>
                                        <div class="p-3 bg-orange-400 rounded-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-orange-100">Orders awaiting payment</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="mt-8">
                                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Quick Actions</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <a href="{{ route('billings.page') }}" class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                        <div class="flex items-center space-x-3">
                                            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-white">Create New Order</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Start a new billing order</p>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('order.history') }}" class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                        <div class="flex items-center space-x-3">
                                            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-white">View Orders</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Check order history</p>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('all.products') }}" class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                        <div class="flex items-center space-x-3">
                                            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-white">Manage Products</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Add or edit products</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Recent Orders Table -->
                            <div class="mt-8">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Orders</h3>
                                    <a href="{{ route('order.history') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">View All</a>
                                </div>
                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                                <template x-for="order in recentOrders" :key="order.id">
                                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="order.order_number"></div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-gray-900 dark:text-white" x-text="order.customer?.name || 'Walk-in Customer'"></div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="'₹' + parseFloat(order.total).toFixed(2)"></div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                                                  :class="getStatusBadgeClass(order.order_status)" 
                                                                  x-text="order.order_status"></span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400" x-text="formatDate(order.created_at)"></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <!-- Empty State -->
                                    <div x-show="recentOrders.length === 0" class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No orders yet</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating your first order.</p>
                                        <div class="mt-6">
                                            <a href="{{ route('billings.page') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                                Create Order
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
<script>
    const setup = () => {
        return {
            loading: true,
            isSidebarOpen: false,
            stats: {},
            recentOrders: [],
            
            init() {
                this.loadStats();
                this.loadRecentOrders();
            },
            
            loadStats() {
                fetch('/order-stats')
                    .then(res => res.json())
                    .then(data => {
                        this.stats = data;
                    })
                    .catch(error => {
                        console.error('Error loading stats:', error);
                    });
            },
            
            loadRecentOrders() {
                fetch('/api/order-history?per_page=5')
                    .then(res => res.json())
                    .then(data => {
                        this.recentOrders = data.data;
                    });
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
                    'pending': 'bg-yellow-100 text-yellow-800',
                    'processing': 'bg-blue-100 text-blue-800',
                    'completed': 'bg-green-100 text-green-800',
                    'cancelled': 'bg-red-100 text-red-800'
                }[status] || 'bg-gray-100 text-gray-800';
            },
            
            toggleSidbarMenu() {
                this.isSidebarOpen = !this.isSidebarOpen
            },
            isSettingsPanelOpen: false,
            isSearchBoxOpen: false,
        }
    }
</script>
@endsection
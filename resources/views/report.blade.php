@extends('Layout')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Reports & Analytics</h1>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Sales Overview Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Sales</p>
                            <p class="text-3xl font-bold">₹45,230</p>
                            <p class="text-blue-100 text-sm">+12.5% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Orders</p>
                            <p class="text-3xl font-bold">156</p>
                            <p class="text-green-100 text-sm">+8.2% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Products Card -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Products Sold</p>
                            <p class="text-3xl font-bold">892</p>
                            <p class="text-purple-100 text-sm">+15.3% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Customers Card -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">New Customers</p>
                            <p class="text-3xl font-bold">23</p>
                            <p class="text-orange-100 text-sm">+5.7% from last month</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 transition-colors duration-300">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 transition-colors duration-300">Recent Orders</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-600">
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Order ID</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Customer</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Products</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Total</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Status</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white transition-colors duration-300">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300">
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">#ORD-001</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">John Doe</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">3 items</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">₹1,250</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded-full transition-colors duration-300">Completed</span>
                                </td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">2024-01-15</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300">
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">#ORD-002</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">Jane Smith</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">2 items</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">₹850</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-xs rounded-full transition-colors duration-300">Pending</span>
                                </td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">2024-01-14</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300">
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">#ORD-003</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">Mike Johnson</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">5 items</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">₹2,100</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded-full transition-colors duration-300">Completed</span>
                                </td>
                                <td class="py-3 px-4 text-gray-900 dark:text-white transition-colors duration-300">2024-01-13</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Chart Placeholder -->
            <div class="mt-8 bg-gray-50 dark:bg-gray-700 rounded-xl p-6 transition-colors duration-300">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 transition-colors duration-300">Sales Analytics</h2>
                <div class="h-64 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 flex items-center justify-center transition-colors duration-300">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-600 dark:text-gray-400 transition-colors duration-300">Chart visualization will be implemented here</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500 transition-colors duration-300">Sales trends, product performance, and customer analytics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
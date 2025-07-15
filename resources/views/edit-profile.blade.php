@extends('Layout')
@section('content')
    <div>
        <div class="flex h-screen overflow-y-hidden bg-gray-50 dark:bg-gray-900" x-data="setup()"
            x-init="$refs.loading.classList.add('hidden')">
            <div class="flex flex-col flex-1 h-full overflow-hidden">
                <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50 dark:bg-gray-900">
                    <div
                        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b border-gray-200 dark:border-gray-700 lg:items-center lg:space-y-0 lg:flex-row">
                        <h1 class="text-2xl font-semibold whitespace-nowrap text-gray-900 dark:text-white">Edit Profile</h1>
                        <div class="flex space-x-3">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                Back to Dashboard
                            </a>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="mt-6 max-w-2xl">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            @if (session('success'))
                                <div class="mb-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('update.profile') }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Full Name
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}"
                                           required 
                                           class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                           placeholder="Enter your full name">
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Email Address
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}"
                                           required 
                                           class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                           placeholder="Enter your email">
                                </div>

                                <!-- Password Change Section -->
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Change Password</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Leave blank if you don't want to change your password.</p>
                                    
                                    <!-- Current Password -->
                                    <div class="mb-4">
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Current Password
                                        </label>
                                        <input type="password" 
                                               id="current_password" 
                                               name="current_password" 
                                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                               placeholder="Enter current password">
                                    </div>

                                    <!-- New Password -->
                                    <div class="mb-4">
                                        <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            New Password
                                        </label>
                                        <input type="password" 
                                               id="new_password" 
                                               name="new_password" 
                                               minlength="8"
                                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                               placeholder="Enter new password">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Password must be at least 8 characters long</p>
                                    </div>

                                    <!-- Confirm New Password -->
                                    <div>
                                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Confirm New Password
                                        </label>
                                        <input type="password" 
                                               id="new_password_confirmation" 
                                               name="new_password_confirmation" 
                                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                               placeholder="Confirm new password">
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('dashboard') }}" 
                                       class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        Cancel
                                    </a>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection 
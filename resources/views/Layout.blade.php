<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }" x-init="
  darkMode = localStorage.getItem('darkMode') === 'true';
  if (darkMode) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#eff6ff',
              100: '#dbeafe',
              200: '#bfdbfe',
              300: '#93c5fd',
              400: '#60a5fa',
              500: '#3b82f6',
              600: '#2563eb',
              700: '#1d4ed8',
              800: '#1e40af',
              900: '#1e3a8a',
            }
          }
        }
      }
    }
  </script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title><span x-text="settings ? settings.company_name : 'Reshma Crackers'"></span> Billing</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script>
    function currentRoute(route) {
        return route === "{{ Route::currentRouteName() }}";
    }
</script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">

  
  <div>
    <div class="flex h-screen overflow-y-hidden bg-gray-50 dark:bg-gray-900 transition-colors duration-200" x-data="setup()" x-init="$refs.loading.classList.add('hidden')">
      <!-- Loading screen -->
      <div
        x-ref="loading"
        class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
      >
        Loading.....
      </div>

      <!-- Sidebar backdrop -->
      <div
        x-show.in.out.opacity="isSidebarOpen"
        class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
      ></div>

      <!-- Sidebar -->
      <aside
        x-transition:enter="transition transform duration-300"
        x-transition:enter-start="-translate-x-full opacity-30  ease-in"
        x-transition:enter-end="translate-x-0 opacity-100 ease-out"
        x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0 opacity-100 ease-out"
        x-transition:leave-end="-translate-x-full opacity-0 ease-in"
        class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-lg lg:z-auto lg:static lg:shadow-none"
        :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}"
      >
        <!-- sidebar header -->
        <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{'lg:justify-center': !isSidebarOpen}">
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 flex items-center justify-center">
              <img x-show="settings && settings.logo" 
                   :src="'/storage/' + settings.logo" 
                   alt="Company Logo" 
                   class="w-full h-full object-contain">
              <div x-show="!settings || !settings.logo" 
                   class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
              </div>
            </div>
            <span x-show="isSidebarOpen" class="text-sm font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
              <span x-text="settings ? settings.company_name : 'Reshma Crackers'"></span>
            </span>
          </div>
          <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg
              class="w-6 h-6 text-gray-600"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <!-- Sidebar links -->
       <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="p-3 space-y-2 overflow-hidden">
            <!-- Dashboard -->
            <li>
                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 transition-all duration-300 group"
                    :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg': currentRoute('dashboard')}"
                >
                    <div class="relative">
                        <svg
                            class="w-6 h-6 transition-all duration-300"
                            :class="{'text-gray-500 group-hover:text-blue-600 dark:text-gray-400 dark:group-hover:text-blue-400': !currentRoute('dashboard'), 'text-white': currentRoute('dashboard')}"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                        </svg>
                        <div x-show="currentRoute('dashboard')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                    </div>
                    <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Dashboard</span>
                </a>
            </li>

            <!-- Billing -->
            <li>
                <a
                    href="{{ route('billings.page') }}"
                    class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 transition-all duration-300 group"
                    :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg': currentRoute('billings.page')}"
                >
                    <div class="relative">
                        <svg class="w-6 h-6 transition-all duration-300"
                            :class="{'text-gray-500 group-hover:text-green-600 dark:text-gray-400 dark:group-hover:text-green-400': !currentRoute('billings.page'), 'text-white': currentRoute('billings.page')}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div x-show="currentRoute('billings.page')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                    </div>
                    <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Billing</span>
                </a>
            </li>

            <!-- Categories -->
          <li>
              <a href="{{ route('all.categories') }}"
                  class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 transition-all duration-300 group"
                  :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-purple-500 to-violet-600 text-white shadow-lg': currentRoute('all.categories')}">
                  <div class="relative">
                      <svg class="w-6 h-6 transition-all duration-300"
                          :class="{'text-gray-500 group-hover:text-purple-600 dark:text-gray-400 dark:group-hover:text-purple-400': !currentRoute('all.categories'), 'text-white': currentRoute('all.categories')}"
                          fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                      </svg>
                      <div x-show="currentRoute('all.categories')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                  </div>
                  <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Categories</span>
              </a>
          </li>

          <!-- Products -->
          <li>
              <a href="{{ route('all.products') }}"
                  class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-orange-50 hover:to-red-50 dark:hover:from-orange-900/20 dark:hover:to-red-900/20 transition-all duration-300 group"
                  :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow-lg': currentRoute('all.products')}">
                  <div class="relative">
                      <svg class="w-6 h-6 transition-all duration-300"
                          :class="{'text-gray-500 group-hover:text-orange-600 dark:text-gray-400 dark:group-hover:text-orange-400': !currentRoute('all.products'), 'text-white': currentRoute('all.products')}"
                          fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                      </svg>
                      <div x-show="currentRoute('all.products')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                  </div>
                  <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Products</span>
              </a>
          </li>

            <!-- Order History -->
            <li>
                <a
                    href="{{ route('order.history') }}"
                    class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 dark:hover:from-teal-900/20 dark:hover:to-cyan-900/20 transition-all duration-300 group"
                    :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-teal-500 to-cyan-600 text-white shadow-lg': currentRoute('order.history')}"
                >
                    <div class="relative">
                        <svg class="w-6 h-6 transition-all duration-300"
                            :class="{'text-gray-500 group-hover:text-teal-600 dark:text-gray-400 dark:group-hover:text-teal-400': !currentRoute('order.history'), 'text-white': currentRoute('order.history')}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <div x-show="currentRoute('order.history')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                    </div>
                    <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Order History</span>
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a
                    href="{{ route('settings') }}"
                    class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-slate-50 dark:hover:from-gray-900/20 dark:hover:to-slate-900/20 transition-all duration-300 group"
                    :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-gray-500 to-slate-600 text-white shadow-lg': currentRoute('settings')}"
                >
                    <div class="relative">
                        <svg class="w-6 h-6 transition-all duration-300"
                            :class="{'text-gray-500 group-hover:text-gray-600 dark:text-gray-400 dark:group-hover:text-gray-300': !currentRoute('settings'), 'text-white': currentRoute('settings')}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div x-show="currentRoute('settings')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                    </div>
                    <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Settings</span>
                </a>
            </li>

            <!-- Edit Profile -->
            <li>
                <a
                    href="{{ route('edit.profile') }}"
                    class="flex items-center p-3 space-x-3 rounded-xl hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group"
                    :class="{'justify-center': !isSidebarOpen, 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg': currentRoute('edit.profile')}"
                >
                    <div class="relative">
                        <svg class="w-6 h-6 transition-all duration-300"
                            :class="{'text-gray-500 group-hover:text-indigo-600 dark:text-gray-400 dark:group-hover:text-indigo-400': !currentRoute('edit.profile'), 'text-white': currentRoute('edit.profile')}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div x-show="currentRoute('edit.profile')" class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                    </div>
                    <span :class="{ 'lg:hidden': !isSidebarOpen, 'font-medium': true }" class="transition-all duration-300">Edit Profile</span>
                </a>
            </li>

        </ul>
      </nav>
        <!-- Sidebar footer -->
        <div class="flex-shrink-0 p-2 border-t max-h-14">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md focus:outline-none focus:ring hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200"
            >
              <span>
                <svg
                  class="w-6 h-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                  />
                </svg>
              </span>
              <span :class="{'lg:hidden': !isSidebarOpen}"> Logout </span>
            </button>
          </form>
        </div>
      </aside>

      <div class="flex flex-col flex-1 h-full overflow-hidden">
        <!-- Navbar -->
        <header class="flex-shrink-0 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
          <div class="flex items-center justify-between p-4">
            <!-- Navbar left -->
            <div class="flex items-center space-x-3">
              <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden text-gray-800 dark:text-white" x-text="settings ? settings.company_name : 'Reshma Crackers'"></span>
              <!-- Toggle sidebar button -->
              <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <svg
                  class="w-5 h-5 text-gray-600 dark:text-gray-300"
                  :class="{'transform transition-transform -rotate-180': isSidebarOpen}"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
              </button>
            </div>

            <!-- Mobile search box -->
            <div
              x-show.transition="isSearchBoxOpen"
              class="fixed inset-0 z-10 bg-black bg-opacity-20"
              style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
            >
              <div
                @click.away="isSearchBoxOpen = false"
                class="absolute inset-x-0 flex items-center justify-between p-2 bg-white shadow-md"
              >
                <div class="flex items-center flex-1 px-2 space-x-2">
                  <!-- search icon -->
                  <span>
                    <svg
                      class="w-6 h-6 text-gray-500"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                      />
                    </svg>
                  </span>
                  <input
                    type="text"
                    placeholder="Search"
                    class="w-full px-4 py-3 text-gray-600 rounded-md focus:bg-gray-100 focus:outline-none"
                  />
                </div>
                <!-- close button -->
                <button @click="isSearchBoxOpen = false" class="flex-shrink-0 p-4 rounded-md">
                  <svg
                    class="w-4 h-4 text-gray-500"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Desktop search box -->
            <div class="items-center hidden px-2 space-x-2 md:flex-1 md:flex md:mr-auto md:ml-5">
              <!-- search icon -->
              <span>
                <svg
                  class="w-5 h-5 text-gray-500 dark:text-gray-400"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                  />
                </svg>
              </span>
              <input
                type="text"
                placeholder="Search products, orders..."
                class="px-4 py-2 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 lg:max-w-sm md:flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
              />
            </div>

            <!-- Navbar right -->
            <div class="relative flex items-center space-x-3">
              <!-- Search button -->
              <button
                @click="isSearchBoxOpen = true"
                class="p-2 bg-gray-100 dark:bg-gray-700 rounded-full md:hidden focus:outline-none focus:ring hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200"
              >
                <svg
                  class="w-6 h-6 text-gray-500 dark:text-gray-400"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                  />
                </svg>
              </button>

              <div class="items-center hidden space-x-3 md:flex">




                <!-- Quick Actions Dropdown -->
                <div class="relative" x-data="{ isOpen: false }">
                  <button
                    @click="isOpen = !isOpen"
                    class="p-2 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring transition-colors duration-200"
                  >
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                  </button>

                  <!-- Dropdown -->
                  <div style="z-index: 1000"
                    @click.away="isOpen = false"
                    x-show.transition.opacity="isOpen"
                    class="absolute right-0 mt-3 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
                  >
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                      <span class="text-sm font-medium text-gray-900 dark:text-white">Quick Actions</span>
                    </div>
                    <div class="p-2">
                      <a href="{{ route('billings.page') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Bill
                      </a>
                      <a href="{{ route('all.products') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7" />
                        </svg>
                        Add Product
                      </a>
                      <a href="{{ route('all.categories') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Add Category
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Notifications -->
                <div class="relative" x-data="{ isOpen: false }">
                  <button
                    @click="isOpen = !isOpen"
                    class="p-2 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring transition-colors duration-200 relative"
                  >
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <!-- Notification badge -->
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                  </button>

                  <!-- Dropdown -->
                  <div style="z-index: 1000"
                    @click.away="isOpen = false"
                    x-show.transition.opacity="isOpen"
                    class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
                  >
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                      <span class="text-sm font-medium text-gray-900 dark:text-white">Notifications</span>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                      <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-start">
                          <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                              <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                              </svg>
                            </div>
                          </div>
                          <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">New order received</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Order #1234 has been placed</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">2 minutes ago</p>
                          </div>
                        </div>
                      </div>
                      <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-start">
                          <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                              <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                            </div>
                          </div>
                          <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Payment successful</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Payment for order #1233 completed</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">1 hour ago</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="p-3 border-t border-gray-200 dark:border-gray-700">
                      <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">View all notifications</a>
                    </div>
                  </div>
                </div>

                <!-- Reports & Analytics -->
                <div class="relative" x-data="{ isOpen: false }">
                  <button
                    @click="isOpen = !isOpen"
                    class="p-2 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring transition-colors duration-200"
                  >
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                  </button>

                  <!-- Dropdown -->
                  <div style="z-index: 1000"
                    @click.away="isOpen = false"
                    x-show.transition.opacity="isOpen"
                    class="absolute right-0 mt-3 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
                  >
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                      <span class="text-sm font-medium text-gray-900 dark:text-white">Reports & Analytics</span>
                    </div>
                                         <div class="p-2">
                       <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                         <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                         </svg>
                         Sales Report
                       </a>
                      <a href="{{ route('order.history') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Order History
                      </a>
                      <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>

                <!-- User Profile -->
                <div class="relative" x-data="{ isOpen: false }">
                  <button
                    @click="isOpen = !isOpen"
                    class="flex items-center space-x-2 p-2 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring transition-colors duration-200"
                  >
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                      <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300">{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <!-- Dropdown -->
                  <div style="z-index: 1000"
                    @click.away="isOpen = false"
                    x-show.transition.opacity="isOpen"
                    class="absolute right-0 mt-3 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
                  >
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                      <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                          <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="ml-3">
                          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                          <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="p-2">
                      <a href="{{ route('edit.profile') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Edit Profile
                      </a>
                      <a href="{{ route('settings') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                      </a>
                    </div>
                    <div class="p-2 border-t border-gray-200 dark:border-gray-700">
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-600 dark:text-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                          <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                          </svg>
                          Sign Out
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                        Revenue Analytics
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- User Profile -->
              <div class="relative" x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen" class="flex items-center space-x-2 p-2 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring transition-colors duration-200">
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="https://avatars0.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                    alt="User Profile"
                  />
                  <span class="hidden text-sm font-medium text-gray-700 dark:text-gray-300 lg:block">Admin</span>
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <!-- Online status dot -->
                <div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
                <div class="absolute right-0 p-1 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full bottom-3"></div>

                <!-- Dropdown -->
                <div style="z-index: 1000"
                  @click.away="isOpen = false"
                  x-show.transition.opacity="isOpen"
                  class="absolute right-0 mt-3 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
                >
                  <div class="flex flex-col p-4 space-y-1 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Admin User</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" x-text="settings ? settings.company_email : 'admin@reshma.com'"></span>
                  </div>
                  <div class="p-2">
                    <a href="{{ route('settings') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                      <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      Settings
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                      <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      Profile
                    </a>
                  </div>
                  <div class="p-2 border-t border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-600 dark:text-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign out
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
        <!-- Main content -->
        <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50 dark:bg-gray-900">
          @yield('content')
        </main>
        <!-- Main footer -->
        <footer class="flex items-center justify-between flex-shrink-0 p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 max-h-14">
          <div class="text-sm text-gray-600 dark:text-gray-400">
            © 2025 <span x-text="settings ? settings.company_name : 'arjun Crackers'"></span>. All rights reserved.
          </div>
          <div class="text-sm text-gray-600 dark:text-gray-400">
            Developed by Santhana Murugesh (8248384330)
          </div>
        </footer>
      </div>

      <div>
        <button
          @click="isSettingsPanelOpen = true"
          class="fixed right-0 px-4 py-2 text-sm font-medium text-white uppercase transform rotate-90 translate-x-8 bg-gray-600 dark:bg-gray-700 top-1/2 rounded-b-md hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors duration-200"
        >
          Settings
        </button>
      </div>

      <div
        x-show="isSettingsPanelOpen"
        @click.away="isSettingsPanelOpen = false"
        x-transition:enter="transition transform duration-300"
        x-transition:enter-start="translate-x-full opacity-30  ease-in"
        x-transition:enter-end="translate-x-0 opacity-100 ease-out"
        x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0 opacity-100 ease-out"
        x-transition:leave-end="translate-x-full opacity-0 ease-in"
        class="fixed inset-y-0 right-0 flex flex-col bg-white dark:bg-gray-800 shadow-lg bg-opacity-20 w-80 border-l border-gray-200 dark:border-gray-700"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
      >
        <div class="flex items-center justify-between flex-shrink-0 p-4 border-b border-gray-200 dark:border-gray-700">
          <h6 class="text-lg font-medium text-gray-900 dark:text-white">Settings</h6>
          <button @click="isSettingsPanelOpen = false" class="p-2 rounded-md focus:outline-none focus:ring hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
            <svg
              class="w-6 h-6 text-gray-600 dark:text-gray-300"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-1 max-h-full p-4 overflow-hidden hover:overflow-y-scroll">
          <div class="space-y-4">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
              <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Appearance</h3>
              <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Dark Mode</span>
                <button
                  @click="
                    darkMode = !darkMode;
                    localStorage.setItem('darkMode', darkMode);
                    if (darkMode) {
                      document.documentElement.classList.add('dark');
                    } else {
                      document.documentElement.classList.remove('dark');
                    }
                  "
                  class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200"
                  :class="darkMode ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'"
                >
                  <span
                    class="inline-block h-4 w-4 transform rounded-full bg-white transition duration-200"
                    :class="darkMode ? 'translate-x-6' : 'translate-x-1'"
                  ></span>
                </button>
              </div>
            </div>
            
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
              <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">General Settings</h3>
              <a href="{{ route('settings') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                Manage company settings →
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      const setup = () => {
        return {
          loading: true,
          isSidebarOpen: false,
          settings: null,
          darkMode: localStorage.getItem('darkMode') === 'true',
          toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen
          },
          isSettingsPanelOpen: false,
          isSearchBoxOpen: false,
          
          init() {
            this.loadSettings();
            // Sync with global dark mode state
            this.darkMode = this.$root.darkMode;
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
          }
        }
      }
    </script>
  </div>
</body>
</html>
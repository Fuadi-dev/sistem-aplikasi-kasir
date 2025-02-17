<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="min-h-screen">
    <div x-data="{ 
        isExpanded: localStorage.getItem('sidebarState') === 'true',
        currentPath: window.location.pathname
    }">
        <!-- Sidebar - Keep transition -->
        <aside 
            :class="isExpanded ? 'w-64' : 'w-20'"
            class="fixed top-0 left-0 h-screen transition-all duration-300 bg-white"
        >
            <!-- Toggle Button - Keep transition -->
            <button 
                @click="isExpanded = !isExpanded; localStorage.setItem('sidebarState', isExpanded)"
                class="absolute p-2 text-white transition-colors duration-200 bg-indigo-600 rounded-full shadow-lg -right-3 top-6 hover:bg-indigo-700 focus:outline-none"
            >
                <i class="ph-bold ph-caret-left" x-show="isExpanded"></i>
                <i class="ph-bold ph-caret-right" x-show="!isExpanded"></i>
            </button>

            <!-- Logo Section -->
            <div class="flex items-center p-4 mb-6">
                <i class="text-3xl text-indigo-600 ph-bold ph-storefront"></i>
                <span 
                    x-show="isExpanded"
                    x-transition
                    class="ml-3 text-xl font-bold text-gray-800"
                >
                Hallo! {{ Auth::user()->name }}
                </span>
            </div>

            <!-- Navigation Menu -->
            <nav class="px-4">
                <!-- Dashboard -->
                <a href="{{ url('/dashboard') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/dashboard',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/dashboard'
                    }"
                >
                    <i class="ph-bold ph-house" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Dashboard</span>
                </a>

                <!-- Transaksi -->
                <a href="{{ url('/transaksi') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/transaksi',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/transaksi'
                    }"
                >
                    <i class="ph-bold ph-shopping-cart" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Transaksi</span>
                </a>

                <!-- Pelanggan -->
                <a href="{{ url('/pelanggan') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/pelanggan',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/pelanggan'
                    }"
                >
                    <i class="ph-bold ph-users" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Member</span>
                </a>

              <!-- Penjualan -->
                <a href="{{ url('/penjualan') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/penjualan',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/penjualan'
                    }"
                >
                    <i class="ph-bold ph-chart-line-up" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Penjualan</span>
                </a>

                @if (Auth::user()->role == 'admin')
                    
                
                <!-- Pengguna -->
                <a href="{{ url('/pengguna') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/pengguna',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/pengguna'
                    }"
                >
                    <i class="ph-bold ph-user-circle" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Pengguna</span>
                </a>

                <!-- Produk -->
                <a href="{{ url('/produk') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/produk',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/produk'
                    }"
                >
                    <i class="ph-bold ph-package" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Produk</span>
                </a>
                <!-- Laporan -->
                <a href="{{ url('/laporan') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-opacity-80"
                    :class="{
                        'bg-indigo-600 text-white': currentPath === '/laporan',
                        'text-gray-700 hover:bg-indigo-50': currentPath !== '/laporan'
                    }"
                >
                    <i class="ph-bold ph-file-text" :class="isExpanded ? '' : 'mx-auto'"></i>
                    <span x-show="isExpanded" class="ml-3">Laporan</span>
                </a>
                @endif
            </nav>





           <!-- Footer Section -->
<div class="absolute bottom-0 left-0 right-0 p-4">
    <!-- Logout Button -->
    <a href="{{ url('/logout') }}"
        class="flex items-center w-full px-4 py-3 text-gray-800 transition-colors duration-200 bg-gray-300 rounded-lg active:bg-red-600 active:text-white"
    >
        <i class="ph-bold ph-sign-out" :class="isExpanded ? '' : 'mx-auto'"></i>
        <span x-show="isExpanded" class="ml-3">Logout</span>
    </a>
</div>

        </aside>

        <!-- Main Content -->
        <main :class="isExpanded ? 'ml-64' : 'ml-20'" class="p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

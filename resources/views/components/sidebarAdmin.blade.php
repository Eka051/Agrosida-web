 <!-- Sidebar -->
 <aside class="w-56 h-screen bg-greenPrimary text-black fixed shadow-lg border-r border-green-700 transition-all duration-300 ease-in-out">
    <div class="p-6 text-center border-b border-green-700">
        <h1 class="text-2xl font-extrabold text-green-900 tracking-wider uppercase">
            AGROSIDA
        </h1>
    </div>
    <nav class="mt-8 px-4">
        <ul class="space-y-3">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === 'admin.dashboard' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('admin.userManagement') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === 'admin.userManagement' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola Pengguna
                </a>
            </li>
            <li>
                <a href="{{ route('admin.view-product') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === 'admin.view-product' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Kelola Produk
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('#') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === '#' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                    </svg>
                    Kelola Transaksi
                </a>
            </li> --}}
            <li>
                <a href="{{ route('admin.view-category') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === 'admin.view-category' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15l2 2 4-4" />
                    </svg>
                    Kelola Kategori Produk
                </a>
            </li>
            <li>
                <a href="{{ route('pesticide.form') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === 'pesticide.form' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Kelola Kalkulasi
                </a>
            </li>
            <li>
                <a href="{{ route('detect.form') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200
                    {{ Route::currentRouteName() === 'detect.form' ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-100 text-green-900 hover:text-green-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                    </svg>
                    Deteksi Penyakit
                </a>
            </li>
            <li class="mt-4 pt-4 border-t border-green-300">
                <a href="{{ route('logout') }}" class="group flex items-center py-3 px-4 rounded-lg transition-all duration-200 text-red-600 hover:bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</aside>

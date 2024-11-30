@extends('components.template')
@extends('components.navbar')
@section('title', 'Katalog')
@section('content')

<div class ="katalog bg-green-100 mt-24">
    <form class="max-w-lg mx-auto mt-16">
        <div class="flex">
            <!-- Dropdown Button -->
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-white bg-green-500 border border-green-400 rounded-s-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-200" type="button">
                All categories
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdown" class="z-10 hidden bg-green-100 divide-y divide-green-200 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-white dark:text-white" aria-labelledby="dropdown-button">
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 bg-green-400 hover:bg-green-500 text-white rounded-lg">Mockups</button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 bg-green-400 hover:bg-green-500 text-white rounded-lg">Templates</button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 bg-green-400 hover:bg-green-500 text-white rounded-lg">Design</button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex w-full px-4 py-2 bg-green-400 hover:bg-green-500 text-white rounded-lg">Logos</button>
                    </li>
                </ul>
            </div>

            <!-- Search Input -->
            <div class="relative w-full">
                <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-white bg-green-500 border-s-green-400 rounded-e-lg border-s-2 focus:ring-green-300 focus:border-green-300 placeholder-white" placeholder="Search Mockups, Logos, Design Templates..." required />
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-green-600 rounded-e-lg border border-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>

    <section class="product_container bg-gradient-to-r from-greenPrimary to-green-600 text-white pt-10 pb-20 relative overflow-hidden">
        <h2 class="text-3xl font-bold text-white-800 mb-12 text-center">
            Rekomendasi Produk
        </h2>
        <div class="container mx-auto px-6">
            <!-- Tab Navigation -->
            <div class="flex space-x-4 mb-8">
                <button class="tab-btn px-6 py-2 rounded-md text-white bg-orange-500 hover:bg-orange-600 transition">Pestisida</button>
                <button class="tab-btn px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600 transition">Pestisida</button>
                <button class="tab-btn px-6 py-2 rounded-md text-white bg-purple-500 hover:bg-purple-600 transition">Pestisida</button>
                <button class="tab-btn px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600 transition">Pestisida</button>
            </div>

            <!-- Product Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <!-- Card 1 -->
                <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

                 <!-- Card 1 -->
                 <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                    <img src="img/pestisida-sample.jpeg" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                    <h3 class="text-lg font-bold mb-0 text-black">Pestisida Cap Badak</h3>
                    <p class="text-gray-700 mb-0">Organik</p>
                    <div class="text-red-600 font-bold mb-0">Rp60.000</div>
                    <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">100+ terjual</span>
                    </div>
                    <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
                </div>

            </div>
        </div>
    </section>

</div>

@include('components.footer')
@endsection

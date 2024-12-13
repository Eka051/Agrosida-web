@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Admin Dashboard')
@section('content')

<main class="mt-24 ml-56 flex-1 bg-gray-100 min-h-full">
    <!-- Header -->
    <div class="ml-5">
        <h1 class="text-4xl font-bold">Dashboard Admin</h1>
        <p class="text-lg">Selamat datang {{ auth()->user()->name }}, kelola marketplace Anda dengan mudah.</p>
    </div>

    <div class="mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2 xl:grid-cols-4">
        <!-- card -->
        <div class="shadow bg-white py-5">
           <!-- card body -->
           <div class="card-body ml-5">
              <!-- content -->
              <div class="flex justify-between items-center">
                 <h4 class="text-xl">Total Produk</h4>
                 <div class="bg-green-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                    <i data-feather="briefcase"></i>
                 </div>
              </div>
              <div class="mt-4 flex flex-col gap-0 text-base">
                 <h2 class="text-3xl font-bold">{{ $totalProduct }}</h2>
                 <div>
                    <span class="text-gray-500 text-lg">Produk</span>
                 </div>
              </div>
           </div>
        </div>
        <!-- card -->
        <div class="card shadow bg-white py-5">
            <!-- card body -->
            <div class="card-body ml-5">
               <!-- content -->
               <div class="flex justify-between items-center">
                  <h4 class="text-xl">Total Transaksi</h4>
                  <div class="bg-green-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                     <i data-feather="briefcase"></i>
                  </div>
               </div>
               <div class="mt-4 flex flex-col gap-0 text-base">
                  <h2 class="text-3xl font-bold">{{ $totalOrder }}</h2>
                  <div>
                     <span class="text-gray-500 text-lg">Transaksi</span>
                  </div>
               </div>
            </div>
         </div>
        <div class="card shadow bg-white py-5">
            <!-- card body -->
            <div class="card-body ml-5">
               <!-- content -->
               <div class="flex justify-between items-center">
                  <h4 class="text-xl">Total Pendapatan</h4>
                  <div class="bg-green-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                     <i data-feather="briefcase"></i>
                  </div>
               </div>
               <div class="mt-4 flex flex-col gap-0 text-base">
                  <h2 class="text-3xl font-bold">Rp. {{ number_format($balance, 0, ',', '.') }}</h2>
                  <div>
                     <span class="text-gray-500 text-lg">Dari {{ $totalOrder }} Transaksi</span>
                  </div>
               </div>
            </div>
         </div>
     </div>

    <!-- Recent Orders & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Orders -->
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Recent Orders</h3>
            <ul>
                {{-- @foreach($recentOrders as $order)
                    <li class="flex justify-between mb-2">
                        <span>Order #{{ $order->id }}</span>
                        <span class="text-{{ $order->status_color }} font-medium">{{ $order->status }}</span>
                    </li>
                @endforeach --}}
            </ul>
        </div>
        <!-- Top Products -->
        <div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Top Products</h3>
            <ul>
                {{-- @foreach($topProducts as $product)
                    <li class="flex justify-between mb-2">
                        <span>{{ $product->name }}</span>
                        <span class="text-blue-500 font-medium">{{ $product->sales }} Sales</span>
                    </li>
                @endforeach --}}
            </ul>
        </div>
    </div>
</main>

@endsection
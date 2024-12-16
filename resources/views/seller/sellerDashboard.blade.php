@extends('components.template')
@include('components.sidebarSeller')
@section('title', 'Seller Dashboard')
@section('content')

<div class="ml-64 flex-1">
    <section class="bg-green-100 p-8 text-center mt-20">
        <h1 class="text-4xl font-bold text-gray-800">Dashboard Penjual</h1>
        <p class="text-gray-600">Kelola produk Anda dengan mudah</p>
        <div class="mt-4 flex justify-center">
            <input type="text" placeholder="Cari produk Anda"
                class="p-2 rounded-l border border-gray-300 w-1/2 md:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500">
            <button class="bg-green-500 text-white px-4 py-2 rounded-r hover:bg-green-600 transition duration-300">Search</button>
        </div>
    </section>

    <section class="py-8">
        <div class="flex justify-between items-center mx-8">
            <h2 class="text-3xl font-semibold text-gray-800">Produk Anda</h2>
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300"
                onclick="window.location.href='{{ route('seller.add-product') }}'">Tambah Produk</button>
        </div>
    </section>
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

<!-- Chart Section -->
<div class="bg-white p-6 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition mt-6 mx-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-700">Pendapatan dan Orderan</h3>
    <div id="seller-area-chart"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Pendapatan',
                data: @json($formattedIncomeData)
            }, {
                name: 'Orderan',
                data: @json($formattedOrderData)
            }],
            xaxis: {
                categories: @json($categories)
            },
            colors: ['#34D399', '#60A5FA'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#seller-area-chart"), options);
        chart.render();
    });
</script>

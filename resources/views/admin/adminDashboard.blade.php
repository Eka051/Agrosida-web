@extends('components.template')
@include('components.sidebarAdmin')
@section('title', 'Admin Dashboard')
@section('content')

<div class="ml-64 flex-1 mt-16 bg-gray-100 h-screen">
  <section class="p-8">
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-800 lg:text-4xl">Dashboard Admin</h1>
        <p class="text-lg">Selamat datang {{ auth()->user()->name }}, kelola marketplace Anda dengan mudah.</p>
    </div>
  </section>

  <div class="mt-4 mx-6 mb-6 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2 xl:grid-cols-4">
    <div class="shadow bg-white py-5">
      <div class="card-body ml-5">
        <div class="flex justify-between items-center">
          <h4 class="text-xl">Total User</h4>
          <div class="bg-greenPrimary mr-6 bg-opacity-50 rounded-md h-16 w-16 flex items-center justify-center text-center">
            <span class="iconify text-[3rem] text-greenSecondary" data-icon="ic:twotone-people-alt" data-inline="false"></span>
          </div>
        </div>
        <div class="mt-4 flex flex-col gap-0 text-base">
          <h2 class="text-3xl font-bold">{{ $totalCustomer }}</h2>
          <div>
            <span class="text-gray-500 text-lg">User</span>
          </div>
        </div>
      </div>
    </div>
    <div class="shadow bg-white py-5">
      <div class="card-body ml-5">
        <div class="flex justify-between items-center">
          <h4 class="text-xl">Total Produk</h4>
          <div class="bg-greenPrimary mr-6 bg-opacity-50 rounded-md h-16 w-16 flex items-center justify-center text-center">
            <span class="iconify text-[3rem] text-greenSecondary" data-icon="solar:box-bold-duotone" data-inline="false"></span>
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
    <div class="card shadow bg-white py-5">
      <div class="card-body ml-5">
      <div class="flex justify-between items-center">
        <h4 class="text-xl">Total Transaksi</h4>
        <div class="bg-greenPrimary mr-6 bg-opacity-50 rounded-md h-16 w-16 flex items-center justify-center text-center">
          <span class="iconify text-[3rem] text-greenSecondary" data-icon="tdesign:undertake-transaction-filled" data-inline="false"></span>
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
      <div class="card-body ml-5">
      <div class="flex justify-between items-center">
        <h4 class="text-xl">Total Pendapatan</h4>
        <div class="bg-greenPrimary mr-6 bg-opacity-50 rounded-md h-16 w-16 flex items-center justify-center text-center">
          <span class="iconify text-[3rem] text-greenSecondary" data-icon="f7:money-dollar-circle-fill" data-inline="false"></span>
        </div>
      </div>
      <div class="mt-4 flex flex-col gap-0 text-base">
        <h2 class="text-3xl font-bold">Rp. {{ number_format($balance, 0, ',', '.') }}</h2>
        <div>
          <span class="text-gray-500 text-lg">Dari 12 Transaksi</span>
        </div>
      </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-2 gap-4 mx-6 mb-6">
    <div class="bg-white p-4 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition">
      <h3 class="text-lg font-semibold mb-4 text-gray-700">Transaksi dan Pelanggan</h3>
      <div id="order-customer-chart"></div>
    </div>
    
    <div class="bg-white p-4 shadow-md border border-gray-200 rounded-lg hover:shadow-lg transition">
      <h3 class="text-lg font-semibold mb-4 text-gray-700">Pendapatan dan Produk</h3>
      <div id="balance-product-chart"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var orderCustomerOptions = {
      chart: {
        type: 'area',
        height: 350,
        toolbar: {
          show: false
        }
      },
      series: [{
        name: 'Transaksi',
        data: @json($formattedOrderData)
      }, {
        name: 'Pelanggan',
        data: @json($formattedCustomerData)
      }],
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
      }
    };

    var balanceProductOptions = {
      chart: {
        type: 'line',
        height: 350,
        toolbar: {
          show: false
        }
      },
      series: [{
        name: 'Pendapatan',
        data: @json($formattedBalanceData)
      }, {
        name: 'Produk',
        data: @json($formattedProductData)
      }],
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      },
      colors: ['#F59E0B', '#EC4899'],
      markers: {
        size: 4
      },
      stroke: {
        curve: 'smooth'
      },
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
      }
    };

    var orderCustomerChart = new ApexCharts(document.querySelector("#order-customer-chart"), orderCustomerOptions);
    var balanceProductChart = new ApexCharts(document.querySelector("#balance-product-chart"), balanceProductOptions);
    
    orderCustomerChart.render();
    balanceProductChart.render();
  });
</script>
@endsection
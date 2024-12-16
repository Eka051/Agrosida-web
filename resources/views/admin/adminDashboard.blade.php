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
            <!-- Legend Indicator -->
               <div class="flex justify-center sm:justify-end items-center gap-x-4 mb-3 sm:mb-6">
                  <div class="inline-flex items-center">
                  <span class="size-2.5 inline-block bg-blue-600 rounded-sm me-2"></span>
                  <span class="text-[13px] text-gray-600">
                     Income
                  </span>
                  </div>
                  <div class="inline-flex items-center">
                  <span class="size-2.5 inline-block bg-purple-600 rounded-sm me-2"></span>
                  <span class="text-[13px] text-gray-600">
                     Outcome
                  </span>
                  </div>
               </div>
               <!-- End Legend Indicator -->
 
 <div id="hs-multiple-area-charts"></div>
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
<script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

<script>
  window.addEventListener('load', () => {
    (function () {
      buildChart('#hs-multiple-area-charts', (mode) => ({
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          }
        },
        series: [
          {
            name: 'Income',
            data: [18000, 51000, 60000, 38000, 88000, 50000, 40000, 52000, 88000, 80000, 60000, 70000]
          },
          {
            name: 'Outcome',
            data: [27000, 38000, 60000, 77000, 40000, 50000, 49000, 29000, 42000, 27000, 42000, 50000]
          }
        ],
        legend: {
          show: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight',
          width: 2
        },
        grid: {
          strokeDashArray: 2
        },
        fill: {
          type: 'gradient',
          gradient: {
            type: 'vertical',
            shadeIntensity: 1,
            opacityFrom: 0.1,
            opacityTo: 0.8
          }
        },
        xaxis: {
          type: 'category',
          tickPlacement: 'on',
          categories: [
            '25 January 2023',
            '26 January 2023',
            '27 January 2023',
            '28 January 2023',
            '29 January 2023',
            '30 January 2023',
            '31 January 2023',
            '1 February 2023',
            '2 February 2023',
            '3 February 2023',
            '4 February 2023',
            '5 February 2023'
          ],
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            stroke: {
              dashArray: 0
            },
            dropShadow: {
              show: false
            }
          },
          tooltip: {
            enabled: false
          },
          labels: {
            style: {
              colors: '#9ca3af',
              fontSize: '13px',
              fontFamily: 'Inter, ui-sans-serif',
              fontWeight: 400
            },
            formatter: (title) => {
              let t = title;

              if (t) {
                const newT = t.split(' ');
                t = `${newT[0]} ${newT[1].slice(0, 3)}`;
              }

              return t;
            }
          }
        },
        yaxis: {
          labels: {
            align: 'left',
            minWidth: 0,
            maxWidth: 140,
            style: {
              colors: '#9ca3af',
              fontSize: '13px',
              fontFamily: 'Inter, ui-sans-serif',
              fontWeight: 400
            },
            formatter: (value) => value >= 1000 ? `${value / 1000}k` : value
          }
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy'
          },
          y: {
            formatter: (value) => `$${value >= 1000 ? `${value / 1000}k` : value}`
          },
          custom: function (props) {
            const { categories } = props.ctx.opts.xaxis;
            const { dataPointIndex } = props;
            const title = categories[dataPointIndex].split(' ');
            const newTitle = `${title[0]} ${title[1]}`;

            return buildTooltip(props, {
              title: newTitle,
              mode,
              hasTextLabel: true,
              wrapperExtClasses: 'min-w-28',
              labelDivider: ':',
              labelExtClasses: 'ms-2'
            });
          }
        },
        responsive: [{
          breakpoint: 568,
          options: {
            chart: {
              height: 300
            },
            labels: {
              style: {
                colors: '#9ca3af',
                fontSize: '11px',
                fontFamily: 'Inter, ui-sans-serif',
                fontWeight: 400
              },
              offsetX: -2,
              formatter: (title) => title.slice(0, 3)
            },
            yaxis: {
              labels: {
                align: 'left',
                minWidth: 0,
                maxWidth: 140,
                style: {
                  colors: '#9ca3af',
                  fontSize: '11px',
                  fontFamily: 'Inter, ui-sans-serif',
                  fontWeight: 400
                },
                formatter: (value) => value >= 1000 ? `${value / 1000}k` : value
              }
            },
          },
        }]
      }), {
        colors: ['#2563eb', '#9333ea'],
        fill: {
          gradient: {
            stops: [0, 90, 100]
          }
        },
        xaxis: {
          labels: {
            style: {
              colors: '#9ca3af'
            }
          }
        },
        yaxis: {
          labels: {
            style: {
              colors: '#9ca3af'
            }
          }
        },
        grid: {
          borderColor: '#e5e7eb'
        }
      }, {
        colors: ['#3b82f6', '#a855f7'],
        fill: {
          gradient: {
            stops: [100, 90, 0]
          }
        },
        xaxis: {
          labels: {
            style: {
              colors: '#a3a3a3',
            }
          }
        },
        yaxis: {
          labels: {
            style: {
              colors: '#a3a3a3'
            }
          }
        },
        grid: {
          borderColor: '#404040'
        }
      });
    })();
  });
</script>

@endsection
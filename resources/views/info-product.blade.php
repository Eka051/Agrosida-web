@extends('components.template')
@extends('components.navbar')
@section('title', 'Katalog')
@section('content')
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto p-4 bg-white shadow-md mt-32 mb-32">
      <!-- Breadcrumb -->
      <nav class="text-sm text-gray-500 mb-4">
        <a href="#" class="hover:underline text-blue-500">Home</a> >
        <a href="#" class="hover:underline text-blue-500">Pertanian</a> >
        <a href="#" class="hover:underline text-blue-500">Pestisida</a>
      </nav>

      <!-- Product Details -->
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Product Images -->
        <div class="flex-1">
          <img src="img/pestisida-sample.jpeg" alt="Pestisida Cap Badak" class="w-full border rounded mb-4">
          <div class="flex gap-2">
            <img src="img/pestisida-sample.jpeg" alt="Thumbnail 1" class="w-16 h-16 border rounded">
            <img src="img/pestisida-sample.jpeg" alt="Thumbnail 2" class="w-16 h-16 border rounded">
            <img src="img/pestisida-sample.jpeg" alt="Thumbnail 3" class="w-16 h-16 border rounded">
            <img src="img/pestisida-sample.jpeg" alt="Thumbnail 4" class="w-16 h-16 border rounded">
          </div>
        </div>

        <!-- Product Info -->
        <div class="flex-1">
          <h1 class="text-2xl font-semibold mb-2">Pestisida Cap Badak</h1>
          <p class="text-sm text-gray-600 mb-4">Organik • Efektif mengendalikan hama</p>
          <p class="text-3xl text-orange-600 font-bold mb-6">Rp60.000</p>

          <div class="mb-6 space-y-2 text-sm">
            <p><span class="font-medium">Jenis:</span> Organik</p>
            <p><span class="font-medium">Manfaat:</span> Membasmi hama secara efektif</p>
            <p><span class="font-medium">Isi:</span> 500 ml</p>
          </div>

          <!-- Actions -->
          <div class="flex items-center gap-4 mb-6">
            <div>
              <p class="text-gray-600 text-sm">Stok Tersisa: <span class="font-bold text-red-500">100+</span></p>s
            </div>
            <input type="number" min="1" max="100" value="1" class="w-16 border rounded p-1 text-center">
          </div>
          <div class="flex gap-4">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Keranjang</button>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Beli</button>
          </div>

          <!-- Seller Info -->
          <div class="mt-6 text-sm text-gray-600">
            <p>Dijual oleh: <span class="font-medium">Toko Pertanian Sejahtera</span></p>
          </div>
        </div>
      </div>
    </div>
  </body>

@include('components.footer')
@endsection

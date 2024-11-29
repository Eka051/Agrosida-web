@extends('components.navbar')
@extends('components.template')
@section('title', 'Agrosida')
@section('content')

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<div class="landing-page bg-gray-100 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-to-r from-greenPrimary to-green-600 text-white pt-32 pb-20 relative overflow-hidden">
        <div class="container mx-auto text-center px-6 relative z-10">
            <!-- Heading -->
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                Selamat Datang di <span class="text-yellow-300">AGROSIDA</span>
            </h1>
            <!-- Subheading -->
            <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto">
                Solusi terbaik untuk produktivitas dan pertumbuhan. Mulailah perjalanan Anda bersama kami hari ini!
            </p>
            <!-- Call to Action Button -->
            <a href="/#"
               class="inline-block bg-greenPrimary text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-yellow-400 transition duration-300 transform hover:-translate-y-1">
                Mulai Sekarang
            </a>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-32 h-32 bg-yellow-300 rounded-full blur-lg opacity-30"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-white rounded-full blur-2xl opacity-20"></div>
        <div class="absolute top-10 right-10 w-40 h-40 bg-yellow-400 rounded-full blur-xl opacity-30"></div>
    </section>

    <section class="calculate py-16 bg-green-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
                Hitung Penggunaan Pestisida
            </h2>
            <div class="flex flex-col md:flex-row items-start justify-center gap-8">

                <!-- Tentang Kami -->
                <div class="about-us w-full md:w-1/2 bg-gradient-to-br from-green-600 to-green-400 text-white text-center py-12 px-8 rounded-lg shadow-xl">
                    <div class="px-6">
                        <p class="text-lg leading-relaxed mb-8">
                            Di AGROSIDA, kami percaya bahwa pertanian yang berkelanjutan adalah kunci masa depan yang lebih baik.
                            Kami hadir untuk mendukung petani Indonesia dengan teknologi modern dan solusi ramah lingkungan,
                            membantu Anda meningkatkan hasil panen tanpa merusak alam.
                        </p>
                        <p class="text-lg leading-relaxed mb-8">
                            Bergabunglah bersama kami dalam menciptakan masa depan pertanian yang hijau, efisien, dan penuh inovasi.
                            Mari bersama melangkah menuju perubahan yang lebih baik!
                        </p>
                        <a href="/#"
                           class="bg-white text-green-600 font-semibold py-3 px-8 rounded-full shadow-md
                                  hover:bg-green-100 hover:scale-105 transition-transform duration-300">
                           Bergabung Sekarang
                        </a>
                    </div>
                </div>


                <!-- Kalkulator -->
                <div class="calculator w-full md:w-1/2 bg-white shadow-lg rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800 text-center">Kalkulator Luas Lahan</h3>

                    <!-- Input Luas Lahan -->
                    <div class="mb-4">
                        <label for="length" class="block text-gray-600 font-medium mb-1">Panjang Lahan (m)</label>
                        <input type="number" id="length" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan panjang">
                    </div>
                    <div class="mb-4">
                        <label for="width" class="block text-gray-600 font-medium mb-1">Lebar Lahan (m)</label>
                        <input type="number" id="width" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan lebar">
                    </div>

                    <!-- Input Kebutuhan Pestisida -->
                    <div class="mb-4">
                        <label for="pesticide-rate" class="block text-gray-600 font-medium mb-1">Pestisida per m² (gram)</label>
                        <input type="number" id="pesticide-rate" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan jumlah pestisida">
                    </div>

                    <!-- Tombol Hitung -->
                    <button id="calculate" class="w-full py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-700 transition">
                        Hitung
                    </button>

                    <!-- Hasil -->
                    <div id="result" class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded hidden transition-all duration-300 opacity-0">
                        <p class="text-gray-700 font-medium">
                            Luas Lahan: <span id="area" class="text-green-500 font-bold">0</span> m²
                        </p>
                        <p class="text-gray-700 font-medium">
                            Kebutuhan Pestisida: <span id="pesticide-amount" class="text-green-500 font-bold">0</span> gram
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Event listener untuk kalkulasi
            const calculateButton = document.getElementById("calculate");
            calculateButton.addEventListener("click", function () {
                const length = parseFloat(document.getElementById("length").value) || 0;
                const width = parseFloat(document.getElementById("width").value) || 0;
                const pesticideRate = parseFloat(document.getElementById("pesticide-rate").value) || 0;

                if (length > 0 && width > 0 && pesticideRate > 0) {
                    const area = length * width;
                    const pesticideAmount = area * pesticideRate;

                    // Tampilkan hasil
                    document.getElementById("area").innerText = area.toFixed(2);
                    document.getElementById("pesticide-amount").innerText = pesticideAmount.toFixed(2);
                    const resultDiv = document.getElementById("result");
                    resultDiv.classList.remove("hidden");
                    resultDiv.classList.add("opacity-100");
                } else {
                    alert("Mohon isi semua nilai dengan benar.");
                }
            });
        });
    </script>



    <section class="client">
        <div class="bg-green-50 py-10">
            <!-- Bagian: Kelola kebutuhan pertanian Anda -->
            <div class="text-center mb-12">
              <h2 class="text-3xl font-bold text-gray-800 mb-4">Kelola kebutuhan pertanian Anda dengan mudah</h2>
              <p class="text-gray-600">Siapa saja yang cocok menggunakan layanan kami?</p>
            </div>

            <!-- Kartu Fitur -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
              <!-- Kartu 1 -->
              <div class="bg-white p-6 shadow rounded-lg text-center">
                <div class="mb-4">
                  <div class="bg-green-100 text-green-600 p-4 inline-block rounded-full">
                    <!-- Ikon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4m-2 0a6 6 0 1112 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4z" />
                    </svg>
                  </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Petani Mandiri</h3>
                <p class="text-gray-600">Pestisida organik kami membantu petani mandiri meningkatkan hasil panen secara alami.</p>
              </div>
              <!-- Kartu 2 -->
              <div class="bg-white p-6 shadow rounded-lg text-center">
                <div class="mb-4">
                  <div class="bg-green-100 text-green-600 p-4 inline-block rounded-full">
                    <!-- Ikon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m8 7h3m-3 4h3" />
                    </svg>
                  </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Kelompok Tani</h3>
                <p class="text-gray-600">Kami menyediakan solusi yang mudah dikelola untuk komunitas petani.</p>
              </div>
              <!-- Kartu 3 -->
              <div class="bg-white p-6 shadow rounded-lg text-center">
                <div class="mb-4">
                  <div class="bg-green-100 text-green-600 p-4 inline-block rounded-full">
                    <!-- Ikon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21V7a2 2 0 00-2-2H6a2 2 0 00-2 2v14l4-4h8l4 4z" />
                    </svg>
                  </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Bisnis Pertanian</h3>
                <p class="text-gray-600">Dukung pertanian organik skala besar dengan produk pestisida terpercaya kami.</p>
              </div>
            </div>
          </div>
    </section>



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

            </div>
        </div>
    </section>
</div>


@include('components.footer')
@endsection

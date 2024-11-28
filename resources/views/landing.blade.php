@extends('components.navbar')
@extends('components.template')
@section('title', 'Agrosida')
@section('content')

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
        document.addEventListener("DOMContentLoaded", function () {
            const numberInputs = document.querySelectorAll('input[type="number"]');
            numberInputs.forEach((input) => {
                // Hilangkan spinner
                input.style.appearance = "none";
                input.style.MozAppearance = "textfield";
                input.style.WebkitAppearance = "none";

                // Cegah scroll dengan mouse wheel
                input.addEventListener("wheel", (event) => event.preventDefault());
            });

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

<footer class="p-4 bg-green-50 sm:p-6">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="#" class="flex items-center">
                    <img src="Img\LOGO-AGROSIDA.png" class="mr-3 h-8" alt="Agrosida Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">Agrosida</span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Resources</h2>
                    <ul class="text-gray-500">
                        <li class="mb-4">
                            <a href="https://flowbite.com" class="hover:underline">Flowbite</a>
                        </li>
                        <li>
                            <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Follow us</h2>
                    <ul class="text-gray-500">
                        <li class="mb-4">
                            <a href="https://github.com/themesberg/flowbite" class="hover:underline">Github</a>
                        </li>
                        <li>
                            <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Legal</h2>
                    <ul class="text-gray-500">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-300 sm:mx-auto lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="#" class="hover:underline">Agrosida™</a>. All Rights Reserved.</span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                </a>
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                </a>
            </div>
        </div>
    </div>
</footer>



@endsection

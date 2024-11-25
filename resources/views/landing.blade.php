@extends('components.template')
@section('title', 'Agrosida')
@section('content')

<div class="landing-page bg-gray-100 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section bg-greenPrimary text-white pt-24 pb-16">
        <div class="container mx-auto text-center px-6">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di AGROSIDA</h1>
            <p class="text-lg mb-8">Solusi terbaik untuk produktivitas dan pertumbuhan. Mulailah perjalanan Anda bersama kami hari ini!</p>
            <a href="/#" class="bg-white text-greenPrimary font-semibold py-2 px-6 rounded-lg hover:bg-green-100 transition duration-200">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-12">Rekomendasi Produk</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <!-- Feature 1 -->
                <div class="product-card bg-white shadow-lg rounded-lg overflow-hidden w-[14rem] h-auto group">
                    <div class="relative">
                        <img src="img/product-img/pupuk.jpg" alt="Product Image" class="w-[8rem] h-[8rem] m-auto object-cover rounded">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="View Product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="Add to Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 text-gray-800 hover:text-primary transition">Nama Produk</h3>
                        <div class="flex items-baseline mb-2 space-x-2">
                            <p class="text-lg text-primary font-semibold">Rp. 150.000</p>
                            <p class="text-sm text-gray-400 line-through">Rp. 200.000</p>
                        </div>
                        <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-transparent hover:text-primary border border-primary transition">Beli Sekarang</a>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="product-card bg-white shadow-lg rounded-lg overflow-hidden w-[14rem] h-auto group">
                    <div class="relative">
                        <img src="img/product-img/pupuk.jpg" alt="Product Image" class="w-[8rem] h-[8rem] m-auto object-cover rounded">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="View Product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="Add to Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 text-gray-800 hover:text-primary transition">Nama Produk</h3>
                        <div class="flex items-baseline mb-2 space-x-2">
                            <p class="text-lg text-primary font-semibold">Rp. 150.000</p>
                            <p class="text-sm text-gray-400 line-through">Rp. 200.000</p>
                        </div>
                        <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-transparent hover:text-primary border border-primary transition">Beli Sekarang</a>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="product-card bg-white shadow-lg rounded-lg overflow-hidden w-[14rem] h-auto group">
                    <div class="relative">
                        <img src="img/product-img/pupuk.jpg" alt="Product Image" class="w-[8rem] h-[8rem] m-auto object-cover rounded">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="View Product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="Add to Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 text-gray-800 hover:text-primary transition">Nama Produk</h3>
                        <div class="flex items-baseline mb-2 space-x-2">
                            <p class="text-lg text-primary font-semibold">Rp. 150.000</p>
                            <p class="text-sm text-gray-400 line-through">Rp. 200.000</p>
                        </div>
                        <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-transparent hover:text-primary border border-primary transition">Beli Sekarang</a>
                    </div>
                </div>
                   <!-- Feature 4 -->
                <div class="product-card bg-white shadow-lg rounded-lg overflow-hidden w-[14rem] h-auto group">
                    <div class="relative">
                        <img src="img/product-img/pupuk.jpg" alt="Product Image" class="w-[8rem] h-[8rem] m-auto object-cover rounded">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="View Product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#" class="text-white text-sm w-9 h-9 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="Add to Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 text-gray-800 hover:text-primary transition">Nama Produk</h3>
                        <div class="flex items-baseline mb-2 space-x-2">
                            <p class="text-lg text-primary font-semibold">Rp. 150.000</p>
                            <p class="text-sm text-gray-400 line-through">Rp. 200.000</p>
                        </div>
                        <a href="#" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-transparent hover:text-primary border border-primary transition">Beli Sekarang</a>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <section class="product-container bg-greenPrimary">
        <div >

        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-greenPrimary text-white py-16">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-3xl font-bold mb-4">Siap Bergabung?</h2>
            <p class="text-lg mb-8">Daftar sekarang dan ambil langkah pertama menuju alur kerja yang lebih cerdas.</p>
            <a href="/register" class="bg-white text-greenPrimary font-semibold py-3 px-8 rounded-lg hover:bg-green-100 transition duration-200">Buat Akun</a>
        </div>
    </section>
</div>





<!-- ========== FOOTER ========== -->
<footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <!-- Grid -->
    <div class="text-center">
      <div>
        <a class="flex-none text-xl font-semibold text-black dark:text-white" href="#" aria-label="Brand">Brand</a>
      </div>
      <!-- End Col -->

      <div class="mt-3">
        <p class="text-gray-500 dark:text-neutral-500">Mari gunakan <a class= text-greenPrimary decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="#">AGROSIDA</a>
        <p class="text-gray-500 dark:text-neutral-500">
          © 2024 Agrosida.
        </p>
      </div>

      <!-- Social Brands -->
      <div class="mt-3 space-x-2">
        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
          </svg>
        </a>
        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
          </svg>
        </a>
        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
          </svg>
        </a>
        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z"/>
          </svg>
        </a>
      </div>
      <!-- End Social Brands -->
    </div>
    <!-- End Grid -->
  </footer>
  <!-- ========== END FOOTER ========== -->
@endsection

<header class="w-full bg-greenSecondary py-4 fixed top-0 left-0 right-0 z-50 shadow-md">
    <nav class="container mx-auto flex items-center justify-between px-4">
        <!-- Logo dan Nama -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/LOGO-AGROSIDA.png') }}" alt="logo-agrosida" class="w-14">
            <a href="/" class="text-2xl sm:text-4xl font-bold text-greenPrimary">AGRO<span class="text-white">SIDA</span></a>
        </div>
        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center justify-center space-x-8">
            <ul class="flex space-x-8">
                <li><a href="{{ route('seller.dashboard') }}" class="text-white hover:text-greenPrimary">Beranda</a></li>
                <li><a href="/tentang" class="text-white hover:text-greenPrimary">Layanan</a></li>
                <li><a href="/fitur" class="text-white hover:text-greenPrimary">Fitur</a></li>
                <li><a href="/kontak" class="text-white hover:text-greenPrimary">Tentang Kami</a></li>
            </ul>
        </div>
        <!-- Tombol Masuk -->
        <div class="hidden md:flex items-center">
            <a href="{{ route('login') }}" class="bg-greenPrimary py-2 rounded-md px-6 text-white font-semibold hover:bg-green-700">Masuk</a>
        </div>
        <!-- Hamburger Menu -->
        <div class="md:hidden">
            <button id="hamburger-btn" class="text-white focus:outline-none">
                <span class="icon-[charm--menu-hamburger]" style="width: 1.8rem; height: 1.8rem;"></span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-greenSecondary py-4">
        <ul class="flex flex-col items-center space-y-4">
            <li><a href="/" class="text-white hover:text-greenPrimary">Beranda</a></li>
            <li><a href="/tentang" class="text-white hover:text-greenPrimary">Layanan</a></li>
            <li><a href="/fitur" class="text-white hover:text-greenPrimary">Fitur</a></li>
            <li><a href="/kontak" class="text-white hover:text-greenPrimary">Tentang Kami</a></li>
            <li><a href="{{ route('login') }}" class="bg-greenPrimary py-2 rounded-md px-6 text-white font-semibold hover:bg-green-700">Masuk</a></li>
        </ul>
    </div>
</header>


<script>
    document.getElementById('hamburger-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

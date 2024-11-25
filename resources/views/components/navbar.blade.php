<header class="w-full bg-greenSecondary py-3 fixed top-0 z-70 shadow-md">
    <nav class="container mx-auto flex items-center justify-between px-0">
        <!-- Logo Section -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/LOGO-AGROSIDA.png') }}" alt="logo-agrosida" class="w-14">
            <a href="/" class="text-4xl font-bold text-greenPrimary">AGRO<span class="text-white">SIDA</span></a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-8">
            <ul class="flex space-x-8">
                <li><a href="/" class="text-white hover:text-greenPrimary transition-colors duration-200">Beranda</a></li>
                <li><a href="/tentang" class="text-white hover:text-greenPrimary transition-colors duration-200">Layanan</a></li>
                <li><a href="/fitur" class="text-white hover:text-greenPrimary transition-colors duration-200">Fitur</a></li>
                <li><a href="/kontak" class="text-white hover:text-greenPrimary transition-colors duration-200">Tentang Kami</a></li>
            </ul>
            <a href="login" class="bg-greenPrimary py-2 px-6 rounded-md text-white font-semibold hover:bg-green-700 transition duration-200">Masuk</a>

        </div>

        <!-- Mobile Hamburger Menu -->
        <div class="md:hidden flex items-center">
            <button id="hamburger-btn" class="text-white focus:outline-none">
                <span class="icon-[charm--menu-hamburger]" style="width: 1.8rem; height: 1.8rem;"></span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden bg-greenSecondary w-full md:hidden">
        <ul class="flex flex-col items-center py-4 space-y-4">
            <li><a href="/" class="text-white hover:text-greenPrimary transition-colors duration-200">Beranda</a></li>
            <li><a href="/tentang" class="text-white hover:text-greenPrimary transition-colors duration-200">Layanan</a></li>
            <li><a href="/fitur" class="text-white hover:text-greenPrimary transition-colors duration-200">Fitur</a></li>
            <li><a href="/kontak" class="text-white hover:text-greenPrimary transition-colors duration-200">Tentang Kami</a></li>
            <a href="#" class="bg-greenPrimary py-2 px-6 rounded-md text-white font-semibold hover:bg-green-700 transition duration-200">Masuk</a>
        </ul>
    </div>
</header>

<script>
    // Toggle Mobile Menu
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Close menu on outside click (optional)
    document.addEventListener('click', (e) => {
        if (!hamburgerBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>

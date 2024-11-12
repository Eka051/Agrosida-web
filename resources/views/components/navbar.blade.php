<header class="w-full bg-greenSecondary py-4 fixed top-0 z-50">
    <nav class="container mx-auto flex items-center justify-between px-4">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/LOGO-AGROSIDA.png') }}" alt="logo-agrosida" class="w-14">
            <a href="/" class="text-4xl font-bold text-greenPrimary">AGRO<span class="text-white">SIDA</span></a>
        </div>
        <div class="hidden md:flex items-center justify-center mr-36">
            <ul class="flex space-x-8">
                <li><a href="/" class="text-white hover:text-greenPrimary">Beranda</a></li>
                <li><a href="/tentang" class="text-white hover:text-greenPrimary">Layanan</a></li>
                <li><a href="/fitur" class="text-white hover:text-greenPrimary">Fitur</a></li>
                <li><a href="/kontak" class="text-white hover:text-greenPrimary">Tentang Kami</a></li>
            </ul>
        </div>
        <div class="hidden md:flex items-center">
            <a href="{{ route('login') }}" class="bg-greenPrimary py-2 rounded-md px-6 text-white font-semibold">Masuk</a>
        </div>
        <div class="md:hidden">
            <button id="hamburger-btn" class="text-white focus:outline-none">
                <span class="icon-[charm--menu-hamburger]" style="width: 1.8rem; height: 1.8rem;"></span>
            </button>
        </div>
    </nav>
    <div id="mobile-menu" class="hidden w-full bg-greenSecondary py-4 md:hidden">
        <ul class="flex flex-col items-center space-y-4">
            <li><a href="/" class="text-white hover:text-greenPrimary">Beranda</a></li>
            <li><a href="/tentang" class="text-white hover:text-greenPrimary">Tentang</a></li>
            <li><a href="/fitur" class="text-white hover:text-greenPrimary">Fitur</a></li>
            <li><a href="/kontak" class="text-white hover:text-greenPrimary">Kontak</a></li>
            <a href="" class="bg-greenPrimary py-2 rounded-md px-6 text-white font-semibold">Masuk</a>
        </ul>
    </div>
</header>

<script>
    document.getElementById('hamburger-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

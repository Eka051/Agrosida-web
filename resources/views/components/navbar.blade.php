<header class="w-full bg-greenSecondary py-4 fixed top-0 left-0 right-0 z-50 shadow-md">
    <nav class="container mx-auto flex items-center justify-between px-4 relative">
        <!-- Logo dan Nama -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/LOGO-AGROSIDA.png') }}" alt="logo-agrosida" class="w-14 transition-transform hover:scale-110">
            <a href="/" class="text-2xl sm:text-4xl font-bold text-greenPrimary group">
                AGRO<span class="text-white group-hover:text-greenPrimary transition-colors">SIDA</span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center justify-center space-x-8">
            <ul class="flex space-x-8">
                <li>
                    <a href="/" class="text-white hover:text-greenPrimary relative group">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-greenPrimary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </li>
                <li>
                    <a href="/layanan" class="text-white hover:text-greenPrimary relative group">
                        Layanan
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-greenPrimary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </li>
                <li>
                    <a href="/fitur" class="text-white hover:text-greenPrimary relative group">
                        Fitur
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-greenPrimary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </li>
                <li>
                    <a href="/tentang" class="text-white hover:text-greenPrimary relative group">
                        Tentang Kami
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-greenPrimary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Authentication Buttons -->
        <div class="hidden md:flex items-center space-x-4">
            @auth
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="flex items-center space-x-2 bg-red-500 py-2 px-6 rounded-md text-white font-semibold hover:bg-red-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="flex items-center space-x-2 bg-greenPrimary py-2 px-6 rounded-md text-white font-semibold hover:bg-opacity-90 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Masuk</span>
            </a>
            @endauth
        </div>


        <!-- Mobile Hamburger Menu -->
        <div class="md:hidden">
            <button id="mobile-menu-toggle" aria-label="Toggle mobile menu" class="text-white focus:outline-none transition-transform active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Slide-out Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-greenSecondary transform -translate-x-full transition-transform duration-300 ease-in-out z-40 md:hidden">
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center p-4 border-b border-green-700">
                <a href="/" class="text-2xl font-bold text-greenPrimary">AGROSIDA</a>
                <button id="mobile-menu-close" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="flex flex-col space-y-4 p-4">
                    <li><a href="/" class="text-white hover:text-greenPrimary text-lg">Beranda</a></li>
                    <li><a href="/layanan" class="text-white hover:text-greenPrimary text-lg">Layanan</a></li>
                    <li><a href="/fitur" class="text-white hover:text-greenPrimary text-lg">Fitur</a></li>
                    <li><a href="/tentang" class="text-white hover:text-greenPrimary text-lg">Tentang Kami</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-green-700">
                @auth
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 py-3 rounded-lg text-white font-semibold hover:bg-red-600 transition-all shadow-lg flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="block w-full bg-green-500 py-3 rounded-lg text-white font-semibold hover:bg-green-600 transition-all shadow-lg flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Masuk</span>
                </a>
                @endauth
            </div>



        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');

        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('-translate-x-full');
        });

        // Close mobile menu
        mobileMenuClose.addEventListener('click', () => {
            mobileMenu.classList.add('-translate-x-full');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isMenuToggle = mobileMenuToggle.contains(event.target);

            if (!isClickInsideMenu && !isMenuToggle && !mobileMenu.classList.contains('-translate-x-full')) {
                mobileMenu.classList.add('-translate-x-full');
            }
        });
    });
</script>

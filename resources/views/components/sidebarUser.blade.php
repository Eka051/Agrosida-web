<aside class="w-56 h-[100rem] bg-greenSecondary text-black fixed border-r border-gray-400 lg:w-64 md:w-48 sm:w-40 top-0 z-50">
    <div class="p-4 text-center font-bold text-xl border-b border-gray-400">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/LOGO-AGROSIDA.png') }}" alt="logo-agrosida" class="w-10">
            <a href="/" class="text-2xl sm:text-3xl font-bold text-greenPrimary">AGRO<span class="text-white">SIDA</span></a>
        </div>
    </div>
    <nav class="mt-10">
        <ul class="space-y-4 ml-4 text-white text-lg">
            <li class="flex items-center">
                <span class="iconify text-3xl text-greenPrimary" data-icon="duo-icons:dashboard" data-inline="false"></span>
                <a href="{{ route('user.dashboard') }}" class="block py-2 px-3 rounded hover:bg-green-500 transition duration-300 ease-in-out {{ request()->routeIs('user.dashboard') ? 'bg-green-600' : '' }}">Beranda</a>
            </li>
            <li class="flex items-center">
                <span class="iconify text-3xl text-greenPrimary" data-icon="solar:cart-large-bold-duotone" data-inline="false"></span>
                <a href="{{ route('user.cart') }}" class="block py-2 px-3 rounded hover:bg-green-500 transition duration-300 ease-in-out {{ request()->routeIs('user.cart') ? 'bg-green-600' : '' }}">Keranjang Belanja</a>
            </li>
            <li class="flex items-center">
                <span class="iconify text-3xl text-greenPrimary" data-icon="icon-park-twotone:transaction-order" data-inline="false"></span>
                <a href="{{ route('user.history') }}" class="block py-2 px-3 rounded hover:bg-green-500 transition duration-300 ease-in-out {{ request()->routeIs('user.history') ? 'bg-green-600' : '' }}">Riwayat Pesanan</a>
            </li>
            <li class="flex items-center">
                <span class="iconify text-3xl text-greenPrimary" data-icon="ic:twotone-calculate" data-inline="false"></span>
                <a href="{{ route('user.kalkulasipestisida') }}" class="block py-2 px-3 rounded hover:bg-green-500 transition duration-300 ease-in-out">Kalkulasi Pestisida</a>
            </li>
            <li class="flex items-center">
                <span class="iconify text-3xl text-greenPrimary" data-icon="ant-design:security-scan-twotone" data-inline="false"></span>
                <a href="{{ route('user.detect.form') }}" class="block py-2 px-3 rounded hover:bg-green-500 transition duration-300 ease-in-out">Deteksi Penyakit</a>
            </li>
            <li class="flex items-center">
                <span class="iconify text-3xl text-greenPrimary" data-icon="solar:logout-3-bold-duotone" data-inline="false"></span>
                <a href="#" id="logout-link" class="block py-2 px-3 rounded hover:bg-red-700 transition duration-300 ease-in-out">Logout</a>
            </li>
        </ul>
    </nav>
</aside>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Keluar',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

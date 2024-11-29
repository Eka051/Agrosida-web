<!-- Sidebar -->
<aside class="w-56 h-screen bg-primaryBg text-black fixed border-r border-gray-300">
    <div class="p-4 text-center font-bold text-xl border-b border-green-700">
        AGROSIDA
    </div>
    <nav class="mt-6">
        <ul class="space-y-2">
            <li>
                <a href="{{route('user.beranda')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'user.beranda' ? 'bg-green-500 text-white' : '' }}">Beranda</a>
            </li>
            <li>
                <a href="{{route('user.keranjang')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'user.keranjang' ? 'bg-green-500 text-white' : '' }}">Keranjang Belanja</a>
            </li>
            <li>
                <a href="{{route('user.checkout')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'user.checkout' ? 'bg-green-500 text-white' : '' }}">Checkout Produk</a>
            </li>
            <li>
                <a href="{{route('user.riwayatpesanan')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'user.riwayatpesanan' ? 'bg-green-500 text-white' : '' }}">Riwayat Pesanan</a>
            </li>
            <li>
                <a href="{{route('user.kalkulasipestisida')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'user.kalkulasipestisida' ? 'bg-green-500 text-white' : '' }}">Kalkulasi Pestisida</a>
            </li>
            <li>
                <a href="{{route('user.profil')}}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'user.profil' ? 'bg-green-500 text-white' : '' }}">Profil</a>
            </li>
        </ul>
    </nav>
</aside>
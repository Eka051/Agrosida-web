<!-- Sidebar -->
<aside class="w-48 bg-primaryBg text-black h-screen p-6 fixed">
    <h2 class="text-xl font-bold mb-6">Menu</h2>
    <ul>
        <li class="mb-4">
            <a href="{{ route('seller.beranda=') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'seller.beranda' ? 'bg-green-500 text-white' : '' }}">Beranda</a>
        </li>
        <li class="mb-4">
            <a href="{{ route('seller.pesanan') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'seller.pesanan' ? 'bg-green-500 text-white' : '' }}">Pesanan</a>
        </li>
        <li class="mb-4">
            <a href="{{ route('seller.transaksi') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'seller.transaksi' ? 'bg-green-500 text-white' : '' }}">Transaksi</a>
        </li>
        <li class="mb-4">
            <a href="{{ route('seller.kalkulasipestisida') }}" class="block py-2 px-3 rounded hover:bg-green-500 {{ Route::currentRouteName() === 'seller.kalkulasipestisida' ? 'bg-green-500 text-white' : '' }}">Kalkulasi Pestisida</a>
        </li>
    </ul>
</aside>

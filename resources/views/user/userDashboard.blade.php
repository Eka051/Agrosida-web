@extends('components.template')
@section('title', 'User Dashboard')
@section('content')
    <div class="bg-gray-50 min-h-screen">
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-greenSecondary text-sm py-8">
        <nav class="max-w-[85rem] w-full mx-auto px-4 flex items-center justify-between">
            <h1 class="text-white text-lg font-semibold">Halo selamat datang {{ $name }}</h1>
            <div class="sm:hidden">
                <button type="button" class="hs-collapse-toggle relative size-7 rounded-lg border border-gray-300 bg-white text-gray-800" data-hs-collapse="#hs-navbar-alignment">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                </button>
            </div>
        </nav>
    </header>

        <div id="hs-application-sidebar" class="hs-overlay -translate-x-full transition-all duration-300 transform w-[260px] h-full hidden fixed inset-y-0 start-0 z-[60] border-r-2 border-gray-50 bg-greenSecondary lg:block lg:translate-x-0" role="dialog" tabindex="-1" aria-label="Sidebar">
            <div class="relative flex flex-col h-full max-h-full">
            <!-- Logo -->
                <div class="px-6 pt-6 mb-5">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('img/LOGO-AGROSIDA.png') }}" alt="logo-agrosida" class="w-10">
                        <a href="/" class="text-3xl font-bold text-greenPrimary">AGRO<span class="text-white">SIDA</span></a>
                    </div>
                </div>
            <!-- Navigation -->
            <div class="h-full overflow-y-auto">
                <nav class="p-3 w-full">
                    <ul class="flex flex-col space-y-1">
                        <li><a href="" class="flex items-center gap-x-3.5 py-2 px-2.5 bg-greenPrimary text-lg font-semibold text-white rounded-lg hover:bg-greenPrimary/70">Dashboard</a></li>
                        <li><a href="" class="flex items-center gap-x-3.5 py-2 px-2.5 bg-greenPrimary text-lg font-semibold text-white rounded-lg hover:bg-greenPrimary/70">Cart</a></li>
                        <li><a href="" class="flex items-center gap-x-3.5 py-2 px-2.5 bg-greenPrimary text-lg font-semibold text-white rounded-lg hover:bg-greenPrimary/70">Riwayat</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="flex items-center gap-x-3.5 py-2 px-2.5 bg-red-700 text-lg font-semibold text-white rounded-lg hover:bg-red-900">Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="bg-white rounded-lg py-4 px-7 border border-gray-200">
            <div>
                <div>
                    <div>
                        <p class="text-xl font-bold m-auto mt-32">TOTAL PRODUK</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
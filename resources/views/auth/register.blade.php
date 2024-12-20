@extends('components.navbar')
@extends('components.template')
@section('title', 'Register - AGROSIDA')
@section('content')

<form action="{{ route('register.storeUser') }}" method="POST" id="registerForm">
    @csrf
    <div class="mt-16">
        <div class="flex items-center justify-center">
            <div class="flex flex-col items-center w-1/2 mr-20 ml-8">
                <div class="block mt-6">
                    <p class="text-4xl text-black font-semibold w-[50rem]">
                        Bergabunglah dengan AGROSIDA
                        <span class="block mt-4 text-lg">Daftarkan akun Anda untuk mengakses layanan kalkulasi pestisida dan marketplace pestisida terbaik yang dirancang khusus untuk kebutuhan pertanian Anda.</span>
                    </p>
                    <p class="text-white mt-4 text-lg">Desain oleh: Dian Eka Raharjo</p>
                </div>
            </div>
            <div class="bg-gradient-to-t from-greenPrimary to-greenSecondary w-[70rem] h-[60rem] ml-6">
                <div class="bg-white shadow-lg border border-gray-200 w-[30rem] h-[53rem] rounded-xl m-auto mt-16">
                    <p class="text-[30px] font-bold text-center pt-8">Registrasi Akun</p>

                    <div class="flex mt-4 justify-center">
                        <button type="button" id="userRole" class="role-btn bg-greenSecondary font-medium text-white px-4 py-2 rounded-l-lg">User</button>
                        <button type="button" id="sellerRole" class="role-btn bg-gray-300 font-medium px-4 py-2 rounded-r-lg">Penjual</button>
                    </div>

                    <div class="px-16 mt-8">
                        <div class="mt-4 mb-4 hidden" id="storeNameField">
                            <label for="store_name" class="block font-semibold text-lg">Nama Toko</label>
                            <input type="text" name="store_name" id="store_name" placeholder="Masukkan nama toko" 
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>

                        <div>
                            <label for="name" class="block font-semibold text-lg">Nama Lengkap</label>
                            <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" required 
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block font-semibold text-lg">Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukkan alamat email" required 
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>

                        <div class="mt-4">
                            <label for="username" class="block font-semibold text-lg">Username</label>
                            <input type="text" name="username" id="username" placeholder="Masukkan username" required 
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>

                        <div class="mt-4">
                            <label for="password" class="block font-semibold text-lg">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Masukkan password" required
                                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <span class="absolute right-4 top-3 cursor-pointer toggle-password text-2xl" data-target="password" 
                                    data-icon="fluent:eye-24-regular" data-icon-hide="fluent:eye-off-24-regular">
                                    <span class="iconify" data-icon="fluent:eye-24-regular" data-inline="false"></span>
                                </span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="password_confirmation" class="block font-semibold text-lg">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password" required
                                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <span class="absolute right-4 top-3 cursor-pointer toggle-password text-2xl" data-target="password_confirmation" 
                                    data-icon="fluent:eye-24-regular" data-icon-hide="fluent:eye-off-24-regular">
                                    <span class="iconify" data-icon="fluent:eye-24-regular" data-inline="false"></span>
                                </span>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-center">
                            <button type="submit"
                                class="bg-greenSecondary w-[22rem] h-12 text-white text-lg font-medium rounded-lg hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-700">
                                Daftar
                            </button>
                        </div>

                        <div class="mt-4 flex justify-center" id="googleRegister">
                            <a href="{{ route('oauth.google') }}" class="w-[22rem] h-12 bg-white border border-gray-300 text-lg font-medium rounded-lg hover:bg-gray-100 flex items-center justify-center focus:outline-gray-400">
                                <span class="iconify mr-2" data-icon="logos:google-icon" data-width="24" data-height="24"></span>
                                Daftar dengan Google
                            </a>
                        </div>

                        <div class="text-center mt-2">
                            <p class="text-lg">Sudah memiliki akun? <a href="{{ route('login') }}"
                                    class="text-greenPrimary font-semibold hover:underline focus:outline-none focus:underline">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

<script>
    document.getElementById('userRole').addEventListener('click', () => {
        document.getElementById('storeNameField').classList.add('hidden');
        document.getElementById('googleRegister').classList.remove('hidden');
        document.getElementById('registerForm').setAttribute('action', "{{ route('register.storeUser') }}");
        toggleRoleButtons('userRole', 'sellerRole');
    });

    document.getElementById('sellerRole').addEventListener('click', () => {
        document.getElementById('storeNameField').classList.remove('hidden');
        document.getElementById('googleRegister').classList.add('hidden');
        document.getElementById('registerForm').setAttribute('action', "{{ route('register.storeSeller') }}");
        toggleRoleButtons('sellerRole', 'userRole');
    });

    function toggleRoleButtons(active, inactive) {
        document.getElementById(active).classList.add('bg-greenSecondary', 'text-white');
        document.getElementById(active).classList.remove('bg-gray-300');
        document.getElementById(inactive).classList.remove('bg-greenSecondary', 'text-white');
        document.getElementById(inactive).classList.add('bg-gray-300');
    }

    document.querySelectorAll('.toggle-password').forEach(toggle => {
    toggle.addEventListener('click', () => {
        const targetId = toggle.getAttribute('data-target');
        const target = document.getElementById(targetId);
        const icon = toggle.querySelector('.iconify');
        const iconShow = toggle.getAttribute('data-icon');
        const iconHide = toggle.getAttribute('data-icon-hide');

        if (target.type === 'password') {
            target.type = 'text';
            icon.setAttribute('data-icon', iconHide);
        } else {
            target.type = 'password';
            icon.setAttribute('data-icon', iconShow);
        }
    });
});
</script>

@endsection

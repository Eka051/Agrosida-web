@extends('components.navbar')
@extends('components.template')
@section('title', 'Reset Password - AGROSIDA')
@section('content')

<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-green-400 to-green-600 px-4">
    <div class="text-center text-white mb-8">
        <h1 class="text-4xl font-bold">Reset Password</h1>
        <p class="text-lg mt-2">Masukkan email Anda untuk menerima kode verifikasi.</p>
    </div>

    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6" id="reset-password-form">
        <h2 class="text-2xl font-bold text-center mb-4">Reset Password</h2>
        <form id="send-code-form">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email Anda" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            <button type="submit" 
                    class="w-full bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Kirim Kode Verifikasi
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('send-code-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;

        fetch('{{ route('password.sendCode') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('reset-password-form').innerHTML = `
                    <h2 class="text-2xl font-bold text-center mb-4">Masukkan Kode Verifikasi</h2>
                    <form id="verify-code-form">
                        <div class="mb-4">
                            <label for="verification_code" class="block text-gray-700 font-semibold mb-1">Kode Verifikasi</label>
                            <input type="text" name="verification_code" id="verification_code" placeholder="Masukkan kode verifikasi" 
                                   class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                        </div>
                        <button type="submit" 
                                class="w-full bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                            Verifikasi Kode
                        </button>
                    </form>
                `;
                document.getElementById('verify-code-form').addEventListener('submit', verifyCode);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengirim kode verifikasi. Silakan coba lagi.',
                    confirmButtonColor: '#A2E554',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    function verifyCode(event) {
        event.preventDefault();
        const verificationCode = document.getElementById('verification_code').value;

        fetch('{{ route('password.verifyCode') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ verification_code: verificationCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('reset-password-form').innerHTML = `
                    <h2 class="text-2xl font-bold text-center mb-4">Reset Password</h2>
                    <form id="reset-password-final-form">
                        <div class="mb-4">
                            <label for="new_password" class="block text-gray-700 font-semibold mb-1">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" placeholder="Masukkan password baru" 
                                   class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                        </div>
                        <div class="mb-4">
                            <label for="confirm_password" class="block text-gray-700 font-semibold mb-1">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password baru" 
                                   class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                        </div>
                        <button type="submit" 
                                class="w-full bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                            Reset Password
                        </button>
                    </form>
                `;
                document.getElementById('reset-password-final-form').addEventListener('submit', resetPassword);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Kode verifikasi salah. Silakan coba lagi.',
                    confirmButtonColor: '#A2E554',
                    confirmButtonText: 'OK'
                });
            }
        });
    }

    function resetPassword(event) {
        event.preventDefault();
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Password dan konfirmasi password tidak cocok.',
                confirmButtonColor: '#A2E554',
                confirmButtonText: 'OK'
            });
            return;
        }

        fetch('{{ route('password.reset') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ new_password: newPassword })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Password berhasil direset. Silakan login dengan password baru Anda.',
                    confirmButtonColor: '#A2E554',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '{{ route('login') }}';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mereset password. Silakan coba lagi.',
                    confirmButtonColor: '#A2E554',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
</script>

@endsection
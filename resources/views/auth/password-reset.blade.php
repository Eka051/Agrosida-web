@extends('components.template')
@include('components.navbar')
@section('title', 'Reset Password - AGROSIDA')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-green-400 to-green-600 px-4">
    <div class="text-center text-white mb-8">
        <h1 class="text-4xl font-bold">Reset Password</h1>
        <p class="text-lg mt-2">Masukkan email Anda untuk menerima kode verifikasi.</p>
    </div>

    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6" id="reset-password-form">
        <h2 class="text-2xl font-bold text-center mb-4">Reset Password</h2>
        <form id="send-code-form" action="{{ route('password.sendCode') }}" method="POST" onsubmit="sendCode(event)">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function sendCode(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;

        fetch('{{ route("password.sendCode") }}', {
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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Kode verifikasi berhasil dikirim ke email Anda.',
                    confirmButtonColor: '#A2E554'
                }).then(() => {
                    document.getElementById('reset-password-form').innerHTML = `
                        <h2 class="text-2xl font-bold text-center mb-4">Masukkan Kode Verifikasi</h2>
                        <form id="verify-code-form" onsubmit="verifyCode(event)">
                            <div class="mb-4 flex justify-between">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" name="verification_code[]" id="verification_code_{{ $i }}" maxlength="1" 
                                           class="w-12 p-3 border rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-green-400" required
                                           oninput="moveToNext(this, {{ $i }})">
                                @endfor
                            </div>
                            <button type="submit" 
                                    class="w-full bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                                Verifikasi Kode
                            </button>
                        </form>
                        <div class="text-center mt-4 text-gray-700" id="countdown-timer"></div>
                    `;
                    startCountdown(5 * 60, document.getElementById('countdown-timer'));
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message || 'Gagal mengirim kode verifikasi. Silakan coba lagi.',
                    confirmButtonColor: '#A2E554'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat mengirim kode verifikasi.',
                confirmButtonColor: '#A2E554'
            });
            console.error('Error:', error);
        });
    }

    function verifyCode(event) {
        event.preventDefault();
        let verificationCode = '';
        for (let i = 0; i < 6; i++) {
            verificationCode += document.getElementById(`verification_code_${i}`).value;
        }

        fetch('{{ route("password.verifyCode") }}', {
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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Kode verifikasi benar. Silakan reset password Anda.',
                    confirmButtonColor: '#A2E554'
                }).then(() => {
                    document.getElementById('reset-password-form').innerHTML = `
                        <h2 class="text-2xl font-bold text-center mb-4">Reset Password</h2>
                        <form id="reset-password-final-form" onsubmit="resetPassword(event)">
                            <div class="mb-4 relative">
                                <label for="new_password" class="block text-gray-700 font-semibold mb-1">Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="new_password" id="new_password" placeholder="Masukkan password baru" 
                                           class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 pr-10" required>
                                    <span class="absolute right-3 top-3 cursor-pointer toggle-password text-2xl" data-target="new_password" 
                                        data-icon="fluent:eye-24-regular" data-icon-hide="fluent:eye-off-24-regular">
                                        <span class="iconify" data-icon="fluent:eye-24-regular" data-inline="false"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4 relative">
                                <label for="confirm_password" class="block text-gray-700 font-semibold mb-1">Konfirmasi Password</label>
                                <div class="relative">
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password baru" 
                                           class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 pr-10" required>
                                    <span class="absolute right-3 top-3 cursor-pointer toggle-password text-2xl" data-target="confirm_password" 
                                        data-icon="fluent:eye-24-regular" data-icon-hide="fluent:eye-off-24-regular">
                                        <span class="iconify" data-icon="fluent:eye-24-regular" data-inline="false"></span>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-green-500 text-white p-3 text-lg rounded-lg font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                                Reset Password
                            </button>
                        </form>
                    `;
                    initializeTogglePassword();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message || 'Kode verifikasi salah. Silakan coba lagi.',
                    confirmButtonColor: '#A2E554'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat memverifikasi kode.',
                confirmButtonColor: '#A2E554'
            });
            console.error('Error:', error);
        });
    }

    function resetPassword(event) {
        event.preventDefault();
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Password dan konfirmasi password tidak cocok.',
                confirmButtonColor: '#A2E554'
            });
            return;
        }

        fetch('{{ route("password.reset") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ new_password: newPassword , confirm_password: confirmPassword})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Password berhasil direset.',
                    confirmButtonColor: '#A2E554'
                }).then(() => {
                    window.location.href = '{{ route('login') }}';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message || 'Gagal mereset password. Silakan coba lagi.',
                    confirmButtonColor: '#A2E554'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat mereset password.',
                confirmButtonColor: '#A2E554'
            });
            console.error('Error:', error);
        });
    }

    function moveToNext(element, index) {
        if (element.value.length === 1 && index < 5) {
            document.getElementById(`verification_code_${index + 1}`).focus();
        }
    }

    function initializeTogglePassword() {
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
    }

    initializeTogglePassword();
</script>

@endsection

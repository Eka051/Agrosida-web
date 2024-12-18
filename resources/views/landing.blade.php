@extends('components.navbar')
@extends('components.template')
@section('title', 'Agrosida')
@section('content')

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideInLeft {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideInRight {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slowZoom {
            from { transform: scale(1.1); }
            to { transform: scale(1); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-fadeIn { animation: fadeIn 1s ease-out; }
        .animate-slideUp { animation: slideUp 1s ease-out; }
        .animate-slideInLeft { animation: slideInLeft 1s ease-out; }
        .animate-slideInRight { animation: slideInRight 1s ease-out; }
        .animate-slowZoom { animation: slowZoom 20s ease-out; }
        .animate-float { animation: float 2s ease-in-out infinite; }
        .delay-300 { animation-delay: 300ms; }
        .delay-500 { animation-delay: 500ms; }
        .paint-splash-frame {
            mask-image: url('img/paint-splash-mask.png');
            mask-size: cover;
            -webkit-mask-image: url('img/paint-splash-mask.png');
            -webkit-mask-size: cover;
        }
        .hover\:animate-float:hover {
            animation: float 2s ease-in-out infinite;
        }
        @layer utilities {
        @keyframes fade-in-down {
            from {
            opacity: 0;
            transform: translateY(-20px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
        }

        @keyframes fade-in-up {
            from {
            opacity: 0;
            transform: translateY(20px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
        }

        @keyframes fade-in-left {
            from {
            opacity: 0;
            transform: translateX(-30px);
            }
            to {
            opacity: 1;
            transform: translateX(0);
            }
        }

        @keyframes fade-in-right {
            from {
            opacity: 0;
            transform: translateX(30px);
            }
            to {
            opacity: 1;
            transform: translateX(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 1s ease-out forwards;
        }
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }
        .animate-fade-in-left {
            animation: fade-in-left 1s ease-out forwards;
        }
        .animate-fade-in-right {
            animation: fade-in-right 1s ease-out forwards;
        }
        }


</style>

<div class="landing-page bg-gray-100 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section relative min-h-screen flex items-center overflow-hidden" id="hero-section">
        <!-- Background gradient overlay with fade-in animation -->
        <div class="absolute inset-0 bg-gradient-to-r from-green-600/80 to-green-100/50 z-10 animate-fadeIn"></div>

        <!-- Background image with subtle zoom effect -->
        <div class="absolute inset-0 animate-slowZoom">
            <img src="img/FARMER.png" alt="Healthy Farm" class="w-full h-full object-cover">
        </div>

        <!-- Content with slide-up animation -->
        <div class="container mx-auto px-4 sm:px-6 relative z-20">
            <div class="flex flex-col md:flex-row items-center max-w-4xl mx-auto animate-slideUp space-y-8 md:space-y-0 md:space-x-8">
                <!-- Text Content -->
                <div class="md:w-1/2 text-white text-center md:text-left">
                  <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight mb-4 sm:mb-6 animate-slideInLeft hover:animate-float hover:text-yellow-400 transition duration-300">
                    Marketplace Pestisida dan Kalkulator Penggunaan yang Presisi
                  </h1>
                  <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 text-green-100 animate-slideInRight delay-300 hover:text-yellow-200 transition duration-300">
                    Temukan pestisida berkualitas dan hitung penggunaan yang tepat untuk hasil panen optimal.
                  </p>
                  <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate-fadeIn delay-500">
                    <a href="{{ route('user.dashboard') }}" class="inline-block bg-yellow-500 text-white items-center font-bold py-2 px-6 rounded-full hover:bg-yellow-400 transition duration-300 transform hover:-translate-y-1 hover:scale-105">
                      Beli Pestisida
                    </a>
                    <a href="#calculator-pesticide" class="inline-block bg-transparent border-2 border-white text-white font-bold py-2 px-6 rounded-full hover:bg-white hover:text-green-800 transition duration-300 transform hover:-translate-y-1 hover:scale-105">
                      Hitung Dosis
                    </a>
                  </div>
                </div>

                <!-- Image Section -->
                <div class="md:w-1/2 animate-slideInRight delay-500 relative">
                    <!-- Main Polaroid Frame -->
                    <div class="relative w-full h-[350px] sm:h-[400px] bg-white rounded-lg overflow-hidden shadow-xl p-4 transform hover:scale-105 transition-transform duration-500 z-30">
                        <div class="relative w-full h-full rounded-lg overflow-hidden">
                            <img src="img/hero.jpg" alt="Pestisida Alami" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            <!-- Decorative Paint Splash Frame -->
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-tr from-yellow-400 to-transparent opacity-50 rounded-lg pointer-events-none"></div>
                        </div>
                        <!-- Polaroid Border -->
                        <div class="absolute inset-0 border-4 border-white rounded-lg pointer-events-none"></div>
                        <div class="absolute bottom-0 left-0 w-full h-16 bg-white"></div>
                    </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="about-us relative py-16 overflow-hidden" id="about-us">
        <!-- Latar Belakang dengan Efek Gradient dan Ornamen -->
        <div class="absolute inset-0 pointer-events-none"></div>
        <div class="absolute top-0 right-0 transform translate-x-20 -translate-y-20 opacity-10">
          <svg width="300" height="300" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#10B981" d="M50,-53C62,-43,67,-21,64,-2C60,18,47,35,33,44C18,52,2,52,-16,48C-35,43,-70,33,-75,17C-80,2,-55,-19,-37,-33C-19,-46,-9,-53,9,-57C26,-60,43,-62,50,-53Z" transform="translate(100 100)" />
          </svg>
        </div>

        <!-- Kontainer Utama -->
        <div class="container relative mx-auto px-4 sm:px-6 lg:px-8 z-10">
          <!-- Judul Bagian -->
          <div class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-4xl mx-auto space-y-6">
                    <div class="relative inline-block">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-black mb-4 relative z-10 transform transition-all duration-500 hover:scale-105">
                            Tentang Kami
                        </h1>
                        <div class="absolute -bottom-2 left-0 right-0 h-3 bg-yellow-400/50 -z-10 rounded-full"></div>
                    </div>

                    <p class="text-green-700 text-lg sm:text-xl leading-relaxed mb-8 animate-fade-in-up">
                        Kami adalah pionir dalam solusi pertanian organik, menggabungkan teknologi canggih dengan komitmen mendalam terhadap keberlanjutan lingkungan dan kesejahteraan petani.
                    </p>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                            <div class="text-green-600 mb-4">
                                <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.632 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.266-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-green-800 mb-3">Inovasi Teknologi</h3>
                            <p class="text-green-700">
                                Mengembangkan solusi pertanian cerdas dengan database kalkulasi pestisida tercanggih.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                            <div class="text-green-600 mb-4">
                                <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.5 17.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0zM15.5 13c-1.5 0-2.8 1.4-3.5 3 .7 1.6 2 3 3.5 3s2.8-1.4 3.5-3c-.7-1.6-2-3-3.5-3z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-green-800 mb-3">Fokus Petani</h3>
                            <p class="text-green-700">
                                Berkomitmen pada kesejahteraan dan pemberdayaan komunitas petani lokal.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                            <div class="text-green-600 mb-4">
                                <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-green-800 mb-3">Berkelanjutan</h3>
                            <p class="text-green-700">
                                Produk 100% organik yang mendukung pertanian ramah lingkungan dan ekosistem.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-down {
                animation: fadeInDown 1s ease-out;
            }

            .animate-fade-in-up {
                animation: fadeInUp 1s ease-out;
            }
        </style>

          <!-- Konten Utama -->
          <div class="flex flex-col md:flex-row items-center justify-between space-y-8 md:space-y-0 md:space-x-8">
            <!-- Gambar -->
            <div class="md:w-1/2 relative">
              <img src="img/klien.jpg" alt="Tentang Kami" class="w-full h-auto rounded-lg shadow-lg transform hover:scale-105 transition duration-500 animate-fade-in-left">
              <!-- Overlay Ornamen -->
              <div class="absolute top-0 left-0 bg-green-500 text-white p-3 rounded-br-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                </svg>
              </div>
            </div>

            <!-- Teks Penjelasan -->
            <div class="md:w-1/2 animate-fade-in-right bg-white p-8 rounded-lg shadow-lg">
              <p class="text-gray-700 text-lg leading-relaxed mb-6">
                Kami berdedikasi untuk membantu petani dengan teknologi modern dan solusi organik terbaik. Dengan pendekatan inovatif, kami menyediakan <span class="text-green-600 font-semibold">kalkulasi pestisida</span> yang tepat, produk berkualitas, dan layanan konsultasi untuk meningkatkan hasil panen Anda.
              </p>
              <ul class="list-none mb-6 space-y-4">
                <li class="flex items-start">
                  <span class="bg-green-500 text-white p-3 rounded-full shadow-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </span>
                  <span class="text-gray-700 text-lg">Kalkulasi pestisida yang akurat & terpercaya</span>
                </li>
                <li class="flex items-start">
                  <span class="bg-green-500 text-white p-3 rounded-full shadow-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                    </svg>
                  </span>
                  <span class="text-gray-700 text-lg">Solusi lengkap untuk pertanian organik</span>
                </li>
                <li class="flex items-start">
                  <span class="bg-green-500 text-white p-3 rounded-full shadow-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                  </span>
                  <span class="text-gray-700 text-lg">Panduan dan dukungan berkelanjutan</span>
                </li>
              </ul>
              <!-- Tombol -->
              <a href="#" class="inline-block bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-green-500 transition duration-300 transform hover:-translate-y-1 hover:scale-110">
                Pelajari Lebih Lanjut
              </a>
            </div>
          </div>
        </div>
      </section>

    <!-- Kalkulator -->
    <section class="py-8 mx-4 bg-green-100 rounded-lg" id="calculator-pesticide">
        <div class="container mx-auto px-6">
            <!-- Judul Bagian -->
          <div class="text-center mb-12 mt-16">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-4 animate-fade-in-down">
              Hitung Dengan Kalkulator Pestisida
            </h1>
            <p class="text-gray-700 text-lg sm:text-xl max-w-3xl mx-auto animate-fade-in-up">
              Yuk hitung penggunaan pestisida yang tepat untuk tanaman Anda agar hasil panen optimal tanpa mencemari lingkungan.
            </p>
          </div>

            {{-- kalkulasi --}}
            <div class="bg-white shadow-lg rounded-lg p-6 w-full">
                <form class="space-y-6" id="pesticide-form">
                    <!-- Nama Pestisida -->
                    <div>
                        <label for="pestisida" class="block text-xl font-medium text-gray-700">Nama Pestisida</label>
                        <select id="pestisida_select" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled selected>Pilih Pestisida</option>
                            @foreach($pesticides as $pesticide)
                                <option value="{{ $pesticide->id }}">{{ $pesticide->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Tanaman -->
                    <div>
                        <label for="tanaman" class="block text-xl font-medium text-gray-700">Nama Tanaman</label>
                        <select id="selected_tanaman" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
                            <option value="" disabled selected>Jenis Tanaman</option>
                        </select>
                    </div>

                    <!-- Luas Lahan -->
                    <div>
                        <label for="land_area" class="block text-xl font-medium text-gray-700">Luas Lahan (m<sup>2</sup>)</label>
                        <input type="number" id="land_area_value" name="luas_lahan" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Ketik luas lahan">
                    </div>

                    <!-- Dosis -->
                    <div>
                        <input type="hidden" id="dosage" required min="0" step="0.1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300"
                            placeholder="Ketik Dosis">
                    </div>

                    <!-- Tombol Hitung -->
                    <div class="flex justify-end">
                        <button type="button" id="calculate-btn"
                                class="bg-green-500 text-white px-6 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Hitung
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="py-8 mx-4 bg-green-100 rounded-lg">
      <div class="container mx-auto px-6">
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
          <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b">Hasil Kalkulasi</h2>
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
              <p class="text-sm text-gray-600">Nama Pestisida</p>
              <p class="font-medium text-gray-900" id="pesticide-name">-</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
              <p class="text-sm text-gray-600">Luas Lahan</p>
              <p class="font-medium text-gray-900"><span id="land-area">-</span> m<sup>2</sup></p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
              <p class="text-sm text-gray-600">Dosis</p>
              <p class="font-medium text-gray-900"><span id="dosage-value">-</span> ml/m<sup>2</sup></p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
              <p class="text-sm text-gray-600">Total Kebutuhan Pestisida</p>
              <p class="font-medium text-gray-900"><span id="total-pesticide">-</span> ml</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg col-span-2">
              <p class="text-sm text-gray-600">Total Kebutuhan Air</p>
              <p class="font-medium text-gray-900"><span id="water-value">-</span> liter</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
        $('#pestisida_select').on('change', function () {
            const pestisidaId = $(this).val();

            $.ajax({
                type: 'GET',
                url: `/dosage/${pestisidaId}`,
                success: function (data) {
                    $('#selected_tanaman').empty().append('<option value="" disabled selected>Jenis Tanaman</option>');

                    data.forEach(item => {
                        $('#selected_tanaman').append(
                            `<option value="${item.id}" data-dose="${item.dosage_per_hectare}">${item.name}</option>`
                        );
                    });
                },
                error: function () {
                    alert('Terjadi kesalahan saat mengambil data tanaman');
                }
            });
        });

        $('#selected_tanaman').on('change', function () {
            const selectedDose = $(this).find('option:selected').data('dose');
            $('#dosage').val(selectedDose || '');
        });

        $('#calculate-btn').on('click', function () {
            const landArea = parseFloat($('#land_area_value').val());
            const dosage = parseFloat($('#dosage').val());
            const pesticideName = $('#pestisida_select option:selected').text();

            if (!$('#pestisida_select').val() || !$('#selected_tanaman').val()) {
                alert('Pilih pestisida dan tanaman terlebih dahulu.');
                return;
            }

            if (isNaN(landArea) || isNaN(dosage)) {
                alert('Masukkan nilai valid untuk luas lahan dan dosis.');
                $('#land_area_value, #dosage').addClass('border-red-500');
                return;
            } else {
                $('#land_area_value, #dosage').removeClass('border-red-500');
            }

            const totalPesticide = landArea * dosage;
            const totalWater = landArea / 4;

            $('#pesticide-name').text(pesticideName);
            $('#land-area').text(landArea.toFixed(2));
            $('#dosage-value').text(dosage.toFixed(2));
            $('#total-pesticide').text(totalPesticide.toFixed(2));
            $('#water-value').text(totalWater.toFixed(2));
        });
    </script>

    <!-- Layanan -->
    <section class="client" id="services">
        <div class="bg-green-50 py-16">
          <div class="text-center mb-12 mt-16">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">
              Kelola Pertanian Anda Secara Modern & Efektif
            </h2>
            <p class="text-gray-600 text-lg">
              Layanan lengkap kami mendukung petani dalam mencapai pertanian ramah lingkungan yang berkelanjutan.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div
              class="bg-white p-6 shadow-lg rounded-lg text-center transform hover:scale-105 active:scale-95 transition duration-300 hover:shadow-2xl cursor-pointer"
            >
              <div class="mb-4">
                <div class="bg-green-100 text-green-600 p-4 inline-block rounded-full">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 10h11M9 21V3m8 7h3m-3 4h3"
                    />
                  </svg>
                </div>
              </div>
              <h3 class="text-2xl font-bold text-gray-800 mb-2">Kalkulasi Pestisida</h3>
              <p class="text-gray-600">
                Hitung kebutuhan pestisida secara tepat untuk hasil panen yang optimal tanpa mencemari lingkungan.
              </p>
            </div>

            <div
              class="bg-white p-6 shadow-lg rounded-lg text-center transform hover:scale-105 active:scale-95 transition duration-300 hover:shadow-2xl cursor-pointer"
            >
              <div class="mb-4">
                <div class="bg-blue-100 text-blue-600 p-4 inline-block rounded-full">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 10h16M4 14h16M4 18h16"
                    />
                  </svg>
                </div>
              </div>
              <h3 class="text-2xl font-bold text-gray-800 mb-2">Marketplace Pestisida</h3>
              <p class="text-gray-600">
                Temukan berbagai produk pestisida organik terbaik dalam satu platform.
              </p>
            </div>

            <div
              class="bg-white p-6 shadow-lg rounded-lg text-center transform hover:scale-105 active:scale-95 transition duration-300 hover:shadow-2xl cursor-pointer"
            >
              <div class="mb-4">
                <div class="bg-yellow-100 text-yellow-600 p-4 inline-block rounded-full">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9.75 21h4.5M12 3v18M3 12h18"
                    />
                  </svg>
                </div>
              </div>
              <h3 class="text-2xl font-bold text-gray-800 mb-2">Solusi Pertanian</h3>
              <p class="text-gray-600">
                Dapatkan solusi inovatif untuk mengatasi berbagai kendala pertanian.
              </p>
            </div>
          </div>
        </div>
      </section>

    <!--Produk-->
    <section class="bg-white py-12" id="products">
        <div class="container m-auto px-4">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Produk Rekomendasi kami</h2>
            <p class="text-gray-600 text-lg">
                Temukan produk rekomendasi kami yang telah terbukti efektif dan ramah lingkungan untuk mendukung pertanian Anda.
            </p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            @foreach ($products as $product )
            <div class="bg-white shadow-md rounded-lg p-4 w-[14rem]">
                <img src="{{ "storage/" . $product->image_path }}" alt="Product Image" class="w-[8rem] rounded-md mb-0 mx-auto">
                <h3 class="text-lg font-bold mb-0 text-black">{{ $product->product_name }}</h3>
                <p class="text-gray-700 mb-0">{{ $product->category->name }}</p>
                <div class="text-red-600 font-bold mb-0">Rp. {{ number_format($product->price, 0, '.',',') }}</div>
                <p class="text-gray-500 line-through mb-2">Rp100.000</p>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-700">{{ $product->user->store->name }}</span>
                </div>
                <a href="{{ route('user.dashboard') }}" class="block w-full text-center text-white bg-green-500 py-2 rounded-md hover:bg-yellow-400 hover:text-black border border-primary transition">Beli Sekarang</a>
            </div>
            @endforeach
          </div>
        </div>
      </section>




    <!-- Testimoni -->
      <section class="faq bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-4">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Pertanyaan Umum</h2>
            <p class="text-gray-600 text-lg">
              Temukan jawaban atas pertanyaan seputar pertanian organik dan penggunaan pestisida organik.
            </p>
          </div>

          <div class="space-y-4">
            <!-- Pertanyaan 1 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
              <button
                class="flex justify-between items-center w-full text-left text-gray-800 font-medium focus:outline-none"
                onclick="toggleFaq(1)"
              >
                <span>Apa itu pertanian organik?</span>
                <svg id="icon-1" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div id="faq-1" class="hidden mt-2 text-gray-600">
                Pertanian organik adalah sistem pertanian yang menggunakan bahan alami tanpa bahan kimia sintetis seperti pupuk dan pestisida buatan.
              </div>
            </div>

            <!-- Pertanyaan 2 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
              <button
                class="flex justify-between items-center w-full text-left text-gray-800 font-medium focus:outline-none"
                onclick="toggleFaq(2)"
              >
                <span>Mengapa pestisida organik lebih baik?</span>
                <svg id="icon-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div id="faq-2" class="hidden mt-2 text-gray-600">
                Pestisida organik lebih ramah lingkungan karena terbuat dari bahan alami dan tidak meninggalkan residu berbahaya pada tanaman maupun tanah.
              </div>
            </div>

            <!-- Pertanyaan 3 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
              <button
                class="flex justify-between items-center w-full text-left text-gray-800 font-medium focus:outline-none"
                onclick="toggleFaq(3)"
              >
                <span>Bagaimana cara membuat pestisida organik?</span>
                <svg id="icon-3" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div id="faq-3" class="hidden mt-2 text-gray-600">
                Pestisida organik dapat dibuat menggunakan bahan seperti bawang putih, cabai, daun nimba, atau tembakau yang dicampur dengan air dan difermentasi.
              </div>
            </div>

            <!-- Pertanyaan 4 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
              <button
                class="flex justify-between items-center w-full text-left text-gray-800 font-medium focus:outline-none"
                onclick="toggleFaq(4)"
              >
                <span>Apa manfaat pertanian organik bagi lingkungan?</span>
                <svg id="icon-4" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div id="faq-4" class="hidden mt-2 text-gray-600">
                Pertanian organik membantu menjaga keseimbangan ekosistem, meningkatkan kesuburan tanah, dan mengurangi pencemaran air akibat bahan kimia sintetis.
              </div>
            </div>

            <!-- Pertanyaan 5 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
              <button
                class="flex justify-between items-center w-full text-left text-gray-800 font-medium focus:outline-none"
                onclick="toggleFaq(5)"
              >
                <span>Apakah hasil panen organik lebih berkualitas?</span>
                <svg id="icon-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div id="faq-5" class="hidden mt-2 text-gray-600">
                Ya, hasil panen organik cenderung lebih sehat, bebas residu kimia, dan memiliki rasa serta kandungan nutrisi yang lebih baik.
              </div>
            </div>
          </div>
        </div>
      </section>

      <script>
        function toggleFaq(id) {
          const faqContent = document.getElementById(`faq-${id}`);
          const icon = document.getElementById(`icon-${id}`);
          faqContent.classList.toggle("hidden");
          icon.classList.toggle("rotate-180");
        }
      </script>
</div>

@include('components.footer')
@endsection
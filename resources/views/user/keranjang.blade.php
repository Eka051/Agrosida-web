@extends('components.template')
@include('components.sidebarUser')
@section('title', 'Keranjang Belanja')
@section('content')

<div class="ml-56  mt-[4.4rem] flex-1">
  <section class="bg-gradient-to-r from-green-500 to-green-600 p-8 text-center">
    <h1 class="text-3xl font-bold text-white">Keranjang Belanja</h1>
    <p class="text-green-100 mt-2">Kelola produk yang ingin Anda beli</p>
    <div class="flex justify-center mt-4 space-x-4">
      <span class="text-green-100">
        <span class="font-semibold text-white cart-count">{{ $carts->count() }}</span> item dalam keranjang
      </span>
    </div>
  </section>

  <section class="py-8">
    <div class="container mx-auto px-4">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 bg-green-500 text-white font-bold text-lg border-b">
          <div class="flex justify-between items-center">
            <span>Produk dalam Keranjang</span>
            <span class="text-sm">{{ $carts->count() }} item</span>
          </div>
        </div>


        <div class="divide-y divide-gray-200">
          @forelse ($carts as $cart)
          <div class="p-6 hover:bg-gray-50 transition duration-150" id="cart-item-{{ $cart->id }}"
            data-product-id="{{ $cart->id }}">
            <div class="flex items-center space-x-6">
              <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $cart->product->image_path) }}" alt="{{ $cart->product->product_name }}"
                  class="h-24 w-24 rounded-lg object-contain shadow-md">
              </div>

              <div class="flex-1">
                <div class="flex justify-between items-start">
                  <div>
                    <h3 class="text-lg font-medium text-gray-900">
                      {{ $cart->product->product_name }}
                    </h3>
                    <p class="text-base text-gray-500 mt-1">
                      Rp. {{ number_format($cart->product->price, 0, ',', '.') }} / unit
                    </p>
                  </div>
                  <div class="text-right">
                    <p class="text-lg font-semibold text-gray-900" id="subtotal-{{ $cart->id }}">
                        Rp. {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                    </p>
                  </div>
                </div>

                <div class="mt-4 flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <button type="button"
                      class="decrease p-2 rounded-sm bg-gray-100 hover:bg-gray-200 transition-colors duration-150"
                      data-product-id="{{ $cart->id }}">
                      <span class="iconify w-5 h-5" data-icon="heroicons-outline:minus"></span>
                    </button>

                    <input type="number" id="quantity-{{ $cart->id }}" name="quantity" value="{{ $cart->quantity }}"
                      min="1"
                      class="w-16 h-10 text-center border rounded-md focus:ring-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                      data-product-id="{{ $cart->id }}">

                    <button type="button"
                      class="increase p-2 rounded-sm bg-gray-100 hover:bg-gray-200 transition-colors duration-150"
                      data-product-id="{{ $cart->id }}">
                      <span class="iconify w-5 h-5" data-icon="heroicons-outline:plus"></span>
                    </button>
                  </div>

                  <form action="{{ route('cart.remove', $cart->product->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="text-white bg-red-600 py-3 px-2 rounded-md hover:bg-red-800 hover:text-white transition-colors duration-150 flex items-center space-x-1">
                      <span class="iconify" data-icon="heroicons-outline:trash"></span>
                      <span>Hapus</span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="p-8 text-center">
            <div class="text-gray-500 mb-4">
              <span class="iconify inline-block w-16 h-16" data-icon="heroicons-outline:shopping-cart"></span>
              <p class="mt-2">Keranjang belanja Anda kosong</p>
            </div>
            <a href="{{ route('user.dashboard') }}"
              class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-150">
              <span class="iconify mr-2" data-icon="heroicons-outline:shopping-bag"></span>
              Mulai Belanja
            </a>
          </div>
          @endforelse
        </div>

        @if($carts->count() > 0)
        <div class="p-6 bg-gray-50 border-t">
          <div class="flex justify-between items-center">
            <div class="text-xl font-semibold text-gray-900" id="total-price">
              Total: Rp. {{ number_format($carts->sum(fn($cart) => $cart->product->price * $cart->quantity), 0, ',',
              '.') }}
            </div>
            <a href="{{ route('cart.checkout') }}"
              class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-150">
              <span class="iconify mr-2" data-icon="heroicons-outline:shopping-bag"></span>
              Checkout
            </a>
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>
</div>

<div id="notification"
  class="fixed top-4 right-4 transform translate-x-full transition-transform duration-300 ease-in-out"></div>

<script>
  document.addEventListener('DOMContentLoaded', async () => {
      await initializeCart();
    });

  async function initializeCart() {
    const quantityInputs = document.querySelectorAll('input[name="quantity"]');
    const decreaseButtons = document.querySelectorAll('.decrease');
    const increaseButtons = document.querySelectorAll('.increase');

    quantityInputs.forEach(input => {
      input.addEventListener('change', handleQuantityInputChange);
      input.addEventListener('keydown', handleQuantityInputKeydown);
    });

    decreaseButtons.forEach(button => {
      button.addEventListener('click', handleQuantityButtonClick);
    });

    increaseButtons.forEach(button => {
      button.addEventListener('click', handleQuantityButtonClick);
    });
  }

  async function handleQuantityButtonClick(event) {
    const button = event.currentTarget;
    const productId = button.getAttribute('data-product-id');
    const quantityInput = document.getElementById(`quantity-${productId}`);
    let currentQuantity = parseInt(quantityInput.value);

    if (button.classList.contains('decrease') && currentQuantity > 1) {
      currentQuantity -= 1;
    } else if (button.classList.contains('increase')) {
      currentQuantity += 1;
    }

    await updateQuantity(productId, currentQuantity);
  }

  async function handleQuantityInputChange(event) {
    const input = event.target;
    const productId = input.id.split('-')[1];
    let quantity = parseInt(input.value);

    if (isNaN(quantity) || quantity < 1) {
        showNotification('Kuantitas harus minimal 1.', 'error');
        input.value = 1;
        quantity = 1;
    }

    await updateQuantity(productId, quantity);
  }

  function handleQuantityInputKeydown(event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      event.target.blur();
    }
  }

  async function updateQuantity(productId, quantity) {
    try {
        const response = await fetch('/cart/update-quantity', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                cart_items: [{
                    product_id: productId,
                    quantity: quantity
                }]
            })
        });

        if (response.ok) {
            const data = await response.json();
            updateCartUI(data.cart_items);
        } else {
            const errorData = await response.json();
            showNotification(errorData.message || 'Gagal memperbarui kuantitas', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan jaringan atau server.', 'error');
        console.error('Error:', error);
    }
  }

  function updateCartUI(cartItems) {
    cartItems.forEach(item => {
        const quantityInput = document.getElementById(`quantity-${item.product_id}`);
        const subtotalElement = document.getElementById(`subtotal-${item.product_id}`);
        const errorElement = document.getElementById(`error-message-${item.product_id}`);

        quantityInput.value = item.quantity;
        subtotalElement.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(item.subtotal)}`;

        if (errorElement) {
            errorElement.classList.add('hidden');
        }
    });

  }

  function showErrorOnItem(productId, message) {
      const errorElement = document.getElementById(`error-message-${productId}`);
      if (errorElement) {
          errorElement.textContent = message;
          errorElement.classList.remove('hidden');
      }
  }

</script>

@endsection
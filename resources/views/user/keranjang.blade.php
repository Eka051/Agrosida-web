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
        <span class="font-semibold text-white cart-count">{{ $carts->count() > 0 ? $carts->count() : 0 }}</span> item dalam keranjang
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
          @if($cart->product)
          <div class="p-6 hover:bg-gray-50 transition duration-150" id="cart-item-{{ $cart->id }}"
            data-product-id="{{ $cart->id }}">
            <div class="flex items-center space-x-6">
              <div class="flex-shrink-0">
          <img src="{{ asset('storage/'. $cart->product->image_path) }}" alt="{{ $cart->product->product_name }}"
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
                data-cart-id="{{ $cart->id }}">
                <span class="iconify w-5 h-5" data-icon="heroicons-outline:minus"></span>
              </button>

              <input type="number" id="quantity-{{ $cart->id }}" name="quantity" value="{{ $cart->quantity }}"
                min="1"
                class="w-16 h-10 text-center border rounded-md focus:ring-2 focus:outline-none focus:ring-green-500 focus:border-green-500"
                data-cart-id="{{ $cart->id }}">

              <button type="button"
                class="increase p-2 rounded-sm bg-gray-100 hover:bg-gray-200 transition-colors duration-150"
                data-cart-id="{{ $cart->id }}">
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
          @endif
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
              Total: Rp. {{ $cart->product ? number_format($carts->sum(fn($cart) => $cart->product->price * $cart->quantity), 0, ',', '.') : '' }}
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      initializeCart();
    });
  
    function initializeCart() {
      $('input[name="quantity"]').on('change', handleQuantityInputChange);
      $('.decrease').on('click', handleQuantityButtonClick);
      $('.increase').on('click', handleQuantityButtonClick);
    }
  
    function handleQuantityButtonClick(event) {
      const button = $(event.currentTarget);
      const cartId = button.data('cart-id');
      const quantityInput = $(`#quantity-${cartId}`);
      let currentQuantity = parseInt(quantityInput.val());
  
      if (button.hasClass('decrease') && currentQuantity > 1) {
        currentQuantity -= 1;
      } else if (button.hasClass('increase')) {
        currentQuantity += 1;
      }
  
      quantityInput.val(currentQuantity);
  
      const price = parseInt($(`#price-${cartId}`).data('price'));
      const newSubtotal = currentQuantity * price;
      $(`#subtotal-${cartId}`).text(`Rp. ${new Intl.NumberFormat('id-ID').format(newSubtotal)}`);
  
      updateTotalPrice();
      updateQuantity(cartId, currentQuantity);
    }
  
    function handleQuantityInputChange(event) {
      const input = $(event.target);
      const cartId = input.attr('id').split('-')[1];
      let quantity = parseInt(input.val());
  
      if (isNaN(quantity) || quantity < 1) {
        showNotification('Kuantitas harus minimal 1.', 'error');
        input.val(1);
        quantity = 1;
      }
  
      const price = parseInt($(`#price-${cartId}`).data('price')); // Ambil harga satuan
      const newSubtotal = quantity * price;
      $(`#subtotal-${cartId}`).text(`Rp. ${new Intl.NumberFormat('id-ID').format(newSubtotal)}`);
      updateTotalPrice();
      updateQuantity(cartId, quantity);
    }
  
    function updateQuantity(cartId, quantity) {
      console.log("Updating cart:", cartId, "with quantity:", quantity);
  
      $.ajax({
        url: '/cart/update-quantity',
        type: 'PUT',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        contentType: 'application/json',
        data: JSON.stringify({
          cart_items: [
            {
              cart_id: cartId,
              quantity: quantity
            }
          ]
        }),
        success: function (response) {
          console.log("Update success:", response);
          updateCartUI(response.cart_items);
        },
        error: function (xhr) {
          const errorData = xhr.responseJSON;
          console.error("Update error:", errorData);
          showNotification(errorData.message || 'Gagal memperbarui kuantitas', 'error');
        }
      });
    }
  
    function updateTotalPrice() {
      let totalPrice = 0;
  
      $('[id^=subtotal-]').each(function () {
        const subtotalText = $(this).text().replace(/[^\d]/g, ''); // Hanya ambil angka
        totalPrice += parseInt(subtotalText || 0);
      });
      $('#total-price').text(`Total: Rp. ${new Intl.NumberFormat('id-ID').format(totalPrice)}`);
    }
  
    function updateCartUI(cartItems) {
      cartItems.forEach(item => {
        const quantityInput = $(`#quantity-${item.cart_id}`);
        if (quantityInput.length) {
          quantityInput.val(item.quantity);
        }
        $(`#subtotal-${item.cart_id}`).text(`Rp. ${new Intl.NumberFormat('id-ID').format(item.subtotal)}`);
      });
  
      updateTotalPrice();
    }
  
    function showNotification(message, type) {
      const notification = $('#notification');
      notification.text(message).removeClass().addClass(`notification-${type}`).addClass('show');
      setTimeout(() => {
        notification.removeClass('show');
      }, 3000);
    }
  </script>
  
@endsection
@extends('layout.client.layout')
@section('content')
    <!-- Start breadcrumb area -->
    <div class="ht__breadcrumb__area bg-image--3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__inner text-center">
                        <h2 class="breadcrumb-title">Shopping Cart</h2>
                        <nav class="breadcrumb-content">
                            <a class="breadcrumb_item" href="{{ route('home') }}">Home</a>
                            <span class="brd-separator">/</span>
                            <span class="breadcrumb_item active">Shopping Cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End breadcrumb area -->
    <!-- cart-main-area start -->
    @if (auth()->user()->carts->count() > 0)
        <div class="cart-main-area section-padding--lg bg--white" style="margin-bottom: 20px">
            <div class="container">
                <h1>Giỏ hàng</h1>
                <div class="col-xs-12 col-sm-8">
                    @foreach ($carts as $cart)
                        <div class="cart-item">

                            <button class="delete-btn">
                                <a class="delete-btn" href="{{ route('cart.delete', $cart->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path
                                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                    </svg>
                                </a>
                            </button>
                            <img src="{{ asset('storage/images/' . $cart->image) }}" alt="" />
                            <div class="item-details">
                                <div class="item-name">
                                    {{ $cart->title_book }}
                                </div>
                                <div class="item-price">
                                    <p class="price">
                                        {{ $cart->money }} x</p>
                                    <div class="quantity-input">
                                        <form action="{{ route('cart.updateCart', $cart->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input name="quantity" min="1" type="number"
                                                value="{{ $cart->quantity }}">
                                            <button type="submit">Lưu số lượng</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="item-price">
                                    Price :
                                    <span class="qty">{{ $cart->money * $cart->quantity }} VND</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="item-checkout">
                        <form action="">
                            <input type="text" placeholder="Enter discount code ..." />
                            <button type="submit" class="btn-discount">Apply</button>
                        </form>
                        <div class="item-total">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                                @php
                                    $total += $cart->money * $cart->quantity;
                                @endphp
                            @endforeach
                            <p>
                                <span class="total-title">Total :</span>
                                <span class="total-price">{{ $total }}</span>
                            </p>
                            <p style="border-bottom: 1px solid black; padding-bottom: 10px">
                                <span class="total-title">Discount :</span>
                                <span class="total-price">- 0</span>
                            </p>
                            <p>
                                <span class="total-title">Sub Total :</span>
                                <span class="total-price">{{ $total }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <a class="Checkout" href="{{ route('cart.checkout') }}">Check Out</a>
                        <a class="Checkout" href="{{ route('cart.delete.all') }}">
                            <i class="fa fa-trash-o"></i>
                            <span>Clear Your Cart</span>
                        </a>
                    </div>
                </div>
                <!-- Thêm các mục giỏ hàng khác tại đây -->
            </div>
        </div>
    @else
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <h2 style="color:green; width:100%;text-align:center">Bạn hãy thêm sản phẩm vào giỏ hàng đi !</h2>
            </div>
        </div>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.getElementsByClassName('delete-btn');

            Array.from(deleteButtons).forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    var deleteUrl = this.getAttribute('href');

                    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    </script>
    <!-- cart-main-area end -->
@endsection

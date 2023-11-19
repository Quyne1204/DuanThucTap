@extends('layout.client.layout')
@section('content')
    <!-- Start breadcrumb area -->
    <div class="ht__breadcrumb__area bg-image--4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__inner text-center">
                        <h2 class="breadcrumb-title">Checkout</h2>
                        <nav class="breadcrumb-content">
                            <a class="breadcrumb_item" href="{{ route('home') }}">Home</a>
                            <span class="brd-separator">/</span>
                            <span class="breadcrumb_item active">Checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End breadcrumb area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container" style="margin-bottom: 20px">
            @if (auth()->user()->carts->count() > 0)
                @if (session('success'))
                    <h2 style="color:green; width:100%;text-align:center">{{ session('success') }}</h2>
                @else
                    <form action="{{ route('checkout.proccess') }}" method="POST">
                        @csrf
                        <div class="col-xs-12 col-sm-4">
                            <div class="Checkout-item">
                                <div class="input_name">
                                    <label for="">Họ và tên*</label>
                                    <input class="" type="text" name="customer_name" value="{{ $user->name }}" />
                                    @error('customer_name')
                                        <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_address">
                                    <label for="">Địa chỉ*</label>
                                    <input class="" type="text" name="customer_address"
                                        value="{{ $user->address }}" />
                                    @error('customer_address')
                                        <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_phone">
                                    <label for="">Số điện thoại*</label>
                                    <input class="" type="text" name="customer_phone"
                                        value="{{ $user->phone }}" />
                                    @error('customer_phone')
                                        <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_email">
                                    <label for="">Email*</label>
                                    <input class="" type="text" name="email" value="{{ $user->email }}"
                                        style="text-transform: lowercase" />
                                    @error('email')
                                        <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_note">
                                    <label for="">Note</label>
                                    <input class="" type="text" name="note" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <div class="item-checkout">
                                <h2>Your Order</h2>
                                <div class="item"></div>
                                <div class="item-total">

                                    @foreach ($carts as $cart)
                                        <p>
                                            <span class="total-title">{{ $cart->title_book }}</span>
                                            <span class="total-price"> {{ $cart->money * $cart->quantity }}</span>
                                            <span class="total-qty"> x {{ $cart->quantity }} = </span>
                                        </p>
                                    @endforeach
                                    @php
                                        $cart_total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $cart_total += $cart->money * $cart->quantity;
                                        @endphp
                                    @endforeach
                                    <p>
                                        <span class="total-title">Total :</span>
                                        <span class="total-price">{{ $cart_total }}</span>
                                    </p>
                                    <p>
                                        <span class="total-title">Ship :</span>
                                        <input type="hidden" value="0" name="ship">
                                        <span class="total-price">+ 0</span>
                                    </p>
                                    <p style="border-bottom: 1px solid black; padding-bottom: 10px">
                                        <span class="total-title">Discount :</span>
                                        <span class="total-price">- 0</span>
                                    </p>
                                    <p>
                                        <span class="total-title">Submit Total :</span>
                                        <input type="hidden" value="{{ $cart_total }}" name="total">
                                        <span class="total-price">{{ $cart_total }}</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button class="Checkout" type="submit" name="pay">Thanh Toán</button>
                                <button type="submit" class="Checkoutbtn" name="redirect">Thanh Toán
                                    Bằng VNPay</button>
                            </div>
                        </div>
                    </form>
                @endif
            @else
                <h2 style="color:green; width:100%;text-align:center">Bạn hãy mua hàng đi !</h2>
            @endif
        </div>
    </section>

    <!-- End Checkout Area -->
@endsection
@section('script')
    <script>
        $(function() {
            getToTalValue()

            function getToTalValue() {
                let total = $('.total-price').data('price')

                let shipping = $('.shipping').data('price')
                $('.total-price-all').text(`$${total + shipping}`)
                $('#total').val(total + shipping)
            }
        });
    </script>
@endsection

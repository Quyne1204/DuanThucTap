<!--************************************Header Start*************************************-->
<header id="tg-header" class="tg-header tg-headervtwo tg-haslayout">
    <div class="tg-topbar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (Auth::check())
                        <div class="dropdown ">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi, {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" style="padding-left:20px;"
                                    href="{{ route('view.acc', Auth::user()->id) }}">View
                                    Account</a>
                                <br>
                                <a class="dropdown-item" style="padding-left:20px;"
                                    href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-end p-2">
                            <a href="{{ route('signin') }}" class="p-2 ps-3 pe-3 me-3 btn bg-none"
                                style="font-weight:bold">Signin</a>
                            <a href="{{ route('signup') }}" class="p-2 ps-3 pe-3 btn bg-none"
                                style="font-weight:bold">Signup</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tg-middlecontainer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="tg-logo"><a href="{{ route('home') }}"><img
                                src="{{ asset('assets/images/logo.png') }}" alt="company name here"></a></strong>
                    <div class="tg-searchbox">
                        <form class="tg-formtheme tg-formsearch" action="{{ route('search') }}" method="GET">
                            <fieldset>
                                <input type="text" name="search" class="typeahead form-control"
                                    placeholder="Search by title">
                                <button type="submit" class="tg-btn">Search</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tg-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-navigationholder">
                        <nav id="tg-nav" class="tg-nav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#tg-navigation" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                <ul>
                                    <li class="menu-item-has-children menu-item-has-mega-menu">
                                        <a href="#">All Categories</a>
                                        <ul class="sub-menu">
                                            @foreach ($cates as $cate)
                                                <li>
                                                    <a
                                                        href="{{ route('cate.load', ['id' => $cate->id, 'slug' => Str::slug($cate->cate_Name)]) }}">{{ $cate->cate_Name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </li>
                                    <li class="menu-item-has-children current-menu-item">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Authors</a>
                                        <ul class="sub-menu">
                                            @foreach ($books as $book)
                                                <li>
                                                    <a
                                                        href="{{ route('author.load', ['key' => $book->author, 'slug' => Str::slug($book->author)]) }}">{{ $book->author }}</a>

                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('book.load') }}">Products</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="tg-wishlistandcart">
                            <div class="dropdown tg-themedropdown tg-minicartdropdown">
                                <a href="#" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="tg-themebadge">
                                        @php
                                            if (Auth::check()) {
                                                $user = auth()->user();
                                                $cartItems = $user->carts;
                                                echo $cartItems->count();
                                            } else {
                                                echo 0;
                                            }
                                        @endphp
                                    </span>
                                    <i class="icon-cart"></i>
                                </a>
                                <div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
                                    <div class="tg-minicartbody">
                                        @if (isset($carts))
                                            @foreach ($carts as $cart)
                                                <div class="tg-minicarproduct">
                                                    <figure>
                                                        <img src="{{ asset('storage/images/' . $cart->image) }}"
                                                            alt="image description" style="width:60px">

                                                    </figure>
                                                    <div class="tg-minicarproductdata">
                                                        <h5><a
                                                                href="{{ route('book.detail', $cart->book_id) }}">{{ $cart->title_book }}</a>
                                                        </h5>
                                                        <h6>{{ $cart->money }} x {{ $cart->quantity }}</h6>
                                                        <h6> Price : {{ $cart->money * $cart->quantity }} VND</h6>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="tg-minicartfoot">
                                        <a class="tg-btnemptycart" href="{{ route('cart.delete.all') }}">
                                            <i class="fa fa-trash-o"></i>
                                            <span>Clear Your Cart</span>
                                        </a>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @if (isset($carts))
                                            @foreach ($carts as $cart)
                                                @php
                                                    $total += $cart->money * $cart->quantity;
                                                @endphp
                                            @endforeach
                                        @endif
                                        <span class="tg-subtotal">Subtotal: <strong>{{ $total }}
                                                VND</strong></span>
                                        <div class="tg-btns">
                                            <a class="tg-btn tg-active" href="{{ route('cart.index') }}">View
                                                Cart</a>
                                            <a class="tg-btn" href="{{ route('cart.checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--************************************Header End*************************************-->

@extends('layout.client.layout')

@section('title', 'Book Detail')
@section('content')
    <!--************************************Inner Banner Start*************************************-->
    <div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600"
        data-parallax="scroll" data-image-src="{{ asset('assets/images/parallax/bgparallax-07.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-innerbannercontent">
                        <h1>All Products</h1>
                        <ol class="tg-breadcrumb">
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="{{ route('book.load') }}">Products</a></li>
                            <li class="tg-active">{{ $book->title_book }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************************************Inner Banner End*************************************-->
    <!--************************************Main Start*************************************-->
    <main id="tg-main" class="tg-main tg-haslayout">
        @if (session('message'))
            <h2 style="color:red; width:100%;text-align:center">{{ session('message') }}</h2>
        @endif
        <!--************************************News Grid Start*************************************-->
        <div class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <div class="col ">
                            <div id="tg-content" class="tg-content">

                                <div class="tg-productdetail">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            <div class="tg-postbook">
                                                <figure class="tg-featureimg"><img
                                                        src="{{ asset('storage/images/' . $book->image) }}"
                                                        alt="image description"></figure>
                                                <div class="tg-postbookcontent">
                                                    <span class="tg-bookprice">
                                                        <ins>{{ $book->price }} VND</ins>
                                                    </span>
                                                    <ul class="tg-delevrystock">
                                                        <li><i class="icon-rocket"></i><span>Free delivery worldwide</span>
                                                        </li>
                                                        <li><i class="icon-checkmark-circle"></i><span>Dispatch from the USA
                                                                in 2 working days </span></li>
                                                    </ul>
                                                    <form action="{{ route('client.carts.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                        <div class="tg-quantityholder">
                                                            <em class="minus">-</em>
                                                            <input type="number" min="1" max="{{ $book->quantity }}"
                                                                class="result" value="1" id="quantity1" name="qty">
                                                            <em class="plus">+</em>
                                                        </div>
                                                        <button type="submit" class="tg-btn tg-active tg-btn-lg"
                                                            href="javascript:void(0);">Add To Cart</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                            <div class="tg-productcontent">
                                                <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
                                                <div class="tg-booktitle">
                                                    <h3>{{ $book->title_book }}</h3>
                                                </div>
                                                <span class="tg-bookwriter">By: {{ $book->author }} </span>
                                                <span class="tg-bookwriter text-primary">Description:</span>
                                                <ul class="tg-productinfo" style="margin-right: 10px">
                                                    @php echo $book->description @endphp
                                                </ul>
                                            </div>
                                        </div>
                                        {{-- //Review --}}
                                        <div class="tg-relatedproducts">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="tg-sectionhead">
                                                    <h2>Customers Review</h2>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="card-body  col-xs-12 col-sm-8">
                                                    @if (!isset($comment))
                                                        @foreach ($comment as $cm)
                                                            <div
                                                                style="margin-top: 10px;margin-left:20px;margin-bottom:15px;padding:20px; border:1px solid white ; border-radius:5px ;box-shadow:0 0 3px black;">
                                                                <div class="align-items-center">
                                                                    <div>
                                                                        <p class="text-muted small">
                                                                            {{ $cm->created_at }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div style="display: flex">
                                                                    <h4 class="fw-bold mb-1"
                                                                        style="font-weight:bold;margin-right:20px ">
                                                                        {{ $users->find($cm->id_customer)->name }}:
                                                                    </h4>
                                                                    {{ $cm->content }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="review-fieldset ">
                                                            <p
                                                                style="color:red;margin-top:20px;font-size:25px;line-height: 1.5;">
                                                                Sản phẩm bày hiện chưa có bình luận nào !</p>

                                                        </div>
                                                    @endif
                                                </div>

                                                @if (Auth::check())
                                                    <div class="review-fieldset col-xs-12 col-sm-4">
                                                        <h2>You Comment :</h2>
                                                        <div class="review_form_field">
                                                            <form action="{{ route('post.review') }}" method="POST">
                                                                @csrf
                                                                <div class="input__box">
                                                                    <textarea name="content" placeholder="Enter comment"></textarea>
                                                                </div>

                                                                <input type="hidden" class="form-control" name="id_book"
                                                                    id="id_book" value="{{ $book->id }}">
                                                                <div class="review-form-actions">
                                                                    <button
                                                                        style="padding: 10px;margin-top:15px;background-color:aqua">Submit
                                                                        Review</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="review-fieldset col-xs-12 col-sm-4">
                                                        <p
                                                            style="color:red;margin-top:20px;font-size:25px;line-height: 1.5;">
                                                            Bạn cần đăng
                                                            nhập để có thể bình luận !</p>

                                                    </div>
                                                @endif
                                            </div>

                                        </div>


                                        <div class="tg-relatedproducts">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="tg-sectionhead">
                                                    <h2><span>Related Products</span>You May Also Like</h2>
                                                    <a class="tg-btn" href="{{ route('book.load') }}">View All</a>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                                @foreach ($books2 as $book_relate)
                                                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                        <div class="tg-postbook">
                                                            <a href="{{ route('book.detail', $book_relate->id) }}">
                                                                <figure class="tg-featureimg">
                                                                    <div class="tg-bookimg">
                                                                        <div class="tg-frontcover"><img
                                                                                style="height:256px"
                                                                                src="{{ asset('storage/images/' . $book_relate->image) }}"
                                                                                alt="image description"></div>
                                                                        <div class="tg-backcover"><img
                                                                                style="height:256px"
                                                                                src="{{ asset('storage/images/' . $book_relate->image) }}"
                                                                                alt="image description"></div>
                                                                    </div>
                                                                </figure>
                                                            </a>

                                                            <div class="tg-postbookcontent">
                                                                <div class="tg-themetagbox"><span
                                                                        class="tg-themetag">sale</span>
                                                                </div>
                                                                <div class="tg-booktitle">
                                                                    <h3 style="height: 57px">
                                                                        <a
                                                                            href="{{ route('book.detail', $book_relate->id) }}">{{ $book_relate->title_book }}</a>
                                                                    </h3>
                                                                </div>
                                                                <span class="tg-bookprice">
                                                                    <ins>{{ $book_relate->price }} VND</ins>
                                                                    <del>{{ $book_relate->original_price }} VND</del>
                                                                </span>
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="book_id"
                                                                        value="{{ $book->id }}">
                                                                    <button class="tg-btn tg-btnstyletwo"
                                                                        style="padding-left: 30%">
                                                                        <i class="fa fa-shopping-basket"></i>
                                                                        <em>Add To Cart</em>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
        <!--************************************News Grid End*************************************-->
    </main>
    <!--************************************Main End *************************************-->
@endsection

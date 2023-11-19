@extends('layout.client.layout')
@section('title', 'Home')
@section('content')
    <main id="tg-main" class="tg-main tg-haslayout">
        <!--************************************Best Selling Start*************************************-->
        <section class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="tg-sectionhead">
                            <h2><span>People’s Choice</span>Bestselling Books</h2>
                            <a class="tg-btn" href="{{ route('book.load') }}">View All</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-bestsellingbooksslider"
                            class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
                            @foreach ($books as $book)
                                <div class="item">
                                    <div class="tg-postbook">
                                        <a href="{{ route('book.detail', $book->id) }}">
                                            <figure class="tg-featureimg">
                                                <div class="tg-bookimg">
                                                    <div class="tg-frontcover">
                                                        <img src="{{ asset('storage/images/' . $book->image) }}"
                                                            alt="image description">
                                                    </div>
                                                    <div class="tg-backcover">
                                                        <img src="{{ asset('storage/images/' . $book->image) }}"
                                                            alt="image description">
                                                    </div>
                                                </div>
                                            </figure>
                                        </a>
                                        <div class="tg-postbookcontent">
                                            <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
                                            <div class="tg-booktitle">
                                                <h3 style="max-height: 57px">
                                                    <a
                                                        href="{{ route('book.detail', $book->id) }}">{{ $book->title_book }}</a>
                                                </h3>
                                            </div>

                                            <span class="tg-bookprice">
                                                <ins>{{ $book->price }} VND</ins>
                                            </span>
                                            <form action="{{ route('client.carts.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <button class="tg-btn tg-btnstyletwo" href="">
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
        </section>
        <!--************************************Best Selling End*************************************-->

        <!--************************************New Release Start*************************************-->
        <section class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="tg-newrelease">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="tg-sectionhead">
                                <h2><span>Taste The New Spice</span>New Release Books</h2>
                            </div>
                            <div class="tg-description">
                                <p>Một trong những loại sách mới lên kệ hàng. Chắc chắn sẽ làm bạn yêu thích. Hãy nhanh tay
                                    đặt mua ngay nào!!</p>
                            </div>
                            <div class="tg-btns">
                                <a class="tg-btn tg-active" href="{{ route('book.load') }}">View All</a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="row">
                                <div class="tg-newreleasebooks">
                                    @foreach ($booksnew as $book)
                                        <div class="col-xs-4 col-sm-4 col-md-6 col-lg-4">
                                            <div class="tg-postbook">
                                                <a href="{{ route('book.detail', $book->id) }}">
                                                    <figure class="tg-featureimg">
                                                        <div class="tg-bookimg">
                                                            <div class="tg-frontcover"><img
                                                                    src="{{ asset('storage/images/' . $book->image) }}"
                                                                    alt="image description"></div>
                                                            <div class="tg-backcover"><img
                                                                    src="{{ asset('storage/images/' . $book->image) }}"
                                                                    alt="image description"></div>
                                                        </div>
                                                    </figure>
                                                    <div class="tg-postbookcontent">
                                                        <div class="tg-booktitle">
                                                            <h3>{{ $book->title_book }}</h3>
                                                        </div>
                                                        <span class="tg-bookprice">
                                                            <ins>{{ $book->price }} VND</ins>
                                                        </span>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--************************************
                                                                                                                                                                                                                    New Release End
                                                                                                                                                                                                            *************************************-->




        <!--************************************
                                                                                                                                                                                                                    Call to Action Start
                                                                                                                                                                                                            *************************************-->
        <section class="tg-parallax tg-bgcalltoaction tg-haslayout" data-z-index="-100" data-appear-top-offset="600"
            data-parallax="scroll" data-image-src="images/parallax/bgparallax-06.jpg">
            <div class="tg-sectionspace tg-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-calltoaction">
                                <h2>Open Discount For All</h2>
                                <h3>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore.</h3>
                                <a class="tg-btn tg-active" href="javascript:void(0);">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--************************************
                                                                                                                                                                                                                    Call to Action End
                                                                                                                                                                                                            *************************************-->

    </main>
@endsection

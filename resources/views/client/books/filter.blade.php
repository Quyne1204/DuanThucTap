@extends('layout.client.layout')
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
                            <li class="tg-active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************************************Inner Banner End *************************************-->
    <!--************************************Main Start*************************************-->
    <main id="tg-main" class="tg-main tg-haslayout">
        <!--************************************News Grid Start*************************************-->
        <div class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
                            <div id="tg-content" class="tg-content">
                                <div class="tg-products">
                                    <div class="tg-productgrid">
                                        @foreach ($books2 as $book)
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
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
                                                    </a>

                                                    <div class="tg-postbookcontent">
                                                        <div class="tg-themetagbox"><span class="tg-themetag">sale</span>
                                                        </div>
                                                        <div class="tg-booktitle">
                                                            <h3 style="height: 57px"><a
                                                                    href="{{ route('book.detail', $book->id) }}">{{ $book->title_book }}</a>
                                                            </h3>
                                                        </div>
                                                        <span class="tg-bookprice">
                                                            <ins>{{ $book->price }} VND</ins>
                                                            <del>{{ $book->original_price }} VND</del>
                                                        </span>
                                                        <form action="{{ route('client.carts.add') }}" method="POST">@csrf
                                                            <input type="hidden" name="book_id"
                                                                value="{{ $book->id }}">
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
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
                            <aside id="tg-sidebar" class="tg-sidebar">

                                <div class="tg-widget tg-catagories">
                                    <div class="tg-widgettitle">
                                        <h3>Categories</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            @foreach ($cates as $cate)
                                                <li><a
                                                        href="{{ route('cate.load', ['id' => $cate->id, 'slug' => Str::slug($cate->cate_Name)]) }}">{{ $cate->cate_Name }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                                <div class="tg-widget tg-widgettrending">
                                    <div class="tg-widgettitle">
                                        <h3>Trending Products</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li>
                                                <article class="tg-post">
                                                    <figure><a href="javascript:void(0);"><img
                                                                src="{{ asset('assets/images/products/img-04.jpg') }}"
                                                                alt="image description"></a></figure>
                                                    <div class="tg-postcontent">
                                                        <div class="tg-posttitle">
                                                            <h3><a href="javascript:void(0);">Where The Wild Things Are</a>
                                                            </h3>
                                                        </div>
                                                        <span class="tg-bookwriter">By: <a
                                                                href="javascript:void(0);">Kathrine Culbertson</a></span>
                                                    </div>
                                                </article>
                                            </li>
                                            <li>
                                                <article class="tg-post">
                                                    <figure><a href="javascript:void(0);"><img
                                                                src="{{ asset('assets/images/products/img-05.jpg') }}"
                                                                alt="image description"></a></figure>
                                                    <div class="tg-postcontent">
                                                        <div class="tg-posttitle">
                                                            <h3><a href="javascript:void(0);">Where The Wild Things Are</a>
                                                            </h3>
                                                        </div>
                                                        <span class="tg-bookwriter">By: <a
                                                                href="javascript:void(0);">Kathrine Culbertson</a></span>
                                                    </div>
                                                </article>
                                            </li>
                                            <li>
                                                <article class="tg-post">
                                                    <figure><a href="javascript:void(0);"><img
                                                                src="{{ asset('assets/images/products/img-06.jpg') }}"
                                                                alt="image description"></a></figure>
                                                    <div class="tg-postcontent">
                                                        <div class="tg-posttitle">
                                                            <h3><a href="javascript:void(0);">Where The Wild Things Are</a>
                                                            </h3>
                                                        </div>
                                                        <span class="tg-bookwriter">By: <a
                                                                href="javascript:void(0);">Kathrine Culbertson</a></span>
                                                    </div>
                                                </article>
                                            </li>
                                            <li>
                                                <article class="tg-post">
                                                    <figure><a href="javascript:void(0);"><img
                                                                src="{{ asset('assets/images/products/img-07.jpg') }}"
                                                                alt="image description"></a></figure>
                                                    <div class="tg-postcontent">
                                                        <div class="tg-posttitle">
                                                            <h3><a href="javascript:void(0);">Where The Wild Things Are</a>
                                                            </h3>
                                                        </div>
                                                        <span class="tg-bookwriter">By: <a
                                                                href="javascript:void(0);">Kathrine Culbertson</a></span>
                                                    </div>
                                                </article>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--************************************
                                                                                                                                                                                                                                                                             News Grid End
                                                                                                                                                                                                                                                                           *************************************-->
    </main>
    <!--************************************
                                                                                                                                                                                                                                                                            Main End
                                                                                                                                                                                                                                                                          *************************************-->
@endsection

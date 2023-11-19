@extends('layout.dashboard.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('book.list') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->

        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title_book" id="title"
                                                class="form-control border-none" value="{{ $book->title_book }}" disabled
                                                placeholder="Tên Sách">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Author</label>
                                            <input type="text" name="author" id="title"
                                                class="form-control border-none" value="{{ $book->author }}" disabled
                                                placeholder="Tác giả">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <p>@php echo $book->description @endphp</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">

                            <div class="card-body">
                                <h2 class="h4 mb-3">Image</h2>
                                <img class="col-3" src="{{ asset('storage/images/' . $book->image) }}" alt="">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4  mb-3">Book category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <input type="text" name="author" id="title" class="form-control border-none"
                                        value="{{ $cate->cate_Name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Price</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Original Price</label>
                                            <input type="text" name="original_price" id=""
                                                class="form-control border-none" value="{{ $book->original_price }} VND"
                                                disabled placeholder="Giá Bìa">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for=""> Price</label>
                                            <input type="text" name="price" id="compare_price"
                                                class="form-control border-none" value="{{ $book->price }} VND" disabled
                                                placeholder=" Giá">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Quantity</h2>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="number" min="0" name="quantity" id="qty"
                                                class="form-control border-none" value="{{ $book->quantity }}" disabled
                                                placeholder="Quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

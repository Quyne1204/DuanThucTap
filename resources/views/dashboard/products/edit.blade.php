@extends('layout.dashboard.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Product</h1>
                    </div>
                    @if ($success = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ $success }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->

        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{ route('book.edit.post', $book->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" name="title_book" id="title"
                                                    value="{{ $book->title_book }}" class="form-control"
                                                    placeholder="Tên Sách">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Author</label>
                                                <input type="text" name="author" id="title"
                                                    value="{{ $book->author }}" class="form-control" placeholder="Tác Giả">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                    placeholder="Thông tin sách ">{{ $book->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Image title</h2>
                                    <input class="form-control" id="" name="image" type="file">
                                    <br>
                                    <img src="{{ asset('storage/images/' . $book->image) }}"
                                        style="width: 200px ; height: 150px; object-fit: cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4  mb-3">Book category</h2>
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="id_cate" id="category" class="form-control" value="">
                                            <option value="" disabled selected>Choose Your option</option>
                                            @foreach ($cates as $cate)
                                                @if ($book->id_cate === $cate->id)
                                                    <option value="{{ $cate->id }}" selected>{{ $cate->cate_Name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $cate->id }}">{{ $cate->cate_Name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Pricing</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for=""> Price</label>
                                                <input type="text" name="price" value="{{ $book->price }}"
                                                    id="compare_price" class="form-control" placeholder=" Giá">
                                                <p class="text-muted mt-3">
                                                    Original price is the price printed on the copyright cover of the book,
                                                    Price is the actual selling price (sale, price increase,...)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Inventory</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="number" name="quantity" value="{{ $book->quantity }}"
                                                    class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('book.list') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

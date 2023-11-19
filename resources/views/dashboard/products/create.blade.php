@extends('layout.dashboard.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
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
                <form action="{{ route('book.create.post') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" name="title_book" id="title" class="form-control"
                                                    placeholder="Tên Sách" value="{{ old('title_book') }}">
                                                @error('title_book')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Author</label>
                                                <input type="text" name="author" id="title" class="form-control"
                                                    placeholder="Tác giả" value="{{ old('author') }}">
                                                @error('author')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                    placeholder="Thông tin sách "> {{ old('description') }}</textarea>
                                                @error('description')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">

                                <div class="card-body">
                                    <h2 class="h4 mb-3">Image</h2>
                                    <input class="form-control" name="image" type="file">
                                    @error('image')
                                        <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                        </p>
                                    @enderror
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
                                                <option value="{{ $cate->id }}">{{ $cate->cate_Name }} </option>
                                            @endforeach
                                        </select>
                                        @error('id_cate')
                                            <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Price</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for=""> Price</label>
                                                <input type="text" name="price" id="compare_price" class="form-control"
                                                    placeholder=" Giá" value="{{ old('price') }}">
                                                @error('price')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
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
                                    <h2 class="h4 mb-3">Quantity</h2>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="number" min="0" name="quantity" id="qty"
                                                    class="form-control" placeholder="Quantity"
                                                    value="{{ old('quantity') }}">
                                                @error('quantity')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary" type="submit">Create</button>
                        <a href="{{ route('book.list') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

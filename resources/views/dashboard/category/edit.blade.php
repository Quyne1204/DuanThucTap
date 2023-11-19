@extends('layout.dashboard.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Category</h1>
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
                <form action="{{ route('cate.edit.post', $cate->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Name Categogy</label>
                                                <input type="text" name="cate_Name" id="cate_Name" class="form-control"
                                                    placeholder="Name Categogy" value="{{ $cate->cate_Name }}">
                                                @error('cate_Name')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label for="title">Slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"
                                                    placeholder="Slug">
                                                @error('slug')
                                                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('cate.list') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

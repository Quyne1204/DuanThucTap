@extends('layout.dashboard.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">New User</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header pr-5">
                        <div class="card-tools">
                            <form class="input-group input-group" style="width: 350px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Enter Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <strong>Search</strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Number Phone</th>
                                    <th>Address</th>
                                    <th width="340">Role</th>
                                    <th width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        {{-- <td>{{ $user->phone ? $user->phone : 'Không có' }}</td> --}}
                                        <td>
                                            {{ $user->role == 1 ? 'Admin' : ($user->role == 2 ? 'Nhân viên' : 'Người dùng') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                style="margin-right:5px;width:1.3rem">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('user.delete', $user->id) }}" class="delete-btn">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 " xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>



            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
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
@endsection
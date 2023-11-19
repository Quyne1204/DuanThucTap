@extends('layout.client.layout')

@section('title', 'Sign In')
@section('content')
    <div class="container">
        <div class="row view-acc">
            <div class="col-xs-12 col-sm-2" style="padding: 20px">
                <a class="col-xs-2 col-sm-12 a-title" href="{{ route('view.acc') }}">Xem Thông Tin</a>
                <a class="col-xs-3 col-sm-12 a-title" href="{{ route('view.his') }}">Lịch sử đặt hàng</a>
            </div>
            <div style="padding: 30px" class="col-xs-12 col-sm-10">
                <form action="{{ route('view.edit.post', Auth::id()) }}" method="POST">
                    @csrf
                    <div class="row a-input">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="username" value="{{ $user->username }}" placeholder="User Name"
                                disabled>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Email*" name="email" value="{{ $user->email }}" disabled>

                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Fullname*" name="name" value="{{ $user->name }}">
                            @error('name')
                                <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" placeholder="Address*" name="address" value="{{ $user->address }}">
                            @error('address')
                                <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="phone" placeholder="Phone*" value="{{ $user->phone }}">
                            @error('phone')
                                <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <button class="a" type="submit">Xác Nhận</button>
                        <a class="a" href="{{ route('view.acc') }}">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

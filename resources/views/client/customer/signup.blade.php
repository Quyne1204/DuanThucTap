@extends('layout.client.layout')

@section('title', 'Sign Up')
@section('content')
    <div class="login-box">
        <div class="login-cart">
            <h2>Sign Up</h2>
            <h3>Enter your credentials</h3>

            <form class="login-form" action="{{ route('signup.post') }}" method="POST">
                @csrf
                <input type="text" placeholder="Fullname" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                @enderror
                <input type="text" placeholder="Username" name="username" value="{{ old('username') }}">
                @error('username')
                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                @enderror
                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                @enderror
                <input type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                @error('password')
                    <p class="d-flex justify-content-start ps-3 text-danger">{{ $message }}</p>
                @enderror
                <button type="submit">Sign Up</button>
                <p>You have an account? <a Style="color:blue" href="{{ route('signin') }}">Sign In</a></p>
            </form>
        </div>
    </div>
@endsection

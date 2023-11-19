<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('assets/css/loginAdmin.css') }}">

</head>

<body>

    <div class="form-container">

        <form action="{{ route('login.post') }}" method="post">
            @csrf
            <h3>login admin</h3>
            <input type="text" name="email" placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
                <p style="font-size: 14px;color:red;float:left">{{ $message }}</p>
            @enderror
            <input type="password" name="password" placeholder="Enter your password" value="{{ old('password') }}">
            @error('password')
                <p style="font-size: 14px;color:red;float:left">{{ $message }}</p>
            @enderror
            @if (session('error'))
                <p style="font-size: 14px;color:red;float:left">{{ session('error') }}</p>
            @endif
            <input type="submit" name="submit" value="Login now" class="form-btn">
        </form>

    </div>

</body>

</html>

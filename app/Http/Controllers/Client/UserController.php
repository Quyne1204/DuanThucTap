<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EditUserRequest;
use App\Http\Requests\Auth\ResetPassRequest;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Login
    public function signin()
    {
        $books = Book::all();
        $cates = Category::all();
        return view('client/customer/signin', compact('books', 'cates'));
    }
    public function signinPost(SigninRequest $request)
    {
        $user = $request->only('username', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('home');
        } else {
            $error = 'Bạn sai thông tin Username hoặc Password!';
            return redirect()->back()->withErrors(['error' => $error])->with('loginError', $error);
        }
    }

    // SignUp
    public function signup()
    {
        $books = Book::all();
        $cates = Category::all();
        return view('client/customer/signup', compact('books', 'cates'));
    }
    public function signupPost(SignupRequest $request)
    {
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if (!$user) {
            return redirect(route('signup'));
        } else {
            return redirect(route('signin'));
        }
    }

    // Logout
    function logout()
    {
        Auth::logout();
        $books = Book::all();
        $cates = Category::all();
        $booksnew = Book::orderBy('created_at', 'desc')->paginate(3);
        return view('HomeClient', compact('books', 'cates', 'booksnew'));
    }

    //viewAcc
    public function viewacc()
    {
        $books = Book::all();
        $cates = Category::all();
        $user = User::find(Auth::id())->first();
        return view('client.customer.my_acc', compact('books', 'cates', 'user'));
    }
    public function viewedit()
    {
        $books = Book::all();
        $cates = Category::all();
        $user = User::find(Auth::id())->first();
        return view('client.customer.edit', compact('books', 'cates', 'user'));
    }
    public function vieweditPost(EditUserRequest $rq, $id)
    {
        $books = Book::all();
        $cates = Category::all();
        $cart = User::find($id)->first();
        $cart['name'] = $rq->name;
        $cart['address'] = $rq->address;
        $cart['phone'] = $rq->phone;
        $cart->save();

        $user = User::find(Auth::id())->first();
        return view('client.customer.my_acc', compact('books', 'cates', 'user'));
    }
    public function vieworder()
    {
        $books = Book::all();
        $cates = Category::all();
        $user = User::find(Auth::id())->first();
        $orders = Order::where('id_customer', Auth::id())->get();
        return view('client.customer.hisorder', compact('books', 'cates', 'user', 'orders'));
    }
    public function viewhuy($id)
    {
        $books = Book::all();
        $cates = Category::all();
        $user = User::find(Auth::id())->first();
        $orders = Order::where('id_customer', Auth::id())->get();
        $order = Order::find($id);
        $order['status'] = 4;
        $order->save();
        return view('client.customer.hisorder', compact('books', 'cates', 'user', 'orders'));
    }
}

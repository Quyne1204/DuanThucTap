<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $cates = Category::all();
        $books = Book::all();
        $carts = null;
        $booksnew = Book::orderBy('created_at', 'desc')->paginate(3);
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }
        return view('HomeClient', compact('cates', 'books', 'carts', 'booksnew'));
    }
    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $cates = Category::all();
            $books = Book::all();
            $carts = null;
            if (Auth::check()) {
                $carts = DB::table('carts')
                    ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                    ->join('books', 'books.id', '=', 'carts.book_id')
                    ->where('carts.user_id', '=',  Auth::user()->id)
                    ->get();
            }
            $books2 = Book::orderBy('created_at', 'DESC')->where('title_book', 'like', '%' . $search . '%')->orWhere('author', 'like', '%' . $search . '%')->paginate();
            return view('client.books.filter', compact('cates', 'books', 'books2', 'carts'));
        } else {
            return redirect()->back();
        }
    }
    public function author($key)
    {
        $cates = Category::all();
        $books = Book::all();
        $books2 = Book::orderBy('created_at', 'DESC')->where('author', '=', $key)->paginate();
        $carts = null;
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }
        return view('client.books.filter', compact('cates', 'books', 'books2', 'carts'));
    }
    public function category($id)
    {
        $cates = Category::all();
        $books = Book::all();
        $books2 = Book::orderBy('created_at', 'DESC')->where('id_cate', '=', $id)->paginate();
        $carts = null;
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }
        return view('client.books.filter', compact('cates', 'books', 'books2', 'carts'));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $cates = Category::all();
        $carts = null;
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }
        return view('client.books.books', compact('books', 'cates', 'carts'));
    }
    public function bookDetail($id)
    {
        $cates = Category::all();
        $book = Book::find($id);
        $books = Book::all();
        $books2 = Book::where('id_cate', $book->id_cate)
            ->where('id', '!=', $book->id)
            ->get();;
        $users = User::all();
        $comment = Review::with('user')->where('id_book', $id)->get();
        $carts = null;
        if (Auth::check()) {
            $carts = DB::table('carts')
                ->select('carts.quantity', 'carts.money', 'books.title_book', 'books.image', 'carts.id', 'carts.book_id')
                ->join('books', 'books.id', '=', 'carts.book_id')
                ->where('carts.user_id', '=',  Auth::user()->id)
                ->get();
        }
        return view('client.books.detail', compact('book', 'books', 'books2', 'cates', 'carts', 'comment', 'users'));
    }
}

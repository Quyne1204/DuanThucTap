<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->paginate();
        if ($key = request()->keyword) {
            $books = Book::orderBy('created_at', 'DESC')->where('title_book', 'like', '%' . $key . '%')->paginate();
        }
        return view('dashboard.products.list', compact("books"));
    }
    public function create()
    {
        $cates = Category::all();
        return view('dashboard.products.create', compact('cates'));
    }
    public function createPost(StoreBookRequest $request)
    {
        $title_book = $request->input('title_book');
        $price = $request->input('price');
        $description = $request->input('description');
        $quantity = $request->input('quantity');
        $author = $request->input('author');
        $id_cate = $request->input('id_cate');

        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images', $image);

        $book = new Book;
        $book->title_book = $title_book;
        $book->price = $price;
        $book->description = $description;
        $book->quantity = $quantity;
        $book->author = $author;
        $book->id_cate = $id_cate;
        $book->image = $image;

        $book->save();
        if ($book->save()) {
            return redirect()->route('book.list');
        }
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $cate = Category::findOrFail($book->id_cate);
        return view('dashboard.products.show',  compact('book', 'cate'));
    }
    public function edit($id)
    {
        $cates = Category::all();
        $book = Book::findOrFail($id);
        return view('dashboard.products.edit',  compact('book', 'cates'));
    }
    public function editPost(StoreBookRequest $request, $id)
    {
        $title_book = $request->input('title_book');
        $price = $request->input('price');
        $description = $request->input('description');
        $quantity = $request->input('quantity');
        $author = $request->input('author');
        $id_cate = $request->input('id_cate');


        $book = Book::find($id);
        if ($request->file('image') != null) {
            $image = $request->file('image')->getClientOriginalName(); // lấy tên file
            $path = $request->file('image')->storeAs('public/images', $image); // lưu file vào đường dẫn
            $book->fill([
                'title_book' => $title_book,
                'quantity' => $quantity,
                'price' => $price,
                'description' => $description,
                'image' => $image,
                'author' => $author,
                'id_cate' => $id_cate
            ])->save();
        } else {
            $book->fill([
                'title_book' => $title_book,
                'quantity' => $quantity,
                'price' => $price,
                'description' => $description,
                'author' => $author,
                'id_cate' => $id_cate
            ])->save();
        }
        if ($book->save()) {
            Session::flash('success', 'Them thành công');
            return redirect()->route('book.list');
        }
    }
    public function delete($id)
    {
        Book::find($id)->delete();
        return redirect()->route('book.list')
            ->with('success', 'Book Delete successfully');
    }
}

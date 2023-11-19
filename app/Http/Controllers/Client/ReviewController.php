<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function postReview(Request $request,)
    {

        if ($request->isMethod('post')) {
            $comment = new Review();
            $comment->content = $request->content;
            $comment->id_customer = Auth::id();
            $comment->id_book = $request->id_book;
            $comment->save();
        }
        return redirect()->back();
    }
}

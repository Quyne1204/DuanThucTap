<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $cates = Category::orderBy('created_at', 'DESC')->paginate();
        if ($key = request()->keyword) {
            $cates = Category::orderBy('created_at', 'DESC')->where('cate_Name', 'like', '%' . $key . '%')->paginate();
        }
        return view('dashboard.category.list', compact("cates"));
    }
    public function create()
    {
        return view('dashboard.category.create');
    }
    public function createPost(StoreCategoryRequest $request)
    {
        $cate_Name = $request->input('cate_Name');
        $category = new Category;
        $category->cate_Name = $cate_Name;
        // $category->slug = $slug;
        $category->save();
        if ($category->save()) {
            Session::flash('success', 'Them thành công');
            return redirect()->route('cate.list');
        }
    }
    public function edit($id)
    {
        $cate = Category::findOrFail($id);
        return view('dashboard.category.edit',  compact('cate'));
    }
    public function editPost(UpdateCategoryRequest $request, $id)
    {
        $cate = Category::find($id);
        if ($request->isMethod('POST')) {
            $cate->cate_Name = $request->cate_Name;
            $cate->update();
            return redirect()->route('cate.list')
                ->with('success', 'cate update successfully');
        }
    }
    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->route('cate.list')
            ->with('success', 'Catgory Delete successfully');
    }
}

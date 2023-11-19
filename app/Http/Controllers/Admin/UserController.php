<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.users.list', compact("users"));
    }
    public function create()
    {
        return view('dashboard.users.create');
    }
    public function createPost(CreateUserRequest $request)
    {
        $user['name'] = $request->name;
        $user['username'] = $request->username;
        $user['email'] = $request->email;
        $user['password'] = Hash::make($request->password);
        $user['phone'] = $request->phone;
        $user['address'] = $request->address;

        if (Auth::check() && Auth::user()->role == 1) {
            $user['role'] = $request->role;
        }

        $data = User::create($user);
        if ($data) {
            return redirect(route('user.list'));
        };
        return redirect(route('user.create'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.edit',  compact('user'));
    }
    public function editPost(EditUserRequest $request, $id)
    {
        $user = User::find($id);
        if ($request->isMethod('POST')) {
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            if (Auth::check() && Auth::user()->role === 1) {
                $user->role = $request->role;
            }
            $user->update();
            return redirect()->route('user.list')
                ->with('success', 'User update successfully');
        }
    }
    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.list')
            ->with('success', 'User Delete successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
session_start();
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function all_user()
    {
        $all_user = User::orderBy('user_id', 'DESC')->get();
        return view('Admin.User.all-user')->with('all_user', $all_user);
    }

    public function add_user()
    {
        return view('Admin.User.add-user');
    }

    public function save_user(Request $request)
    {
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'pass' => $request->pass,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ];

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/backend/assets/img/user'), $imageName);
            $data['avatar'] = $imageName;
        }elseif ($request->filled('avatar_url')) {
            $data['avatar'] = $request->avatar_url;
        }
        User::create($data);

        return redirect('Admin/all-user')->with('message', 'Thêm người dùng thành công');
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.User.edit-user')->with('user', $user);
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ];

        if (!empty($request->pass)) {
            $data['pass'] = $request->pass;
        }

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/backend/assets/img/user'), $imageName);
            $data['avatar'] = $imageName;
        }elseif ($request->filled('avatar_url')) {
            $data['avatar'] = $request->avatar_url;
        }

        $user->update($data);

        return redirect('Admin/all-user')->with('message', 'Cập nhật người dùng thành công');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('Admin/all-user')->with('message', 'Xóa người dùng thành công');
    }
}

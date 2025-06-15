<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy người dùng'
            ]);
        }

        // Cập nhật thông tin
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $pass = $request->pass;

        $user = User::where('email', $email)
                    ->where('pass', $pass) // CHÚ Ý: không nên dùng pass dạng này trong thực tế!
                    ->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'thanh cong',
                'result' => [$user]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'khong thanh cong',
                'result' => []
            ]);
        }
    }

    public function register(Request $request)
    {
        $email = $request->email;

        // Kiểm tra email đã tồn tại
        if (User::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Email đã tồn tại'
            ]);
        }

        // Tạo user mới
        $user = User::create([
            'email' => $email,
            'pass' => $request->pass,
            'username' => $request->username,
            'phone' => $request->phone,
            'uid' => $request->uid,
            'role' => $request->role ?? 0
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Thành công'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không thành công'
            ]);
        }
    }

    public function updateToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        $updated = DB::table('user')
                    ->where('user_id', $request->user_id)
                    ->update(['token' => $request->token]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'thanh cong'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'khong thanh cong'
            ]);
        }
    }

}

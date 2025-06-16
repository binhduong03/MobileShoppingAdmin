<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function sendResetMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = DB::table('user')->where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Mail không chính xác',
                'result' => []
            ]);
        }

        $email = $user->email;
        $pass = $user->pass; 

        $link = "<a href='http://192.168.1.7:81/MobileShopping/reset-password-form?key={$email}&reset={$pass}'>Nhấn để đặt lại mật khẩu</a>";


        try {
            
            Mail::send([], [], function ($message) use ($email, $link) {
                $message->to($email)
                    ->subject('Reset Password')
                    ->html($link);
            });

            return response()->json([
                'success' => true,
                'message' => 'Vui lòng kiểm tra mail của bạn',
                'result' => [$user]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gửi mail không thành công',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function showResetForm(Request $request)
    {
        $email = $request->query('key');
        $pass = $request->query('reset');

        $user = DB::table('user')->where('email', $email)->where('pass', $pass)->first();

        if ($user) {
            return view('Pages.Auth.reset-password-form', ['email' => $email]);
        }

        return "Link không hợp lệ hoặc đã hết hạn!";
    }

    public function submitNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pass' => 'required|min:6',
        ]);

        $updated = DB::table('user')->where('email', $request->email)->update([
            'pass' => $request->pass 
        ]);

        if ($updated) {
            return "Cập nhật mật khẩu thành công!";
        }

        return "Cập nhật thất bại!";
    }

}

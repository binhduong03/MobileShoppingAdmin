<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'message' => 'required|string',
            'is_read' => 'required|boolean',
        ]);

        try {
            Contact::create([
                'user_id' => $request->user_id,
                'message' => $request->message,
                'is_read' => $request->is_read,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Gửi liên hệ thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage(),
            ]);
        }
    }
}

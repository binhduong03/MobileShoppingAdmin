<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu()
    {
        $menus = Menu::all();

        if ($menus->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'thanh cong',
                'result' => $menus
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'khong thanh cong',
                'result' => []
            ]);
        }
    }
}

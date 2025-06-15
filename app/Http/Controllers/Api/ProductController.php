<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $products = Product::orderBy('product_id', 'desc')->get();

        if ($products->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'thanh cong',
                'result' => $products
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'khong thanh cong',
                'result' => []
            ]);
        }
    }

    public function getByType(Request $request)
    {
        $page = $request->input('page', 1);
        $type = $request->input('type', 0);
        $total = 5;

        $products = Product::where('type', $type)
                    ->orderBy('product_id', 'desc')
                    ->skip(($page - 1) * $total)
                    ->take($total)
                    ->get();

        if ($products->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'thanh cong',
                'result' => $products
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'khong thanh cong',
                'result' => []
            ]);
        }
    }


    public function search(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            return response()->json([
                'success' => false,
                'message' => 'Không thành công',
                'result' => []
            ]);
        }

        $products = Product::where('name', 'LIKE', '%' . $search . '%')->get();

        if ($products->count() > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Thành công',
                'result' => $products
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không thành công',
                'result' => []
            ]);
        }
    }
}

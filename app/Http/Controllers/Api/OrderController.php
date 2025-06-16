<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. Thêm đơn hàng
            $order = Order::create([
                'user_id' => $request->user_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'quantity' => $request->quantity,
                'total_amount' => $request->total_amount,
                'status' => 0 //0:Chờ duyệt; 1:Đang vận chuyển; 2: Đang giao hàng; 3: Đã giao; 4:Đã huỷ
            ]);

            // 2. Duyệt chi tiết đơn hàng (JSON dạng mảng)
            $details = json_decode($request->chitiet, true);

            foreach ($details as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thêm đơn hàng và chi tiết thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    public function getOrdersByUser(Request $request)
    {
        $userId = $request->input('user_id');

        $orders = Order::with(['details.product'])
            ->where('user_id', $userId)
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'khong thanh cong',
                'result' => []
            ]);
        }

        
        $result = $orders->map(function ($order) {
            $item = $order->details->map(function ($detail) {
                $product = $detail->product;
                return [
                    'order_id' => $detail->order_id,
                    'product_id' => $detail->product_id,
                    'quantity' => $detail->quantity,
                    
                    'name' => $product->name ?? null,
                    'image' => $product->image ?? null,
                    'price' => $product->price ?? null
                ];
            });

            return [
                'order_id' => $order->order_id,
                'user_id' => $order->user_id,
                'address' => $order->address,
                'phone' => $order->phone,
                'total_amount' => $order->total_amount,
                'status' => $order->status,
                'item' => $item
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'thanh cong',
            'result' => $result
        ]);
    }

    public function cancelOrder(Request $request)
    {
        $orderId = $request->input('order_id');
        $status = $request->input('status');

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ]);
        }

        // Cập nhật trạng thái về huỷ đơn hoặc chờ duyệt 
        $order->status = $status;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Huỷ đơn hàng thành công'
        ]);
    }

}


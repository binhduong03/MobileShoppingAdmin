<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Session;
session_start();
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function all_order()
    {
        $all_order = Order::with('user')->orderBy('order_id', 'desc')->get();
        return view('Admin.Order.all-order', compact('all_order'));
    }

    public function detail_order($id)
    {
        // Lấy đơn hàng kèm theo user, details và product
        $order = Order::with(['user', 'details.product'])->findOrFail($id);

        // Lấy danh sách chi tiết đơn hàng riêng ra cho dễ dùng trong view
        $orderDetails = $order->details;

        // Truyền nhiều biến ra view
        return view('Admin.Order.detail-order', compact('order', 'orderDetails'));
    }


    public function delete_order($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return redirect()->back()->with('success', 'Xóa đơn hàng thành công.');
        }
        return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
    }

    public function update_status(Request $request)
    {
        $order = Order::find($request->order_id);
        $orderstatus = $order->status;
        if ($order) {
            if ($orderstatus == 4 || $orderstatus == 3) {
                 return redirect()->back()->with('error', 'Không thể đổi trạng thái khi đơn hàng bị huỷ hoặc giao xong.');
            }   
            if(($orderstatus == 1 || $orderstatus == 2) && $request->status == 0){
                return redirect()->back()->with('error', 'Không thể cập nhật đơn hàng đang trong quá trình vận chuyển về chờ xử lý.');
                
            }
            
            if ($orderstatus == 2 && $request->status == 1) {
                 return redirect()->back()->with('error', 'Không thể cập nhật đơn hàng đang giao về đang vận chuyển.');
            }
            
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
            
        }
        return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
    }
}

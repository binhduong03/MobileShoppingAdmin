<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
session_start();
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function all_product() {
        $all_product = Product::orderBy('product_id', 'desc')->get();
        return view('Admin.Product.all-product')->with('all_product', $all_product);
    }

    public function add_product() {
        return view('Admin.Product.add-product');
    }

    public function save_product(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'type' => 'required|integer',
            'is_active' => 'required|integer'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/backend/assets/img/product'), $imageName);
            $data['image'] = $imageName;
        } elseif ($request->filled('image')) {
            $data['image'] = $request->image; 
        }

        Product::create($data);
        return Redirect::to('Admin/all-product')->with('message', 'Thêm sản phẩm thành công');
    }

    public function edit_product($id) {
        $product = Product::findOrFail($id);
        return view('Admin.Product.edit-product')->with('product', $product);
    }

    public function update_product(Request $request, $id) {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'type' => 'required|integer',
            'is_active' => 'required|integer'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/backend/assets/img/product'), $imageName);
            $data['image'] = $imageName;
        } elseif ($request->filled('image')) {
            $data['image'] = $request->image; 
        } else {
            // Nếu không gửi ảnh mới -> giữ nguyên ảnh cũ
            $data['image'] = $product->image;
        }

        $product->update($data);
        return Redirect::to('Admin/all-product')->with('message', 'Cập nhật sản phẩm thành công');
    }


    public function delete_product($id) {
        Product::destroy($id);
        return Redirect::to('Admin/all-product')->with('message', 'Xóa sản phẩm thành công');
    }
}

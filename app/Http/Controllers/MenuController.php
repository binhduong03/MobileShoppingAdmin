<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
session_start();
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class MenuController extends Controller
{
    public function all_menu()
    {
        $all_menu = Menu::orderBy('menu_id', 'DESC')->get();
        return view('Admin.Menu.all-menu')->with('all_menu', $all_menu);
    }

    public function add_menu()
    {
        return view('Admin.Menu.add-menu');
    }

    public function save_menu(Request $request)
    {
        
        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];

       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/backend/assets/img/menu'), $imageName);
            $data['image'] = $imageName;
        } elseif ($request->filled('image')) {
            $data['image'] = $request->image; 
        }

        Menu::create($data);

        return redirect('Admin/all-menu')->with('message', 'Thêm menu thành công');
    }




    public function edit_menu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('Admin.Menu.edit-menu')->with('menu', $menu);
    }

    public function update_menu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = [];
        $data['name'] = $request->name;
        $data['status'] = $request->status;

        
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('/backend/assets/img/menu'), $imageName);
            $data['image'] = $imageName;
        }
        elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        $menu->update($data);

        return redirect('Admin/all-menu')->with('message', 'Cập nhật menu thành công');
    }



    public function delete_menu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect('Admin/all-menu')->with('message', 'Xóa thành công');
    }
}

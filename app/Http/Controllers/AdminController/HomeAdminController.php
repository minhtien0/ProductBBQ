<?php

namespace App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class HomeAdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }
    
public function deskmanage() 
{
    $tables = DB::table('tables')->get();
    $menus = Menu::all(); // Nếu menu dùng chung, còn nếu mỗi bàn riêng thì lấy bằng API khi click
    return view('deskmanage', compact('tables', 'menus'));
}

public function getTableData($id)
{
    $table = DB::table('tables')->where('id', $id)->first();
    if (!$table || $table->status == 'Đã Đóng') {
        return response()->json([
            'error' => true,
            'message' => 'Bàn chưa được mở, vui lòng đợi nhân viên mở bàn.'
        ], 403);
    }

    // Lấy menus, mỗi menu có danh sách món ăn riêng
    $menus = \App\Models\Menu::with(['foods'])->get();

    // Combo như cũ
    $comboIds = DB::table('order_combos')
        ->join('orders', 'order_combos.order_id', '=', 'orders.id')
        ->where('orders.table_id', $id)
        ->select('order_combos.combo_id')
        ->distinct()
        ->pluck('combo_id');

        $order = \App\Models\Order::where('table_id', $id)
        ->orderByDesc('id')
        ->first();

     if (!$order) {
        return response()->json([
            'error' => false,
            'menus' => $menus,
            'combos' => [],
            'items' => [],
        ]);
    }

    $items = \App\Models\OrderDetail::with('food')
        ->where('order_id', $order->id)
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'product_name' => $item->food->name ?? '',
                'quantity' => $item->quantity,
                'price' => $item->food->price ?? 0,
                'image' => $item->food->image ?? 'default-food.jpg',
                'status' => $item->status,
            ];
        });

    $comboData = [];
    if ($comboIds->isNotEmpty()) {
        $results = DB::table('food_combos')
            ->leftJoin('detail_combos', 'food_combos.id', '=', 'detail_combos.combo_id')
            ->leftJoin('foods', 'detail_combos.food_id', '=', 'foods.id')
            ->whereIn('food_combos.id', $comboIds)
            ->select(
                'food_combos.id',
                'food_combos.name',
                'foods.id as food_id',
                'foods.name as food_name',
                'foods.price as food_price',
                'foods.image as food_image'
            )
            ->get();

        $comboData = $results->groupBy('id')->map(function ($group) {
            $comboName = $group->first()->name;
            $foodNames = $group->pluck('food_name')->filter()->unique()->values()->toArray();
            $foodIds = $group->pluck('food_id')->filter()->unique()->values()->toArray();
            $foodPrices = $group->pluck('food_price')->filter()->unique()->values()->toArray();
            $foodImages = $group->pluck('food_image')->filter()->unique()->values()->toArray();

            return [
                'id' => $group->first()->id,
                'name' => $comboName,
                'foods' => array_map(function ($name, $id, $price, $image) {
                    return [
                        'id' => $id,
                        'name' => $name,
                        'price' => $price,
                        'image' => $image ?: 'img/default-food.jpg'
                    ];
                }, $foodNames, $foodIds, $foodPrices, $foodImages)
            ];
        })->values()->all();
    }


    return response()->json([
        'error' => false,
        'menus' => $menus,
        'combos' => $comboData,
        'items' => $items,
    ]);
}

//Mở bàn
public function openTable($id)
{
    $table = DB::table('tables')->where('id', $id)->first();
    if (!$table) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy bàn!']);
    }
    DB::table('tables')->where('id', $id)->update(['status' => 'Đã Mở']);
    return response()->json(['success' => true]);
}




}

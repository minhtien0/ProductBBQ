<?php

namespace App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\FoodCombo;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeAdminController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $totalRevenue = DB::table('orders')
            ->whereYear('created_at', $year)
            ->sum('totalbill');
        $totalUser = User::count();
        $totalOrder = Order::count();
        $totalStaff = Staff::count();

        $monthlyRevenue = [];
        $newCustomers = [];
        $labels = [];

        for ($i = 1; $i <= 12; $i++) {
            // Doanh thu theo tháng (đơn vị: triệu đồng)
            $revenue = DB::table('orders')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->sum('totalbill');

            $monthlyRevenue[] = round($revenue / 1000000, 2);

            // Khách hàng mới theo tháng
            $count = DB::table('users') // thay 'users' nếu bạn dùng bảng khác
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->count();

            $newCustomers[] = $count;

            // Thêm nhãn tháng một lần
            $labels[] = "T$i";
        }

        //Thống kê đánh giá
        $ratingsDistribution = [];

        for ($i = 1; $i <= 5; $i++) {
            $count = DB::table('rates')
                ->where('rate', $i)
                ->count();

            $ratingsDistribution[] = $count;
        }

        $listTopDeal = OrderDetail::select(
            'product_id',
            'foods.name as food_name',
            'foods.price as food_price',
            'foods.image as food_image',
            DB::raw('SUM(quantity * foods.price) as total_revenue'),
            DB::raw('SUM(quantity) as total_quantity')
        )
            ->join('foods', 'order_details.product_id', '=', 'foods.id')
            ->groupBy('product_id', 'foods.name', 'foods.price', 'foods.image')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        $productLabels = [];
        $productRevenue = [];

        foreach ($listTopDeal as $deal) {
            $productLabels[] = $deal->food_name;
            $productRevenue[] = round($deal->total_revenue / 1000000, 2); // triệu đồng
        }

        $topEmployees = DB::table('orders')
            ->join('staffs', 'orders.id_staff', '=', 'staffs.id')
            ->select('id_staff', 'staffs.fullname', DB::raw('SUM(orders.totalbill) as total_revenue'))
            ->whereNotNull('orders.id_staff')
            ->groupBy('id_staff', 'staffs.fullname')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        // Tách dữ liệu cho biểu đồ
        $employeeLabels = [];
        $employeeRevenues = [];

        foreach ($topEmployees as $emp) {
            $employeeLabels[] = $emp->fullname;
            $employeeRevenues[] = round($emp->total_revenue / 1000000, 2); // Triệu đồng
        }

        return view(
            'admin.dashboard',
            compact(
                'totalRevenue',
                'totalUser',
                'totalOrder',
                'totalStaff',
                'labels',
                'monthlyRevenue',
                'newCustomers',
                'labels',
                'ratingsDistribution',
                'productLabels',
                'productRevenue',
                'employeeLabels',
                'employeeRevenues',
            )
        );
    }

    //Tìm doanh thu hàng tháng theo năm
    public function getMonthlyRevenueByYear(Request $request)
    {
        $year = $request->input('year', now()->year);

        $monthlyRevenue = [];
        $labels = [];

        for ($i = 1; $i <= 12; $i++) {
            $revenue = DB::table('orders')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->sum('totalbill');

            $monthlyRevenue[] = round($revenue / 1000000, 2); // triệu
            $labels[] = "T$i";
        }

        return response()->json([
            'labels' => $labels,
            'data' => $monthlyRevenue
        ]);
    }

    //Tìm kiếm nhân viên theo tháng
    public function getTopEmployeesByMonth(Request $request)
    {
        $month = $request->input('month');
        $year = 2025;

        $topEmployees = DB::table('orders')
            ->join('staffs', 'orders.id_staff', '=', 'staffs.id')
            ->select('staffs.fullname', DB::raw('SUM(orders.totalbill) as total_revenue'))
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->whereNotNull('orders.id_staff')
            ->groupBy('staffs.fullname')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        $labels = $topEmployees->pluck('fullname');
        $data = $topEmployees->pluck('total_revenue')->map(function ($val) {
            return round($val / 1000000, 2); // Triệu
        });

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    //Tìm nhân viên mới theo năm
    public function getNewCustomersByYear(Request $request)
    {
        $year = $request->input('year', now()->year);

        $monthlyCustomers = [];
        $labels = [];

        for ($i = 1; $i <= 12; $i++) {
            $count = DB::table('users')  // hoặc 'nguoidung' nếu đúng tên bảng
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->count();

            $monthlyCustomers[] = $count;
            $labels[] = "T$i";
        }

        return response()->json([
            'labels' => $labels,
            'data' => $monthlyCustomers
        ]);
    }

    //Tìm đánh giá theo tháng 
    public function getRatingsByMonth(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year); // optional nếu muốn hỗ trợ theo năm

        // Đếm số lượng đánh giá từ 1 đến 5 sao
        $ratings = DB::table('rates')
            ->select('rate', DB::raw('COUNT(*) as total'))
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('rate')
            ->pluck('total', 'rate')->toArray();

        // Đảm bảo đủ từ 1 đến 5 sao (nếu thiếu gán 0)
        $result = [];
        for ($i = 1; $i <= 5; $i++) {
            $result[] = $ratings[$i] ?? 0;
        }

        return response()->json([
            'data' => $result
        ]);
    }

    //Tìm kiếm món ăn doanh thu theo tháng
    public function getTopProductsByMonth(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year); // nếu muốn thêm lọc năm sau này

        $topProducts = DB::table('order_details')
            ->join('foods', 'order_details.product_id', '=', 'foods.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->select(
                'foods.name as product_name',
                DB::raw('SUM(order_details.quantity * foods.price) as total_revenue')
            )
            ->groupBy('foods.name')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->get();

        $labels = $topProducts->pluck('product_name');
        $data = $topProducts->pluck('total_revenue')->map(fn($val) => round($val / 1000000, 2)); // triệu đồng

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
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
                'message' => 'Bàn chưa được mở, vui lòng đợi nhân viên mở bàn.',
                'menus' => null,
                'combos' => null,
                'items' => null,
                'ma_hoa_don' => null,
            ]);
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

        $orderId = DB::table('orders') // hoặc DonHang::where(...)
            ->where('table_id', $id)
            ->where('status', '!=', 'Đã Đóng') // giả sử
            ->orderBy('id', 'desc')
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
            ->map(function ($item) {
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


        //dd($order->code);
        return response()->json([
            'error' => false,
            'menus' => $menus,
            'combos' => $comboData,
            'items' => $items,
            'ma_hoa_don' => $order->code ?? null,
        ]);
    }

    //Mở bàn
    public function openTable($id)
    {
        $table = DB::table('tables')->where('id', $id)->first();
        if (!$table) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy bàn!']);
        }


        DB::table('tables')->where('id', $id)->update(['status' => 'Đang Mở']);
        $codeOrder = 'NMT' . strtoupper(Str::random(8));

        Order::create([
            'code' => $codeOrder,
            'table_id' => $table->id,
            'id_user' => null,
            'address' => null,
            'id_staff' => session('staff_id'),
            'totalprice' => null,
            'voucher' => null,
            'totalbill' => null,
            'statusorder' => 'Đang Mở',
            'typepayment' => null,
            'note' => null,
            'type' => 0,
        ]);
        return response()->json(['success' => true]);
    }

public function addComboToOrder(Request $request)
{
    $tableId = $request->table_id;
    $comboId = $request->combo_id;

    // Tìm đơn hàng đang mở của bàn
    $order = \App\Models\Order::where('table_id', $tableId)
        ->whereNotIn('statusorder', ['Đã Đóng', 'Hủy']) // thêm điều kiện chặt chẽ hơn nếu cần
        ->latest()
        ->first();

    // Nếu không tìm thấy đơn hàng mở
    if (!$order) {
        return response()->json([
            'success' => false,
            'message' => 'Bàn hiện không có hóa đơn đang mở.'
        ], 404);
    }

    try {
        // Tạo liên kết combo với order
        DB::table('order_combos')->insert([
            'order_id' => $order->id,
            'combo_id' => $comboId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Thêm combo vào đơn hàng thành công.']);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra khi thêm combo vào đơn hàng.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    public function getAllCombos()
    {
        $combos = FoodCombo::with('foods')->get();
        return response()->json([
            'success' => true,
            'combos' => $combos
        ]);
    }


    public function addOrderItem(Request $request)
    {
        $request->validate([
            'table_id' => 'required|integer|exists:tables,id',
            'product_id' => 'required|integer|exists:foods,id',
        ]);

        // Tìm order đang mở của bàn này (trạng thái chưa thanh toán)
        $order = \App\Models\Order::where('table_id', $request->table_id)
            ->where('statusorder', '=', 'Đang Mở') // hoặc 'Đang phục vụ'
            ->orderByDesc('id')->first();
        if (!$order) {
            // Có thể trả về lỗi hoặc tự tạo order mới tuỳ bạn
            return response()->json([
                'success' => false,
                'message' => 'Chưa có order đang mở cho bàn này!'
            ], 400);
        }

        // Kiểm tra món đã tồn tại trong order chưa
        $detail = \App\Models\OrderDetail::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($detail) {
            // Nếu có rồi thì cộng quantity lên 1
            $detail->quantity += 1;
            $detail->save();
        } else {
            // Nếu chưa thì tạo mới
            $detail = \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id,
                'quantity' => 1,
                'status',
                'Chờ Thực Hiện',
                'time' => now()
            ]);
        }
        \Log::info($order);
        return response()->json([
            'success' => true,
            'message' => 'Thêm món thành công!'
        ]);
    }

    // DeskManageController.php

    public function updateOrderItem(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|integer|exists:order_details,id', // id của bảng order_details
            'delta' => 'required|integer', // +1 hoặc -1
        ]);
        $detail = \App\Models\OrderDetail::find($request->order_item_id);
        $detail->quantity += $request->delta;
        if ($detail->quantity < 1)
            $detail->quantity = 1;
        $detail->save();
        return response()->json(['success' => true, 'message' => 'Đã cập nhật số lượng', 'quantity' => $detail->quantity]);
    }

    public function deleteOrderItem(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|integer|exists:order_details,id',
        ]);
        $detail = \App\Models\OrderDetail::find($request->order_item_id);
        $detail->delete();
        return response()->json(['success' => true, 'message' => 'Đã xóa món!']);
    }






}

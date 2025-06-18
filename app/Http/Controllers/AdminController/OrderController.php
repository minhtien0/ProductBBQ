<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AdminController\DB;


class OrderController extends Controller
{
    //
    public function index()
    {

        return view('admin.order.index');
    }

    public function bringBack(Request $request)
    {

        $statusorder = $request->query('statusorder');


        // Các trạng thái hiển thị
        $statuses = ['Chờ Xác Nhận', 'Đang Thực Hiện', 'Đang Giao Hàng', 'Hoàn Thành'];
        $counts = [];
        foreach ($statuses as $st) {
            $counts[$st] = Order::where('statusorder', $st)->where('type', 1)->count();
        }
        $counts['all'] = Order::where('type', 1)->count();


        // Xây dựng query với join
        $query = Order::leftJoin('users', 'orders.id_user', '=', 'users.id')
            ->leftJoin('vouchers', 'orders.voucher', '=', 'vouchers.id')
            ->select([
                'orders.*',
                'users.fullname as customer_name',
                'users.email    as customer_email',
                'vouchers.code  as voucher_code',
                'vouchers.value as voucher_value',
            ])
            ->where('orders.type', 1); // 1 = Mang Về

        // Chỉ apply filter khi statusorder nằm trong danh sách
        if ($statusorder && in_array($statusorder, $statuses)) {
            $query->where('orders.statusorder', $statusorder);
        }

        $orders = $query
            ->orderBy('orders.created_at', 'desc')
            ->paginate(20)
            ->appends(['statusorder' => $statusorder]); // giữ statusorder khi phân trang

        return view('admin.order.bringback', compact('orders', 'statuses', 'statusorder', 'counts'));
    }

    public function showOrder($id)
    {
        // Lấy thông tin đơn và join khách hàng, voucher
        $order = Order::leftJoin('users', 'orders.id_user', '=', 'users.id')
            ->leftJoin('vouchers', 'orders.voucher', '=', 'vouchers.id')
            ->join('addresses', 'orders.address', '=', 'addresses.id')
            ->select([
                'orders.*',
                'orders.id as id_order',
                'users.fullname as customer_name',
                'users.email as customer_email',
                'vouchers.code as voucher_code',
                'vouchers.value as voucher_value',
                'addresses.note as note_address',
                'addresses.*',
            ])
            ->where('orders.id', $id)
            ->firstOrFail();

        // Lấy chi tiết sản phẩm
        $details = OrderDetail::join('foods', 'order_details.product_id', '=', 'foods.id')
            ->where('order_details.order_id', $id)
            ->select([
                'order_details.*',
                'foods.name as food_name',
                'foods.price as food_price',
            ])
            ->get();

        return view('admin.order.show', compact('order', 'details'));
    }

    public function updateStatusBringBack(Request $request, $id)
    {
        $request->validate([
            'statusorder' => 'required|in:Chờ Xác Nhận,Đang Thực Hiện,Đang Giao Hàng,Hoàn Thành',
        ]);

        $order = Order::findOrFail($id);
        $order->statusorder = $request->statusorder;
        $order->save();

        return back()->with('success','Cập nhật trạng thái thành công!');
    }

    //Controller Xử Lí Tại Quán
    public function onSite()
    {
        return view('admin.order.onsite');
    }


}

<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Company;
use App\Models\Order;
use App\Models\Food;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AdminController\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Str;


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
        $keyword = $request->query('keyword');
        $date_from = $request->query('date_from');
        $date_to = $request->query('date_to');

        $statuses = ['Chờ Xác Nhận', 'Đang Thực Hiện', 'Đang Giao Hàng', 'Hoàn Thành', 'Đã Hủy', 'Hoàn Tiền'];
        $counts = [];
        foreach ($statuses as $st) {
            $counts[$st] = Order::where('statusorder', $st)->where('type', 1)->count();
        }
        $counts['all'] = Order::where('type', 1)->count();

        $query = Order::leftJoin('users', 'orders.id_user', '=', 'users.id')
            ->leftJoin('vouchers', 'orders.voucher', '=', 'vouchers.id')
            ->select([
                'orders.*',
                'users.fullname as customer_name',
                'users.email    as customer_email',
                'vouchers.code  as voucher_code',
                'vouchers.value as voucher_value',
            ])
            ->where('orders.type', 1);

        if ($statusorder && in_array($statusorder, $statuses)) {
            $query->where('orders.statusorder', $statusorder);
        }
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('orders.code', 'like', "%{$keyword}%")
                    ->orWhere('users.fullname', 'like', "%{$keyword}%");
            });
        }
        if ($date_from) {
            $query->whereDate('orders.created_at', '>=', $date_from);
        }
        if ($date_to) {
            $query->whereDate('orders.created_at', '<=', $date_to);
        }

        $orders = $query->orderBy('orders.created_at', 'desc')
            ->paginate(5)
            ->appends([
                'statusorder' => $statusorder,
                'keyword' => $keyword,
                'date_from' => $date_from,
                'date_to' => $date_to,
            ]);

        if ($request->ajax()) {
            $sections = view('admin.order.bringback', compact('orders', 'statuses', 'statusorder', 'counts'))
                ->renderSections();
            return $sections['content_order'];
        }

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
                'orders.note as note_order',
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
        $details = OrderDetail::leftJoin('foods', 'order_details.product_id', '=', 'foods.id')
            ->leftJoin('food_combos', 'order_details.combo_id', '=', 'food_combos.id')
            ->where('order_details.order_id', $id)
            ->select([
                'order_details.*',
                'foods.name as food_name',
                'foods.price as food_price',
                'food_combos.name as combo_name',
                'food_combos.price as combo_price',
            ])
            ->get();


        return view('admin.order.show', compact('order', 'details'));
    }

    public function updateStatusBringBack(Request $request, $id)
    {
        $request->validate([
            'statusorder' => 'required|in:Chờ Xác Nhận,Đang Thực Hiện,Đang Giao Hàng,Hoàn Thành,Đã Hủy',
        ]);

        $order = Order::findOrFail($id);

        // Định nghĩa thứ tự trạng thái
        $statusOrder = [
            'Chờ Xác Nhận' => 1,
            'Đang Thực Hiện' => 2,
            'Đang Giao Hàng' => 3,
            'Hoàn Thành' => 4,
            'Đã Hủy' => 5,
        ];

        $currentStatus = $order->statusorder;
        $newStatus = $request->statusorder;

        // Nếu trạng thái mới <= trạng thái hiện tại thì không cho phép cập nhật
        if ($statusOrder[$newStatus] <= $statusOrder[$currentStatus]) {
            return back()->with('error', 'Không thể chuyển về trạng thái trước hoặc trạng thái hiện tại!');
        }

        // Nếu chuyển sang "Đang Thực Hiện" thì trừ số lượng sản phẩm
        if ($newStatus == 'Đang Thực Hiện' && $order->statusorder != 'Đang Thực Hiện') {
            foreach ($order->details as $item) {
                $product = Food::find($item->product_id);
                if ($product->quantity < $item->quantity) {
                    return back()->with('error', 'Sản phẩm ' . $product->name . ' không đủ hàng!');
                }
                $product->quantity -= $item->quantity;
                if ($product->quantity == 0) {
                    $product->status = 'Hết Hàng'; // hoặc $product->is_active = 0;
                }
                $product->save();
            }
        }

        $order->statusorder = $newStatus;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }


    public function queryTransaction(string $txnRef, Request $request)
    {
        $url = env('VNPAY_API_URL');
        $tmn = env('VNPAY_TMN_CODE');
        $secret = env('VNPAY_HASH_SECRET');

        $order = Order::where('code', $txnRef)->firstOrFail();
        $transactionNo = $order->transaction_no;
        $transactionDate = $order->transaction_date;

        // Đảm bảo transactionDate 14 ký tự
        if (strlen($transactionDate) != 14) {
            $transactionDate = Carbon::parse($transactionDate)->format('YmdHis');
        }

        $data = [
            'vnp_Version' => '2.1.0',
            'vnp_Command' => 'querydr',
            'vnp_TmnCode' => $tmn,
            'vnp_TxnRef' => $txnRef,
            'vnp_RequestId' => Str::upper(Str::random(16)),
            'vnp_OrderInfo' => "Query giao dịch {$txnRef}",
            'vnp_TransactionNo' => $transactionNo,
            'vnp_TransactionDate' => $transactionDate,
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_IpAddr' => $request->ip(),
        ];

        // Sinh rawHash
        ksort($data);
        $rawHash = '';
        foreach ($data as $k => $v) {
            $rawHash .= "{$k}={$v}&";
        }
        $rawHash = rtrim($rawHash, '&');

        // Gắn chữ ký
        $data['vnp_SecureHashType'] = 'SHA512';
        $data['vnp_SecureHash'] = hash_hmac('sha512', $rawHash, $secret);

        // Gửi JSON
        $client = new Client();
        $response = $client->post($url, [
            'json' => $data,
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Hoàn tiền (Refund)
     */
    public function refund(Request $request, Order $order)
    {
        $transactionNo = $order->transaction_no;
        $transactionDate = $order->transaction_date;

        if (!$transactionNo || !$transactionDate) {
            return back()->with('error', 'Thiếu thông tin giao dịch gốc để hoàn tiền.');
        }

        // Đảm bảo transactionDate 14 ký tự
        if (strlen($order->transaction_date) != 14) {
            $transactionDate = Carbon::parse($order->transaction_date)
                ->format('YmdHis');
        } else {
            $transactionDate = $order->transaction_date;
        }

        $requestId = date('YmdHis') . Str::upper(Str::random(6));
        $createBy = session('staff_id') ?? 'admin';
        $createDate = date('YmdHis');
        $amount = $order->totalbill * 100;
        $ip = $request->ip();
        $txnRef = $order->code;
        $txnNo = $order->transaction_no;
        $version = '2.1.0';
        $command = 'refund';
        $tmnCode = env('VNPAY_TMN_CODE');
        $txnType = '02';
        $orderInfo = "Hoàn tiền đơn {$txnRef}";
        $secret = env('VNPAY_HASH_SECRET');

        // 2. Build raw data theo spec (thứ tự + dấu '|')
        $rawData = implode('|', [
            $requestId,
            $version,
            $command,
            $tmnCode,
            $txnType,
            $txnRef,
            $amount,
            $txnNo,
            $transactionDate,
            $createBy,
            $createDate,
            $ip,
            $orderInfo,
        ]);

        // 3. Tính chữ ký
        $secureHash = hash_hmac('sha512', $rawData, $secret);

        // 4. Gửi request JSON
        $payload = [
            'vnp_RequestId' => $requestId,
            'vnp_Version' => $version,
            'vnp_Command' => $command,
            'vnp_TmnCode' => $tmnCode,
            'vnp_TransactionType' => $txnType,
            'vnp_TxnRef' => $txnRef,
            'vnp_Amount' => $amount,
            'vnp_TransactionNo' => $txnNo,
            'vnp_TransactionDate' => $transactionDate,
            'vnp_CreateBy' => $createBy,
            'vnp_CreateDate' => $createDate,
            'vnp_IpAddr' => $ip,
            'vnp_OrderInfo' => $orderInfo,
            'vnp_SecureHash' => $secureHash,
        ];

        $client = new Client();
        $response = $client->post(env('VNPAY_API_URL'), [
            'json' => $payload,
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $result = json_decode($response->getBody(), true);

        \Log::info('VNPAY Refund:', [
            'response_code' => $result['vnp_ResponseCode'] ?? null,
            'message' => $result['vnp_Message'] ?? null,
        ]);

        if (($result['vnp_ResponseCode'] ?? '') === '00') {
            $order->update(['statusorder' => 'Hoàn Tiền']);
            return back()->with('success', 'Hoàn tiền thành công!');
        }

        return back()->with('error', 'Hoàn tiền thất bại: ' . ($result['vnp_Message'] ?? 'Unknown'));
    }


    //Controller Xử Lí Tại Quán
    public function onSite()
    {
        return view('admin.order.onsite');
    }


}

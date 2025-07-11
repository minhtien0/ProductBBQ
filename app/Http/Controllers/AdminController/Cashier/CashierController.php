<?php

namespace App\Http\Controllers\AdminController\Cashier;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Food;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\StaffsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StaffsTemplateExport;
use App\Imports\StaffsImport;
use Maatwebsite\Excel\Validators\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class CashierController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $lastMonth = $now->copy()->subMonth();
        $lastMonthNum = $lastMonth->month;
        $lastMonthYear = $lastMonth->year;
        $daysInMonth = $now->daysInMonth;
        $lastMonthDays = $lastMonth->daysInMonth;

        // --- 1. Tổng doanh thu tháng này và tháng trước
        $totalRevenue = DB::table('orders')
            ->where('statusorder', 'Hoàn Thành')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('totalbill');
        //dd($totalRevenue, $year, $month);

        $lastMonthRevenue = DB::table('orders')
            ->where('statusorder', 'Hoàn Thành')
            ->whereMonth('created_at', $lastMonthNum)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('totalbill');
        //dd( $totalRevenue, $lastMonthRevenue);
        $percentChange = $lastMonthRevenue > 0
            ? ($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue * 100
            : 0;

        // --- 2. Số đơn hàng tháng này và tháng trước
        $totalOrders = DB::table('orders')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();

        $lastMonthOrders = DB::table('orders')
            ->whereMonth('created_at', $lastMonthNum)
            ->whereYear('created_at', $lastMonthYear)
            ->count();

        $orderPercentChange = $lastMonthOrders > 0
            ? ($totalOrders - $lastMonthOrders) / $lastMonthOrders * 100
            : 0;

        // --- 3. Giá trị doanh thu trung bình mỗi ngày trong tháng & tháng trước
        $avgRevenuePerDay = $daysInMonth > 0
            ? ($totalRevenue / $daysInMonth)
            : 0;

        $lastAvgRevenuePerDay = $lastMonthDays > 0
            ? ($lastMonthRevenue / $lastMonthDays)
            : 0;

        $avgPercentChange = $lastAvgRevenuePerDay > 0
            ? ($avgRevenuePerDay - $lastAvgRevenuePerDay) / $lastAvgRevenuePerDay * 100
            : 0;

        // --- 4. Tổng số tiền khuyến mãi và tỷ lệ đơn áp dụng khuyến mãi
        // Giả sử cột 'voucher' là số tiền giảm giá đã dùng cho đơn, hoặc là id voucher
        // Nếu là số tiền giảm:
        $totalDiscount = DB::table('orders')
            ->join('vouchers', 'vouchers.id', '=', 'orders.voucher')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->where('voucher', '>', 0)
            ->sum('vouchers.value'); // sửa 'voucher' thành tên cột lưu số tiền giảm
        //dd( $totalDiscount);
        // Nếu 'voucher' là id, cần join với bảng vouchers để sum value giảm giá:
        // $totalDiscount = DB::table('orders')
        //     ->join('vouchers', 'orders.voucher', '=', 'vouchers.id')
        //     ->whereMonth('orders.created_at', $month)
        //     ->whereYear('orders.created_at', $year)
        //     ->sum('vouchers.value'); // thay 'value' là cột tiền giảm ở bảng vouchers

        // Số đơn có áp dụng voucher
        $ordersWithDiscount = DB::table('orders')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('voucher', '>', 0)
            ->count();
        //dd($ordersWithDiscount,$totalOrders);
        $discountOrderPercent = $totalOrders > 0
            ? ($ordersWithDiscount / $totalOrders) * 100
            : 0;

        //Thống kê theo tháng
        $monthlyRevenue = [];

        for ($i = 1; $i <= 12; $i++) {
            $revenue = DB::table('orders')
                ->where('statusorder', 'Hoàn Thành')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->sum('totalbill');
            $monthlyRevenue[] = $revenue;
        }

        // Label tháng dạng 1/2024, 2/2024,...
        $labels = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $i . '/' . $year;
        }

        $atTable = DB::table('orders')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('type', 0)
            ->count();

        $takeAway = DB::table('orders')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('type', 1)
            ->count();

        // Tổng số đơn
        $total = $atTable + $takeAway;
        // Phần trăm
        $atTablePercent = $total > 0 ? round($atTable / $total * 100, 1) : 0;
        $takeAwayPercent = $total > 0 ? round($takeAway / $total * 100, 1) : 0;

        // Lấy top 5 món doanh thu cao nhất
        $listTopDeal = OrderDetail::select(
            'order_details.product_id',
            'foods.name as food_name',
            'foods.price as food_price',
            'foods.image as food_image',
            DB::raw('SUM(order_details.quantity * foods.price) as total_revenue'),
            DB::raw('SUM(order_details.quantity) as total_quantity')
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('foods', 'order_details.product_id', '=', 'foods.id')
            ->where('orders.statusorder', 'Hoàn Thành')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->groupBy('order_details.product_id', 'foods.name', 'foods.price', 'foods.image')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        // 2. Tổng doanh thu của tất cả đơn hoàn thành trong tháng này
        $totalRevenueAll = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('foods', 'order_details.product_id', '=', 'foods.id')
            ->where('orders.statusorder', 'Hoàn Thành')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->sum(DB::raw('order_details.quantity * foods.price'));

        // 3. Tính % và gán badge như cũ
        $totalTopDealRevenue = $listTopDeal->sum('total_revenue');
        $badgeColors = ['warning', 'info', 'secondary', 'light text-dark', 'secondary'];

        foreach ($listTopDeal as $k => $item) {
            $percent = $totalRevenueAll > 0
                ? round($item->total_revenue / $totalRevenueAll * 100, 1)
                : 0;
            $item->percent = $percent;
            $item->badge = $badgeColors[$k] ?? 'secondary';
        }

        $foods = Food::all();

        $upsaleList = [];
        foreach ($foods as $food) {
            // Số lượng bán tháng này
            $soldThisMonth = OrderDetail::where('product_id', $food->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('quantity');

            // Số lượng bán tháng trước
            $soldLastMonth = OrderDetail::where('product_id', $food->id)
                ->whereMonth('created_at', $lastMonthNum)
                ->whereYear('created_at', $lastMonthYear)
                ->sum('quantity');

            // % giảm
            $decreasePercent = $soldLastMonth > 0
                ? round((($soldLastMonth - $soldThisMonth) / $soldLastMonth) * 100, 1)
                : 0;

            // Lợi nhuận %
            $profitPercent = ($food->price > 0 && isset($food->cost_price))
                ? round((($food->price - $food->cost_price) / $food->price) * 100, 1)
                : 0;

            // Đánh giá tiềm năng upsale
            if ($profitPercent >= 50) {
                $potential = ['level' => 'Cao', 'class' => 'success'];
            } elseif ($profitPercent >= 35) {
                $potential = ['level' => 'Trung bình', 'class' => 'warning'];
            } else {
                $potential = ['level' => 'Thấp', 'class' => 'info'];
            }

            // Chỉ chọn món bán giảm > 10% và lợi nhuận > 30% (bạn chỉnh lại rule nếu muốn)
            if ($decreasePercent > 10 && $profitPercent > 30) {
                $upsaleList[] = [
                    'food_name' => $food->name,
                    'food_image' => $food->image,
                    'food_price' => $food->price,
                    'sold' => $soldThisMonth,
                    'decrease' => $decreasePercent,
                    'profit' => $profitPercent,
                    'potential' => $potential['level'],
                    'potential_class' => $potential['class'],
                ];
            }
        }

        // Sắp xếp theo % giảm giảm dần
        usort($upsaleList, function ($a, $b) {
            return $b['decrease'] <=> $a['decrease'];
        });


        // Doanh thu theo khoảng thời gian
        $data = [];
        $period = $request->input('period', 'daily');

        if ($period == 'daily') {
            // 7 ngày gần nhất
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->subDays($i);
                $data[] = [
                    'label' => $i == 0 ? 'Hôm nay' : ($i == 1 ? 'Hôm qua' : $date->format('d/m/Y')),
                    'total_orders' => DB::table('orders')->whereDate('created_at', $date->toDateString())->count(),
                    'at_table' => DB::table('orders')->whereDate('created_at', $date->toDateString())->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereDate('created_at', $date->toDateString())->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereDate('created_at', $date->toDateString())->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        } elseif ($period == 'weekly') {
            $weekCount = (int) Carbon::create($year, 12, 28)->format('W'); // Chuẩn nhất

            for ($week = 1; $week <= $weekCount; $week++) {
                $firstDayOfWeek = Carbon::create($year)->setISODate($year, $week, 1)->startOfDay(); // Thứ 2
                $lastDayOfWeek = Carbon::create($year)->setISODate($year, $week, 7)->endOfDay();   // Chủ nhật

                $data[] = [
                    'label' => 'Tuần ' . $week . ' (' . $firstDayOfWeek->format('d/m') . ' - ' . $lastDayOfWeek->format('d/m') . ')',
                    'total_orders' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->count(),
                    'at_table' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        } elseif ($period == 'monthly') {
            for ($m = 1; $m <= 12; $m++) {
                $data[] = [
                    'label' => 'Tháng ' . $m . '/' . $year,
                    'total_orders' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->count(),
                    'at_table' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        } elseif ($period == 'yearly') {
            $currentYear = $year;
            for ($i = 0; $i < 5; $i++) {
                $y = $currentYear - $i;
                $data[] = [
                    'label' => 'Năm ' . $y,
                    'total_orders' => DB::table('orders')->whereYear('created_at', $y)->count(),
                    'at_table' => DB::table('orders')->whereYear('created_at', $y)->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereYear('created_at', $y)->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereYear('created_at', $y)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        }

        return view('admin.cashier.index', compact(
            'totalRevenue',
            'percentChange',
            'totalOrders',
            'orderPercentChange',
            'avgRevenuePerDay',
            'avgPercentChange',
            'totalDiscount',
            'discountOrderPercent',
            'monthlyRevenue',
            'labels',
            'atTable',
            'takeAway',
            'atTablePercent',
            'takeAwayPercent',
            'listTopDeal',
            'upsaleList',
            'data',
            'period',
        ));
    }

    public function filter(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $period = $request->input('period', 'daily');
        $data = [];

        if ($period == 'daily') {
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->subDays($i);
                $data[] = [
                    'label' => $i == 0 ? 'Hôm nay' : ($i == 1 ? 'Hôm qua' : $date->format('d/m/Y')),
                    'total_orders' => DB::table('orders')->whereDate('created_at', $date->toDateString())->count(),
                    'at_table' => DB::table('orders')->whereDate('created_at', $date->toDateString())->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereDate('created_at', $date->toDateString())->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereDate('created_at', $date->toDateString())->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        } elseif ($period == 'weekly') {
            $weekCount = (int) Carbon::create($year, 12, 28)->format('W');
            for ($week = 1; $week <= $weekCount; $week++) {
                $firstDayOfWeek = Carbon::create($year)->setISODate($year, $week, 1)->startOfDay();
                $lastDayOfWeek = Carbon::create($year)->setISODate($year, $week, 7)->endOfDay();
                $data[] = [
                    'label' => 'Tuần ' . $week . ' (' . $firstDayOfWeek->format('d/m') . ' - ' . $lastDayOfWeek->format('d/m') . ')',
                    'total_orders' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->count(),
                    'at_table' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereBetween('created_at', [$firstDayOfWeek, $lastDayOfWeek])->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        } elseif ($period == 'monthly') {
            for ($m = 1; $m <= 12; $m++) {
                $data[] = [
                    'label' => 'Tháng ' . $m . '/' . $year,
                    'total_orders' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->count(),
                    'at_table' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereYear('created_at', $year)->whereMonth('created_at', $m)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        } elseif ($period == 'yearly') {
            for ($i = 0; $i < 5; $i++) {
                $y = $year - $i;
                $data[] = [
                    'label' => 'Năm ' . $y,
                    'total_orders' => DB::table('orders')->whereYear('created_at', $y)->count(),
                    'at_table' => DB::table('orders')->whereYear('created_at', $y)->where('type', 0)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'take_away' => DB::table('orders')->whereYear('created_at', $y)->where('type', 1)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                    'total_revenue' => DB::table('orders')->whereYear('created_at', $y)->where('statusorder', 'Hoàn Thành')->sum('totalbill'),
                ];
            }
        }

        return response()->json(['data' => $data]);
    }


    public function getTopProductsByMonth(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        // Lấy danh sách top 5 món và tính tổng doanh thu all để tính %
        $list = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('foods', 'order_details.product_id', '=', 'foods.id')
            ->where('orders.statusorder', 'Hoàn Thành')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->select([
                'foods.id',
                'foods.name as food_name',
                'foods.image as food_image',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.quantity * foods.price) as total_revenue'),
            ])
            ->groupBy('foods.id', 'foods.name', 'foods.image')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        $totalAll = $list->sum('total_revenue');
        $badgeColors = ['warning', 'info', 'secondary', 'light text-dark', 'secondary'];

        $data = $list->map(function ($item, $k) use ($totalAll, $badgeColors) {
            $percent = $totalAll > 0 ? round($item->total_revenue / $totalAll * 100, 1) : 0;
            return [
                'food_name' => $item->food_name,
                'food_image' => asset('img/' . $item->food_image),
                'total_quantity' => $item->total_quantity,
                'total_revenue' => $item->total_revenue,
                'percent' => $percent,
                'badge' => $badgeColors[$k] ?? 'secondary',
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function getUpsaleProductsByMonth(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $lastMonth = now()->copy()->subMonth();
        $lastNum = $lastMonth->month;
        $lastYear = $lastMonth->year;

        $foods = Food::all();
        $list = [];

        foreach ($foods as $food) {
            $soldThis = OrderDetail::where('product_id', $food->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('quantity');

            $soldLast = OrderDetail::where('product_id', $food->id)
                ->whereMonth('created_at', $lastNum)
                ->whereYear('created_at', $lastYear)
                ->sum('quantity');

            $decrease = $soldLast > 0
                ? round((($soldLast - $soldThis) / $soldLast) * 100, 1)
                : 0;

            $profit = ($food->price > 0 && isset($food->cost_price))
                ? round((($food->price - $food->cost_price) / $food->price) * 100, 1)
                : 0;

            if ($decrease > 10 && $profit > 30) {
                if ($profit >= 50) {
                    $level = 'Cao';
                    $cls = 'success';
                } elseif ($profit >= 35) {
                    $level = 'Trung bình';
                    $cls = 'warning';
                } else {
                    $level = 'Thấp';
                    $cls = 'info';
                }

                $list[] = [
                    'food_name' => $food->name,
                    'food_image' => asset('img/' . $food->image),
                    'food_price' => $food->price,
                    'sold' => $soldThis,
                    'decrease' => $decrease,
                    'profit' => $profit,
                    'potential' => $level,
                    'potential_class' => $cls,
                ];
            }
        }

        // Sắp xếp giảm dần theo % giảm
        usort($list, fn($a, $b) => $b['decrease'] <=> $a['decrease']);

        return response()->json(['data' => $list]);
    }

}
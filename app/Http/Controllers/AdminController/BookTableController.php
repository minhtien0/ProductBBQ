<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\BookingTable;
use App\Models\Table;
use App\Models\TypePayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookTableController extends Controller
{
    //
    public function index()
    {
        $countAll = BookingTable::count();
        $countPending = BookingTable::where('status', 'Chờ xác nhận')->count();
        $countConfirm = BookingTable::where('status', 'Đã xác nhận')->count();
        $countCancel = BookingTable::where('status', 'Đã hủy')->count();
        $infos = BookingTable::with('table')->orderBy('created_at', 'desc')->get();


        return view('admin.booktable', compact('countAll', 'countPending', 'countConfirm', 'countCancel', 'infos'));
    }

    //Ké admin Table
    public function selectTable(){
        $listTables=Table::all();
        return view('admin.table.index',compact('listTables'));
    }

    //Ké admin Typepayment
    public function selectTypepayment(){
        $listTables=TypePayment::all();
        return view('admin.typepayment.index',compact('listTables'));
    }

    

    public function detail($id)
{
    $details = BookingTable::leftJoin('tables','booking_tables.table_id','=','tables.id')
        ->where('booking_tables.id',$id)
        ->select('booking_tables.*','tables.number as name_table','tables.quantity as quantity_table','booking_tables.id as id_booking')
        ->first();

    $bookingId = $id;
    $currentTime = Carbon::parse($details->time_booking);   
    $currentDate = $currentTime->format('Y-m-d');

    $tables = Table::all();
    $otherBookings = BookingTable::where('id', '!=', $bookingId)
    ->get();

    $listTable = $tables->filter(function($table) use ($otherBookings, $currentTime, $currentDate) {
        $bookingsOfTable = $otherBookings->where('table_id', $table->id) ->where('status','!=','Đã hủy');
        foreach ($bookingsOfTable as $booking) {
            $bookingTime = Carbon::parse($booking->time_booking);

            // Chỉ xét các booking cùng ngày
            if ($bookingTime->format('Y-m-d') === $currentDate) {
                $diff = abs($bookingTime->diffInMinutes($currentTime, false));
                // Nếu khoảng cách thời gian < 120 phút (2 tiếng), loại bàn này ra
                if ($diff < 120) {
                    return false;
                }
            }
        }
        return true;
    });
    //dd($listTable);

    return view('admin.detailbooktable', compact('details', 'listTable'));
}


public function confirmBooking(Request $request, $id)
{
    try {
        $validator = Validator::make($request->all(), [
            'table_id' => 'required|exists:tables,id'
        ], [
            'table_id.required' => 'Bạn phải chọn bàn.',
            'table_id.exists' => 'Bàn không hợp lệ.'
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return response()->json(['success' => false, 'message' => $errorMsg], 400);
        }

        $booking = BookingTable::findOrFail($id);

        if ($booking->status !== 'Chờ xác nhận') {
            return response()->json(['success' => false, 'message' => 'Trạng thái không hợp lệ!'], 400);
        }

        $booking->table_id = $request->table_id;
        $booking->status = 'Đã xác nhận';
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Xác nhận đặt bàn thành công!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
    }
}


public function changeTable(Request $request, $id)
{
    $booking = BookingTable::findOrFail($id);

    if ($booking->status !== 'Đã xác nhận') {
        return response()->json(['message' => 'Chỉ đổi bàn khi đã xác nhận!'], 400);
    }
    $oldTableId = $booking->table_id;
    $booking->table_id = $request->table_id;
    $booking->notes = $request->table_note;
    $booking->save();

    // Cập nhật trạng thái bàn
    if ($oldTableId) {
        Table::where('id', $oldTableId)->update(['status' => 'Trống']);
    }
    return response()->json(['message' => 'Cập nhật thành công!']);
}


public function cancelBooking(Request $request, $id)
{
    $booking = BookingTable::findOrFail($id);

    if ($booking->status == 'Đã hủy') {
        return back()->with('error', 'Đặt bàn đã bị hủy trước đó!');
    }

    $booking->status = 'Đã hủy';
    $booking->save();

    // Trả lại bàn thành "Trống" nếu đã có bàn
    if ($booking->table_id) {
        Table::where('id', $booking->table_id)->update(['status' => 'Trống']);
    }

    return back()->with('success', 'Hủy đặt bàn thành công!');
}

public function sendEmail(Request $request, $id)
{
    $booking = BookingTable::findOrFail($id);

    $to = $booking->email;
    $name = $booking->nameuser ?? 'khách hàng';
    $subject = "Xác nhận đặt bàn tại nhà hàng";

    // Tạo nội dung email chi tiết (dùng HTML, không cần file view)
    $body = "
        <h2>Xin chào $name thân iu,</h2>
        <p>Nhà hàng BBQ Lua Be Hoy xác nhận đã nhận được đơn đặt bàn của bạn. Dưới đây là thông tin chi tiết:</p>
        <ul>
            <li><strong>Tên khách hàng:</strong> $name</li>
            <li><strong>Email:</strong> $booking->email</li>
            <li><strong>Số điện thoại:</strong> $booking->sdt</li>
            <li><strong>Số người:</strong> $booking->quantitypeople</li>
            <li><strong>Thời gian đặt bàn:</strong> ".\Carbon\Carbon::parse($booking->time_booking)->format('d/m/Y H:i')."</li>
            <li><strong>Số bàn:</strong> ".($booking->name_table ?? 'Chưa xác định')."</li>
            <li><strong>Ghi chú:</strong> ".($booking->notes ?? 'Không có')."</li>
        </ul>
        <p>Chúng tôi sẽ liên hệ lại nếu có thay đổi bạn nhé!.<br>Trân trọng cảm ơn!</p>
    ";

    try {
        // Gửi HTML email trực tiếp
        \Mail::html($body, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
        });
        return response()->json(['message' => 'Gửi email thành công!']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gửi email thất bại: '.$e->getMessage()], 500);
    }
}

}

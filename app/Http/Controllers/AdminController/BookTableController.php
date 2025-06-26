<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\BookingTable;
use App\Models\Table;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookTableController extends Controller
{
    //
    public function index()
    {
        $countAll = BookingTable::count();
        $countPending = BookingTable::where('status', 'Chờ xác nhận')->count();
        $countConfirm = BookingTable::where('status', 'Đã xác nhận')->count();
        $countCancel = BookingTable::where('status', 'Đã hủy')->count();
        $infos = BookingTable::all();


        return view('admin.booktable', compact('countAll', 'countPending', 'countConfirm', 'countCancel', 'infos'));
    }

    public function detail($id)
    {
        $details = BookingTable::leftJoin('tables','booking_tables.table_id','=','tables.id')
        ->where('booking_tables.id',$id)
        ->select('booking_tables.*','tables.number as name_table','booking_tables.id as id_booking')
        ->first();

        $listTable = Table::all();
        //dd($details);
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
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        $booking = BookingTable::findOrFail($id);

        if ($booking->status !== 'Chờ xác nhận') {
            return back()->with('error', 'Trạng thái không hợp lệ!');
        }

        $booking->table_id = $request->table_id;
        $booking->status = 'Đã xác nhận';
        $booking->save();
        return back()->with('success', 'Xác nhận đặt bàn thành công!');
    } catch (\Exception $e) {
        return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
    }
}

    public function changeTable(Request $request, $id)
{
    $request->validate([
        'table_id' => 'required|exists:tables,id'
    ], [
        'table_id.required' => 'Bạn phải chọn bàn.',
        'table_id.exists' => 'Bàn không hợp lệ.'
    ]);

    $booking = BookingTable::findOrFail($id);

    if ($booking->status !== 'Đã xác nhận') {
        return back()->with('error', 'Chỉ đổi bàn khi đã xác nhận!');
    }

    $oldTableId = $booking->table_id;
    $booking->table_id = $request->table_id;
    $booking->save();

    // Cập nhật trạng thái bàn
    if ($oldTableId) {
        Table::where('id', $oldTableId)->update(['status' => 'Trống']);
    }
    Table::where('id', $request->table_id)->update(['status' => 'Đã đặt']);

    return back()->with('success', 'Đổi bàn thành công!');
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



}

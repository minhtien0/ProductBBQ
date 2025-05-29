<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class VoucherController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Voucher::query();

        // Tìm kiếm theo trạng thái
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Tìm kiếm theo code
        if ($request->code) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        // Tìm kiếm theo ngày bắt đầu
        if ($request->start) {
            $query->whereDate('time_start', '>=', $request->start);
        }

        // Tìm kiếm theo ngày kết thúc
        if ($request->end) {
            $query->whereDate('time_end', '<=', $request->end);
        }

        $vouchers = $query->paginate(10); // hoặc get()

        return view('admin.voucher.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.voucher.create');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:vouchers,code|max:50',
            'value' => 'required|numeric|min:0|max:1000000',
            'time_start' => 'required|date',
            'time_end' => 'required|date|after:time_start',
            'quantity' => 'required|integer|min:1',
        ], [
            'code.required' => 'Vui lòng nhập mã voucher.',
            'code.unique' => 'Mã voucher đã tồn tại.',
            'value.required' => 'Vui lòng nhập giá trị voucher.',
            'value.numeric' => 'Giá trị phải là số.',
            'value.min' => 'Giá trị không được nhỏ hơn 0.',
            'value.max' => 'Giá trị không được lớn hơn 100.',
            'time_start.required' => 'Vui lòng chọn ngày bắt đầu.',
            'time_end.required' => 'Vui lòng chọn ngày kết thúc.',
            'time_end.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn 0.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            $data = $request->all();
            $data['status'] = 'Còn';
            Voucher::create($data);

            return redirect()->route('admin.voucher')->with('success', 'Thêm voucher thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Thêm không thành công! ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một voucher để xóa.');
        }

        $count = Voucher::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} voucher.");
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.detail', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:50|unique:vouchers,code,' . $voucher->id,
            'value' => 'required|numeric|min:0|max:1000000',
            'time_start' => 'required|date',
            'time_end' => 'required|date|after:time_start',
            'quantity' => 'required|integer|min:1',
        ], [
            'code.required' => 'Vui lòng nhập mã voucher.',
            'code.unique' => 'Mã voucher đã tồn tại.',
            'value.required' => 'Vui lòng nhập giá trị voucher.',
            'value.numeric' => 'Giá trị phải là số.',
            'value.min' => 'Giá trị không được nhỏ hơn 0.',
            'value.max' => 'Giá trị không được lớn hơn 100.',
            'time_start.required' => 'Vui lòng chọn ngày bắt đầu.',
            'time_end.required' => 'Vui lòng chọn ngày kết thúc.',
            'time_end.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn 0.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        $voucher->update($request->only(['code', 'value', 'time_start', 'time_end', 'quantity']));

        return redirect()->route('admin.voucher')->with('success', 'Cập nhật voucher thành công!');
    }


}

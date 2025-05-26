<?php

namespace App\Http\Controllers\AdminController\Staff;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Branch;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\StaffsExport;
use Maatwebsite\Excel\Facades\Excel;

class StaffController extends Controller
{
    //
    public function index()
    {
        $lists = Staff::with('branch')->get();
        return view('admin.staff.index', compact('lists'));
    }

    public function detail($id)
    {
        $staff = Staff::with('branch')->findOrFail($id);
        $branches = Branch::all();
        // Trả về view detail
        return view('admin.staff.detail', compact('staff', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'code_nv' => 'required|string|max:50',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'SDT' => 'nullable|string|max:20',
            'CCCD' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'time_work' => 'nullable|date',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
            'STK' => 'nullable|string|max:50',
            'bank' => 'nullable|string|max:100',
            'avata' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $staff->fill($request->except('avatar'));

        // Xử lý avatar
        if ($request->hasFile('avatar')) {
            // Xoá ảnh cũ nếu có
            if ($staff->avata && file_exists(public_path('img/' . $staff->avata))) {
                @unlink(public_path('img/' . $staff->avata));
            }

            $avataName = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('img'), $avataName);
            $staff->avata = $avataName; // CHỈNH LẠI field này
        }

        $staff->save();

        return redirect()->route('admin.staff.detail', $staff->id)->with('success', 'Cập nhật thành công!');
    }

    public function create()
    {
        $branches = Branch::all(); // Lấy tất cả đơn vị để đưa vào select
        return view('admin.staff.create', compact('branches'));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'role' => 'required|in:Quản Lí,Nhân Viên,Đầu Bếp,Tạp Vụ',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Nam,Nữ,Khác',
            'SDT' => 'required|string|max:20',
            'CCCD' => 'required|string|max:20|unique:staffs,CCCD',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'time_work' => 'required|date',
            'branch' => 'required|exists:branchs,id',
            'type' => 'required|in:Full Time,Part Time',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            // Ghép tất cả lỗi thành 1 chuỗi
            $errorMsg = implode('<br>', $validator->errors()->all());
            // Đưa lỗi vào session flash 'error'
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            // Xử lý upload hình ảnh
            $avataName = null;
            if ($request->hasFile('avatar')) {
                $avataName = time() . '_' . $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move(public_path('img'), $avataName);
            }

            $staff = new Staff();
            $staff->fullname = $request->fullname;
            $staff->date_of_birth = $request->date_of_birth;
            $staff->gender = $request->gender;
            $staff->SDT = $request->SDT;
            $staff->CCCD = $request->CCCD;
            $staff->status = $request->status;
            $staff->address = $request->address;
            $staff->email = $request->email;
            $staff->time_work = $request->time_work;
            $staff->branch_id = $request->branch;
            $staff->type = $request->type;
            $staff->avata = $avataName;
            $staff->STK = $request->STK;
            $staff->bank = $request->bank;
            $staff->role = $request->role;
            $staff->hourly_wage = $request->hourly_wage;
            $staff->Basic_Salary = $request->Basic_Salary;
            $staff->code_nv = 'NV' . $staff->CCCD;
            $staff->save();

            // Thành công
            return redirect()->route('admin.staff.create')->with('success', 'Thêm nhân viên thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Thêm không thành công! ' . $e->getMessage());
        }
    }

    public function exportExcel()
    {
        return Excel::download(new StaffsExport, 'danh-sach-nhan-vien.xlsx');
    }

}

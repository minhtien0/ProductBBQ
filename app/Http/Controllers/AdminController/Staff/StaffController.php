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
use App\Exports\StaffsTemplateExport;
use App\Imports\StaffsImport;
use Maatwebsite\Excel\Validators\ValidationException;

class StaffController extends Controller
{
    //
    public function index(Request $request)
    {
        $branches = Branch::all();  // hoặc từ model của bạn
        $positions = ['Quản Lí', 'Nhân Viên', 'Đầu Bếp', 'Tạp Vụ'];

        $query = Staff::query();

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }
        if ($request->filled('staff_type')) {
            $query->where('type', $request->staff_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('position')) {
            $query->where('role', $request->position);
        }
        if ($request->filled('min_basic_salary')) {
            $query->where('Basic_Salary', '>=', $request->min_basic_salary);
        }
        if ($request->filled('min_hourly_salary')) {
            $query->where('hourly_wage', '>=', $request->min_hourly_salary);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($q2) use ($q) {
                $q2->where('code_nv', 'like', "%{$q}%")
                    ->orWhere('fullname', 'like', "%{$q}%");
            });
        }

        $lists = $query->paginate(10)->withQueryString();

        return view('admin.staff.index', compact('lists', 'branches', 'positions'));
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
            'role' => 'nullable|string',
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

        return redirect()->route('admin.staff', )->with('success', 'Cập nhật thành công!');
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
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên.',
            'fullname.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'role.required' => 'Vui lòng chọn chức vụ.',
            'role.in' => 'Chức vụ không hợp lệ.',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
            'date_of_birth.date' => 'Ngày sinh không đúng định dạng.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.in' => 'Giới tính không hợp lệ.',
            'SDT.required' => 'Vui lòng nhập số điện thoại.',
            'SDT.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'CCCD.required' => 'Vui lòng nhập CCCD.',
            'CCCD.max' => 'CCCD không được vượt quá 20 ký tự.',
            'CCCD.unique' => 'CCCD đã tồn tại.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'time_work.required' => 'Vui lòng chọn ngày vào làm.',
            'time_work.date' => 'Ngày vào làm không đúng định dạng.',
            'branch.required' => 'Vui lòng chọn đơn vị.',
            'branch.exists' => 'Đơn vị không tồn tại.',
            'type.required' => 'Vui lòng chọn loại nhân viên.',
            'type.in' => 'Loại nhân viên không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
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

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một nhân viên để xóa.');
        }

        $count = Staff::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} nhân viên.");
    }

    public function exportExcel(Request $request)
    {
        $filters = $request->only([
            'branch_id',
            'staff_type',
            'status',
            'position',
            'min_basic_salary',
            'min_hourly_salary',
            'q',
        ]);

        // Đặt tên file theo timestamp
        $fileName = 'nhan_vien_' . now()->format('Ymd_His') . '.xlsx';

        // Trả về download
        return Excel::download(
            new StaffsExport($filters),
            $fileName
        );
    }

    public function exportTemplateExcel()
    {
        return Excel::download(new StaffsTemplateExport, 'nhan-vien-mau.xlsx');
    }

    public function importExcel(Request $request)
    {
        // Validate file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new StaffsImport, $request->file('file'));

            return redirect()->back()
                ->with('success', 'Import nhân viên thành công!');
        } catch (ValidationException $e) {
            $failures = $e->failures();

            // Đổi từ array sang Collection
            $messages = collect($failures)->map(function ($failure) {
                return 'Dòng ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            })->implode("<br>");

            return redirect()->back()
                ->with('error', "Import thất bại <br>" . $messages);
        }
    }


}

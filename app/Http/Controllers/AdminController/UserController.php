<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        // Bắt đầu query
        $query = User::query();

        // Lọc theo Email (nếu có)
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Lọc theo Ngày sinh (nếu có)
        if ($request->filled('birthday')) {
            $query->whereDate('birthday', $request->birthday);
        }

        // Lọc theo Tên (nếu có) – ta sẽ tìm trong fullname hoặc trong user (username)
        if ($request->filled('fullname')) {
            $keyword = $request->fullname;
            $query->where(function($q) use ($keyword) {
                $q->where('fullname', 'like', "%{$keyword}%")
                  ->orWhere('user', 'like', "%{$keyword}%");
            });
        }

        // Lọc theo Giới tính (nếu có)
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Lấy kết quả đã lọc; nếu cần phân trang thì thay get() thành paginate(...)
        $users = $query->get();
        return view('admin.users.list', compact('users'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        $addresses = Address::where('user_id', $id)
            ->where('default', 1)
            ->first();
        return view('admin.users.detail', compact('user', 'addresses'));

    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'sdt' => 'required|string|size:10',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'birthday' => 'nullable|date',
            'gender' => 'required|in:Nam,Nữ,Khác',
            'role' => 'required|in:Khách Hàng,Admin',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            //address
            'addresses.*.name' => 'required|string|max:255',
            'addresses.*.sdt' => 'required|string|size:10',
            'addresses.*.house_number' => 'required|string|max:255',
            'addresses.*.ward' => 'required|string|max:255',
            'addresses.*.district' => 'required|string|max:255',
            'addresses.*.city' => 'required|string|max:255',
            'addresses.*.note' => 'nullable|string|max:255',
        ], [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.size' => 'Vui lòng nhập hợp lệ số điện thoại. (10 số)',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'birthday.date' => 'Ngày sinh không hợp lệ.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'role.required' => 'Vui lòng chọn vai trò.',
            'avatar.image' => 'Ảnh đại diện phải là hình ảnh.',
            'avatar.mimes' => 'Định dạng ảnh không hợp lệ.',
            'avatar.max' => 'Ảnh đại diện không vượt quá 10MB.',
            //address
            'addresses.*.name.required' => 'Vui lòng nhập tên người nhận trong địa chỉ.',
            'addresses.*.sdt.required' => 'Vui lòng nhập hợp lệ số điện thoại địa chỉ. (10 số)',
            'addresses.*.sdt.size' => 'Sai format SĐT Của địa chỉ.',
            'addresses.*.house_number.required' => 'Vui lòng nhập số nhà của địa chỉ.',
            'addresses.*.ward.required' => 'Vui lòng Phường/Xã của địa chỉ.',
            'addresses.*.district.required' => 'Vui lòng Quận/Huyện của địa chỉ.',
            'addresses.*.city.required' => 'Vui lòng Tỉnh/TP của địa chỉ.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            // Quay về form và show lỗi bằng popup
            return redirect()->back()->withInput()->with('error', $errorMsg);
        }

        // Xử lý upload avatar mới (nếu có)
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('img'), $avatarName);
            $user->avatar = $avatarName;
        }

        // Cập nhật thông tin còn lại
        $user->fullname = $request->fullname;
        $user->sdt = $request->sdt;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->role = $request->role;
        $user->save();

        if ($request->has('addresses')) {
            foreach ($request->addresses as $key => $addressData) {
                $address = Address::find($addressData['id'] ?? null) ?? new Address();
                $address->user_id = $id;
                $address->name = $addressData['name'];
                $address->sdt = $addressData['sdt'];
                $address->house_number = $addressData['house_number'];
                $address->ward = $addressData['ward'];
                $address->district = $addressData['district'];
                $address->city = $addressData['city'];
                $address->note = $addressData['note'];
                $address->default = $addressData['default'] ?? 0;
                $address->save();
            }
        }

        return redirect()->route('admin.user.detail', $user->id)
            ->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // 1. Validate tiếng Việt bao gồm mảng addresses[0][...]
        $validator = Validator::make($request->all(), [
            'user'      => 'required|string|max:50|unique:users,user',
            'password'  => 'required|string|min:6|confirmed',
            'fullname'  => 'required|string|max:255',
            'sdt'       => 'required|string|size:10',
            'email'     => 'required|email|max:255|unique:users,email',
            'birthday'  => 'nullable|date',
            'gender'    => 'required|in:Nam,Nữ,Khác',
            'role'      => 'required|in:Khách Hàng,Admin',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',

            'addresses.0.name'          => 'required|string|max:255',
            'addresses.0.sdt'           => 'required|string|size:10',
            'addresses.0.house_number'  => 'required|string|max:255',
            'addresses.0.ward'          => 'required|string|max:255',
            'addresses.0.district'      => 'required|string|max:255',
            'addresses.0.city'          => 'required|string|max:255',
            'addresses.0.note'          => 'nullable|string|max:255',
        ], [
            'user.required'           => 'Vui lòng nhập tên đăng nhập.',
            'user.string'             => 'Tên đăng nhập phải là chuỗi ký tự.',
            'user.max'                => 'Tên đăng nhập không vượt quá 50 ký tự.',
            'user.unique'             => 'Tên đăng nhập đã tồn tại.',

            'password.required'       => 'Vui lòng nhập mật khẩu.',
            'password.min'            => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'      => 'Mật khẩu nhập lại không khớp.',

            'fullname.required'       => 'Vui lòng nhập họ và tên.',
            'fullname.max'            => 'Họ và tên không vượt quá 255 ký tự.',

            'sdt.required'            => 'Vui lòng nhập số điện thoại.',
            'sdt.size'                 => 'SĐT phải đúng 10 ký tự.',

            'email.required'          => 'Vui lòng nhập email.',
            'email.email'             => 'Email không đúng định dạng.',
            'email.max'               => 'Email không vượt quá 255 ký tự.',
            'email.unique'            => 'Email đã tồn tại.',

            'birthday.date'           => 'Ngày sinh không hợp lệ.',

            'gender.required'         => 'Vui lòng chọn giới tính.',
            'gender.in'               => 'Giới tính không hợp lệ.',

            'role.required'           => 'Vui lòng chọn vai trò.',
            'role.in'                 => 'Vai trò không hợp lệ.',

            'avatar.image'            => 'Ảnh đại diện phải là file ảnh.',
            'avatar.mimes'            => 'Định dạng ảnh không hợp lệ (chỉ jpeg,png,jpg,gif).',
            'avatar.max'              => 'Ảnh đại diện không vượt quá 10MB.',

            'addresses.0.name.required'         => 'Vui lòng nhập tên người nhận cho địa chỉ.',
            'addresses.0.name.max'              => 'Tên người nhận không vượt quá 255 ký tự.',
            'addresses.0.sdt.required'          => 'Vui lòng nhập SĐT ở địa chỉ.',
            'addresses.0.sdt.size'               => 'SĐT địa chỉ phải đúng 10 ký tự.',
            'addresses.0.house_number.required' => 'Vui lòng nhập số nhà của địa chỉ.',
            'addresses.0.house_number.max'      => 'Số nhà không vượt quá 255 ký tự.',
            'addresses.0.ward.required'         => 'Vui lòng nhập phường/xã của địa chỉ.',
            'addresses.0.ward.max'              => 'Tên phường/xã không vượt quá 255 ký tự.',
            'addresses.0.district.required'     => 'Vui lòng nhập quận/huyện của địa chỉ.',
            'addresses.0.district.max'          => 'Tên quận/huyện không vượt quá 255 ký tự.',
            'addresses.0.city.required'         => 'Vui lòng nhập tỉnh/thành của địa chỉ.',
            'addresses.0.city.max'              => 'Tên tỉnh/thành không vượt quá 255 ký tự.',
            'addresses.0.note.max'              => 'Ghi chú không vượt quá 255 ký tự.',
        ]);

        // Nếu validate lỗi, trả về popup error
        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                             ->withInput()
                             ->with('error', $errorMsg);
        }

        try {
            // 2. Tạo mới User
            $user = new User();
            $user->user     = $request->user;
            $user->password = Hash::make($request->password);
            $user->fullname = $request->fullname;
            $user->sdt      = $request->sdt;
            $user->email    = $request->email;
            $user->birthday = $request->birthday;
            $user->gender   = $request->gender;
            $user->role     = $request->role;

            // Upload avatar (nếu có)
            if ($request->hasFile('avatar')) {
                $avatarName = time() . '_' . $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move(public_path('img'), $avatarName);
                $user->avatar = $avatarName;
            }

            $user->save();

            // 3. Lưu địa chỉ mặc định (địa chỉ index 0)
            $addrData = $request->addresses[0];
            $address = new Address();
            $address->user_id      = $user->id;
            $address->name         = $addrData['name'];
            $address->sdt          = $addrData['sdt'];
            $address->house_number = $addrData['house_number'];
            $address->ward         = $addrData['ward'];
            $address->district     = $addrData['district'];
            $address->city         = $addrData['city'];
            $address->note         = $addrData['note'] ?? '';
            $address->default      = 1; // vì đây là địa chỉ mặc định
            $address->save();

            // 4. Thành công → redirect với popup success
            return redirect()->route('admin.user.list')
                             ->with('success', 'Thêm người dùng thành công!');

        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm người dùng: ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Có lỗi xảy ra khi thêm người dùng. Vui lòng thử lại!');
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một nhân viên để xóa.');
        }

        $count = User::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} người dùng.");
    }


     public function export(Request $request)
    {
        // Lấy toàn bộ query parameters (email, birthday, fullname, gender)
        // Tạo mảng $filters chỉ chứa những key cần thiết
        $filters = [
            'email'    => $request->query('email', ''),
            'birthday' => $request->query('birthday', ''),
            'fullname' => $request->query('fullname', ''),
            'gender'   => $request->query('gender', ''),
        ];

        $fileName = 'users_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UsersExport($filters), $fileName);
    }

}

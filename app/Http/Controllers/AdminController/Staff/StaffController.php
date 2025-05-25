<?php

namespace App\Http\Controllers\AdminController\Staff;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

        // Trả về view detail
        return view('admin.staff.detail', compact('staff'));
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $staff->fill($request->except('avatar'));

        // Xử lý avatar
        if ($request->hasFile('avatar')) {
            // Xoá ảnh cũ nếu có
            if ($staff->avatar && Storage::exists($staff->avatar)) {
                Storage::delete($staff->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $staff->avatar = $path;
        }

        $staff->save();

        return redirect()->route('admin.staff.detail', $staff->id)->with('success', 'Cập nhật thành công!');
    }

}

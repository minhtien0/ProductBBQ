<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{
    //
    public function index()
    {
        $companys = Company::all();
        return view('admin.info', compact('companys'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'sdt' => 'required|max:20',
            'email' => 'required|email',
            'timeopen' => 'required',
            'timeclose' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên công ty.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'timeopen.required' => 'Vui lòng nhập giờ mở cửa.',
            'timeclose.required' => 'Vui lòng nhập giờ đóng cửa.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()->with('error', $errorMsg);
        }

        try {
            $company = Company::findOrFail($id);
            $company->name = $request->name;
            $company->address = $request->address;
            $company->sdt = $request->sdt;
            $company->email = $request->email;
            $company->timeopen = $request->timeopen;
            $company->timeclose = $request->timeclose;
            $company->facebook = $request->facebook;
            $company->telegram = $request->telegram;
            $company->instagram = $request->instagram;
            $company->save();

            return redirect()->back()->with('success', 'Cập nhật thông tin công ty thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

}

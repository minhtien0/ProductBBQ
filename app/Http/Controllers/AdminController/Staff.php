<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Staff extends Controller
{
    //Staff
    public function viewStaff(){
        return view('admin.staff.index');
    }

    public function viewDetailStaff(){
        return view('admin.staff.detail');
    }

    //Job
    public function viewJob(){
        return view('admin.staff.job.index');
    }

    //Đăng kí ca làm
    public function viewRegisterJob(){
        return view('admin.staff.registerjob.index');
    }

    //Chấm Công
    public function viewTimeKeeping(){
        return view('admin.staff.timekeeping.index');
    }

    //Tiền TIP
    public function viewTip(){
        return view('admin.staff.tip.index');
    }

    //Tăng Ca
    public function viewOT(){
        return view('admin.staff.ot.index');
    }

    //Nghỉ Phép
    public function viewOff(){
        return view('admin.staff.off.index');
    }

    //Lương
    public function viewSalary(){
        return view('admin.staff.salary.index');
    }
}

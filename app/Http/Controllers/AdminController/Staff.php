<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Staff extends Controller
{
    //
    public function viewJob(){
        return view('admin.staff.job.index');
    }

    public function viewRegisterJob(){
        return view('admin.staff.registerjob.index');
    }

    public function viewTimeKeeping(){
        return view('admin.staff.timekeeping.index');
    }

    public function viewTip(){
        return view('admin.staff.tip.index');
    }

    public function viewOT(){
        return view('admin.staff.ot.index');
    }

    public function viewOff(){
        return view('admin.staff.off.index');
    }

    public function viewSalary(){
        return view('admin.staff.salary.index');
    }
}

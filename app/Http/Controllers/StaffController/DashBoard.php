<?php

namespace App\Http\Controllers\StaffController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //
    public function index(){
        return view('staff.dashboard');
    }
}

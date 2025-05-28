<?php

namespace App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }


}

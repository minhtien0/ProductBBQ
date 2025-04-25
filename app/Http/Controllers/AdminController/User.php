<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class User extends Controller
{
    //
    public function index(){
        return view('admin.users.list');
    }

    public function detail(){
        return view('admin.users.detail');
    }
}

<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //
    public function index(){
        return view('admin.rate');
    }

}

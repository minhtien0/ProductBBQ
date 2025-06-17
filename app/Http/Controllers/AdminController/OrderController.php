<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //
    public function index()
    {
       
        return view('admin.order.index');
    }
   

}

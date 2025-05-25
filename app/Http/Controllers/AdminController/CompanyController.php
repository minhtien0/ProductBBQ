<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    //
    public function index(){
        $companys = Company::all();
        return view('admin.info',compact('companys'));
    }
}

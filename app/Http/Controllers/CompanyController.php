<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(){
        $companys = Company::all();
        return view('admin.info',compact('companys'));
    }
}

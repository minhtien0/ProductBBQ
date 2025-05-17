<?php

namespace App\Http\Controllers\AdminController\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Category extends Controller
{
    //
    public function index(){
        return view('admin.product.category.index');
    }

}

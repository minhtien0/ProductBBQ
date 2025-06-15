<?php

namespace App\Http\Controllers\AdminController\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Menu;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories=Menu::all();
        return view('admin.product.category.index',compact('categories'));
    }

}

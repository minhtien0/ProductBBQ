<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class BookTable extends Controller
{
    //
    public function index(){
        return view('admin.booktable');
    }

}

<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Rate;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //
    public function index(){
        $countRates=Rate::count();
        $listRates = Rate::with(['food', 'user', 'images'])
        ->where('food_id', '!=', null)
        ->orderByDesc('time')
        ->get();
        return view('admin.rate',compact('countRates','listRates'));
    }



}

<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\BookingTable;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class BookTableController extends Controller
{
    //
    public function index()
    {
        $countAll = BookingTable::count();
        $countPending = BookingTable::where('status', 'Chờ xác nhận')->count();
        $countConfirm = BookingTable::where('status', 'Đã xác nhận')->count();
        $countCancel = BookingTable::where('status', 'Đã hủy')->count();
        $infos=BookingTable::all();


        return view('admin.booktable',compact('countAll','countPending','countConfirm','countCancel','infos'));
    }

    public function detail()
    {
        return view('admin.detailbooktable');
    }

}

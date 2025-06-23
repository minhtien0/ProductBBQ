<?php

namespace App\Http\Controllers\AdminController\Cashier;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\StaffsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StaffsTemplateExport;
use App\Imports\StaffsImport;
use Maatwebsite\Excel\Validators\ValidationException;

class CashierController extends Controller
{
    public function index(){
        return view('admin.cashier.index');
    }
}
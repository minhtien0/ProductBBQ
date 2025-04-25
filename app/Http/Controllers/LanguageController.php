<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage($language)
    {
        $allowedLanguages = ['en', 'ja', 'vi']; 
        if (in_array($language, $allowedLanguages)) {
            Session::put('website_language', $language);
        }
       
        return redirect()->back();
    }
}
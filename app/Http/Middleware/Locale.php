<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Psy\Readline\Hoa\Console;

class Locale
{
    public function handle(Request $request, Closure $next)
{
    $language = $request->session()->get('website_language', config('app.locale'));
   
    App::setLocale($language); 
    return $next($request);
}
    
}
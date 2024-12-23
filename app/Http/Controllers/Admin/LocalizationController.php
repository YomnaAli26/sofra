<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = $request->route('lang','en');
        App::setLocale($locale);
        session()->put('lang', $locale);

//        dd($locale,\app()->getLocale(),session()->get('lang'));
        return to_route("admin.dashboard");
    }
}

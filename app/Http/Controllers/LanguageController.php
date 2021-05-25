<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function change($lang){

        session(['lang' => $lang]);

        return Redirect::back();
    }
}

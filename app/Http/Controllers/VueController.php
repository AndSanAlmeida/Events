<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    public function public()
    {
        return view('vue.public');
    }

    public function admin()
    {
        return view('vue.admin');
    }
}

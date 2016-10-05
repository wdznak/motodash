<?php

namespace App\Motodash\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show Motodash main page
     *
     * @return view
     */
    public function index(Request $request)
    {
        return view('layouts.home_page');
    }
}

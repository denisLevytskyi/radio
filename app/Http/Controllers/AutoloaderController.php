<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoloaderController extends Controller
{
    public function index()
    {
        return view('_lvz.autoloader-index', ['prop' => $this->prop]);
    }
}

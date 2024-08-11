<?php

namespace App\Http\Controllers;

use App\Models\Prop;
use Illuminate\Http\Request;

class AutoloaderController extends Controller
{
    public function index(Prop $prop)
    {
        return view('_lvz.autoloader-index', ['prop' => $prop]);
    }
}

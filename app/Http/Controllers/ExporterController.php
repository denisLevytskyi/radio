<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExporterController extends Controller
{
    public function index()
    {
        return view('_lvz.exporter-index', ['prop' => $this->prop]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImporterController extends Controller
{
    public function index()
    {
        return view('_lvz.importer-index', ['prop' => $this->prop]);
    }
}

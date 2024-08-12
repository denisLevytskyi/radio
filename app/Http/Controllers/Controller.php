<?php

namespace App\Http\Controllers;

use App\Models\Prop;

abstract class Controller
{
    public function __construct (public Prop $prop) {}
}

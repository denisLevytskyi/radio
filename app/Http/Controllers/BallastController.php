<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BallastController extends ImportController
{
    public function create () {
        if ($this->remote_disk()->put('ballast.txt', 'ballast')) {
            return back()->with(['status' => 'Балластный файл создан']);
        } else {
            return back()->withErrors(['status' => 'Ошибка создания балласта']);
        }
    }

    public function delete () {
        if ($this->remote_disk()->delete('ballast.txt')) {
            return back()->with(['status' => 'Балластный файл удален']);
        } else {
            return back()->withErrors(['status' => 'Ошибка удаления балласта']);
        }
    }
}

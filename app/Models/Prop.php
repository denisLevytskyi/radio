<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prop extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public function get_prop ($key) {
        $prop = $this->where('key', '=', $key)->first();
        if ($prop) {
            return $prop->value;
        } else {
            return '-';
        }
    }
}

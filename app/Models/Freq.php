<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freq extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'freq',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getFreqFormAttribute () {
        $hz = (int) round($this->freq * 1000000);
        return sprintf(
            '%dм%03dк%03dг',
            intdiv($hz, 1000000),
            intdiv($hz % 1000000, 1000),
            $hz % 1000
        );
    }
}

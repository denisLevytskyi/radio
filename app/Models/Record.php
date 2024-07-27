<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'timestamp',
        'freq',
        'path',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

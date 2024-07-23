<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'note',
        'user_id',
    ];
    protected $casts=[
        'images'=>"array",
    ];
}

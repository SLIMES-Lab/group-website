<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutpage extends Model
{
    use HasFactory;

    protected $table = 'aboutpage';

    protected $fillable = [
        'description',
        'group_photo',
    ];
}

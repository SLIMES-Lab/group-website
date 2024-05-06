<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'title',
        'email',
        'google_scholar',
        'website',
        'image',
        'current_position',
    ];
    protected $table = 'alumni';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researchpage extends Model
{
    use HasFactory;

    protected $table = 'researchpage';

    protected $fillable = [
        'title',
        'description',
        'cover_photo',
        'item_type',
    ];
}

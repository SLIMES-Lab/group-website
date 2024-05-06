<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory;
    protected $table = 'homepage';

    protected $fillable = [
        'heading',
        'subheading',
        'topics',
        'papers',
        'citations',
        'group_members',
        'john_image',
        'john_details',
    ];

    protected $casts = [
        'topics' => 'array'
    ];
}

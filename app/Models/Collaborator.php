<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'current_position',
        'total_projects',
        'image',
        'email',
        'google_scholar',
        'website',
    ];
}

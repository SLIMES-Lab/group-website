<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'duration',
        'start_date',
        'application_deadline',
        'how_to_apply',
        'contact_information',
        'funding',
    ];
}

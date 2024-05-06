<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'user_id',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'categories',
        'publish_date',
        'is_draft'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

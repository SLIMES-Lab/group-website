<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumImages extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'album_id'];
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}

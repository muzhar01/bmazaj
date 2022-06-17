<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'thumbnail', 'description', 'link', 'views','release_date', 'label_id', 'category_id', 'mood_id', 'album_id', 'genre_id', 'artist_id'];

    // relation for category
    public function category(){

        return $this->belongsTo(Category::class);

    }

}

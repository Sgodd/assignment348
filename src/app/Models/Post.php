<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function likes() {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function replies() {
        return $this->hasMany(\App\Models\Post::class, 'reply_id', 'id');
    }

    public function reply_to() {
        return $this->belongsTo(\App\Models\Post::class, 'reply_id', 'id');
    }

    public function image() {
        return $this->morphONe(\App\Models\Image::class, 'imageable');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user_id",
        "text"
    ];
}

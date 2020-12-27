<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function user() {
        $this->belongsTo(\App\Models\User::class);
    }

    public function post() {
        $this->belongsTo(\App\Models\Post::class);
    }

    public static function find($postId) {
        return Like::get()->where('post_id', $postId);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user_id",
        "post_id"
    ];

    public $primary = ["user_id", "post_id"];
}

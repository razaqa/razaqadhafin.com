<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    /**
     * Relation to Post model.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relation to User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

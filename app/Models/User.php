<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_name',
        'provider_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Bootstrap any application services.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if(empty($user->api_token)) {
                $user->api_token = str_random(50);
            }
        });

        static::deleting(function ($user) {
            $user->posts()->delete();
            $user->comments()->delete();
        });
    }

    /**
     * Relation to Post model.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relation to Comment model.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relation to Message model.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get all admin data.
     */
    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }
}

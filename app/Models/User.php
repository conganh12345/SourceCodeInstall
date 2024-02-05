<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Database\Seeders\DatabaseSeeder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //tự động chạy hàm gán vai trò khi đăng ký người dùng mới
    protected static function boot()
    {
        parent::boot();


        static::created(function ($user) {

            \Artisan::call('db:seed', ['--class' => DatabaseSeeder::class]);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Uuid;

    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];
    protected $uuidVersion  = 5;


    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'status',
        'suspend',
        'last_login',
        'current_login',
        'user_token',
        'social_id',
        'social_type',
        'seller_id',
        'store_name'
    ];

    protected $hidden = [
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


// $table->increments('id');
// $table->string('name', 32);
// $table->string('username', 32);
// $table->string('email', 320);
// $table->string('password', 64);
// $table->string('role', 32);
// $table->string('confirmation_code');
// $table->boolean('confirmed')->default(true);
// $table->timestamps();

// $table->unique('email', 'users_email_uniq');

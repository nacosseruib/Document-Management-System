<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;


class UploadFile extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Uuid;

    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];
    protected $uuidVersion  = 5;
    protected $table        = 'upload_file';
    protected $primaryKey   = 'upload_fileID';


    protected $fillable = [
        'userID',
        'folderID',
        'file_name',
        'file_description',
        'can_read',
        'can_delete',
        'can_download',
        'can_edit',
        'can_share',
        'file_status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [];

    protected $hidden = [];

    public $timestamps = true;

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

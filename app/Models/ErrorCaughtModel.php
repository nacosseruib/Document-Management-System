<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ErrorCaughtModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'try_catch_error';
    protected $primaryKey   = 'errorID';


    protected $fillable = [
        'throwable_error',
        'function_module_name',
        'status',
        'created_at',
        'updated_at',
        'solution',
        'error_description',
    ];




    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'page';
    protected $primaryKey   = 'pageID';


    protected $fillable = [
        'page_name',
        'status',
        'route',

    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = true;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PageContentModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'page_content';
    protected $primaryKey   = 'page_contentID';


    protected $fillable = [
        'pageID',
        'title',
        'content',
        'page_type',
        'created_at',
        'updated_at',
        'page_status',
        'userID'
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = true;

}

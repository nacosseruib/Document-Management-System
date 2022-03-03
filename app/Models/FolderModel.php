<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FolderModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'folders';
    protected $primaryKey   = 'folderID';


    protected $fillable = [
        'folder_name',
        'userID',
        'folder_status',
        'created_at',
        'updated_at',

    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = true;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AssignFolderModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'assign_folder';
    protected $primaryKey   = 'assign_folderID';


    protected $fillable = [
        'userID',
        'forlderID',
        'created_at',
        'updated_at'
    ];




    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $hidden = [];

    public $timestamps = true;

}

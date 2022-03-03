<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SubModule extends Model 
{
    protected $table        = 'submodule';
    protected $primaryKey   = 'submoduleID';
    
    use Notifiable;

    protected $fillable = [
        'moduleID', 
        'submodule_name',
        'submodule_url',
        'submodule_rank',
        'submodule_active',
        'submodule_updated_at',
        'submodule_active_page',
        'submodule_icon',
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}

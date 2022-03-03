<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AssignSubmoduleRole extends Model 
{
    protected $table        = 'assign_submodule_role';
    protected $primaryKey   = 'assign_submoduleID';
    
    use Notifiable;

    protected $fillable = [
        'roleID', 
        'submoduleID',
        'assign_submodule_active',
        'updated_at',
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}

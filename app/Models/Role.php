<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model 
{
    protected $table        = 'role';
    protected $primaryKey   = 'roleID';
    
    use Notifiable;

    protected $fillable = [
        'role_name', 
        'role_active',
        'updated_at',
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}

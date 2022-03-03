<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Module extends Model 
{
    protected $table        = 'module';
    protected $primaryKey   = 'moduleID';
    
    use Notifiable;

    protected $fillable = [
        'module_name', 
        'module_url',
        'module_rank',
        'module_active',
        'module_icon',
        'updated_at',
    ];
    
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
}

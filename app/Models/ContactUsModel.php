<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'contact_us';
    protected $primaryKey   = 'contactusID';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'message',
        'created_at',
        'updated_at'
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = true;

}

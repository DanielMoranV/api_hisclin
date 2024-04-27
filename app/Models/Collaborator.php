<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;
    protected $table = 'collaborators';
    protected $fillable = [
        'fullname',
        'dni',
        'phone',
        'email',
        'url_photo_profile',
    ];
}

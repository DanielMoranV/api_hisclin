<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'access';

    protected $fillable = [
        'username',
        'status',
        'role_id',
        'collaborator_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function collaborator()
    {
        return $this->belongsTo('App\Collaborator');
    }

    public function trackings()
    {
        return $this->hasMany('App\Tracking');
    }
}

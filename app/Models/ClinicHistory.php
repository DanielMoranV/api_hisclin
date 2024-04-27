<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicHistory extends Model
{
    use HasFactory;

    protected $table = 'clinic_history';
    protected $fillable = [
        'number',
        'status',
    ];

    public function trackings()
    {
        return $this->hasMany('App\Tracking');
    }
}

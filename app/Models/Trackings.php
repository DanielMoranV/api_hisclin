<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';

    protected $fillable = [
        'requesting_id',
        'issue_id',
        'request_date',
        'return_date',
        'clinic_history_id',
        'reason',
    ];

    public function requestingAccess()
    {
        return $this->belongsTo('App\Access', 'requesting_id');
    }

    public function issueAccess()
    {
        return $this->belongsTo('App\Access', 'issue_id');
    }

    public function clinicHistory()
    {
        return $this->belongsTo('App\ClinicHistory');
    }
}

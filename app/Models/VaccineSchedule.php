<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'vaccine_center_id', 'schedule_date', 'email_sent', 'sms_sent'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vaccineCenter() {
        return $this->belongsTo(VaccineCenter::class);
    }
}

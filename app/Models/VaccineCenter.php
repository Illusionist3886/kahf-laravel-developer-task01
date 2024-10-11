<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'city', 'area', 'name', 'capacity', 'available_quantity', 'is_active'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vaccineCenter) {
            $vaccineCenter->available_quantity = $vaccineCenter->capacity;
        });
    }
}

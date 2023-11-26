<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'Vehicle';
    protected $primaryKey = 'plate_number';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'plate_number','vehicle_type', 'post_office_owner',
    ];

    const VEHICLE_TYPES = [
        "รถบรรทุก 10 ล้อ" => 'รถบรรทุก 10 ล้อ',
        "รถบรรทุก 6 ล้อ" => 'รถบรรทุก 6 ล้อ',
        "รถบรรทุก 4 ล้อ" => 'รถบรรทุก 4 ล้อ',
        'รถจักรยานยนต์' => 'รถจักรยานยนต์',
    ];

    public function owner()
    {
        return $this->belongsTo(PostalCode::class, 'post_office_owner','postal_code');
    }

}



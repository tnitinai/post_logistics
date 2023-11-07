<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use HasFactory;

    protected $table = 'Package_Status';
    protected $primaryKey = 'tracking_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tracking_id','status_id', 'detail','created_by',
    ];
}

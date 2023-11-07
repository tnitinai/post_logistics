<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PackageMovement extends Pivot
{
    use HasFactory;

    protected $table = 'Package_Status';
    public $incrementing = false;
    public $timestamps = false;

}

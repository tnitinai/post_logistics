<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PackageStatus extends Model
{
    use HasFactory;

    protected $table = 'Package_Status';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tracking_id','status_id', 'src_postal','dst_postal','detail','created_by',
    ];
}

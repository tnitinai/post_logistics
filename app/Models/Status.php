<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Package;

class Status extends Model
{
    use HasFactory;

    protected $table = 'Status';
    protected $primaryKey = 'status_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'status_id', 'name'
    ];

    /**
     * The packages that belong to the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, null, 'status_id', 'tracking_id', 'status_id')
            ->using(PackageMovement::class)
            // ->as('package_movement')
            // ->withPivot('status_id')
            // ->withTimestamps()
            ;
    }
}

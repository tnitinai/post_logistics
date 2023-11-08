<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bag extends Model
{
    use HasFactory;

    protected $table = 'Bag';
    protected $primaryKey = 'bag_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['bag_id', 'to_postal_code', 'transport_id'];

    /**
     * Get all of the packages for the bag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'bag_id', 'bag_id');
    }

    /**
     * Get the postalCode that owns the bag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postalCode(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class, 'to_postal_code', 'postal_code');
    }


    public function scopeGenerateBagTag($q, $source_postal, $destination_postal)
    {
        $today = Carbon::today()->format('ymd');
        $rand = rand(100,999);

        return $today . $rand . 'B' . $source_postal . $destination_postal;
    }
}

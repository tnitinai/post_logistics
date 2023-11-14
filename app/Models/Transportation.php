<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transportation extends Model
{
    use HasFactory;

    protected $table = 'Transportation';
    protected $primaryKey = 'transportation_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['transportation_id', 'plate_number', 'driver_id', 'from_post_office_code', 'to_post_office_code', 'start_driving', 'finish_driving'];

    /**
     * Get the sourcePostal that owns the Transportation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sourcePostal(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class, 'from_post_office_code', 'postal_code');
    }

    /**
     * Get the destinationPostal that owns the Transportation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationPostal(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class, 'to_post_office_code', 'postal_code');
    }

    /**
     * Get the driver that owns the Transportation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id','id');
    }

    /**
     * Get the vehicle that owns the Transportation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class,'plate_number', 'plate_number');
    }

    /**
     * Get all of the bags for the Transportation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bags(): HasMany
    {
        return $this->hasMany(Bag::class, 'transport_id', 'transportation_id');
    }

    public function scopeGenerateTransportId($q, $srcPostal, $dstPostal)
    {
        $today = Carbon::today()->format('ymd');
        $rand = rand(100,999);

        return $today . $rand . $srcPostal . $dstPostal;
    }
}

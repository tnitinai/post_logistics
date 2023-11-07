<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\PostalCode;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    protected $table = 'Package';
    protected $primaryKey = 'tracking_number';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $with = ['statuses'];
    protected $fillable = [
        'tracking_number', 'sender_id', 'from_postal_code', 'weight', 'price', 'receiver_name', 'receiver_address', 'receiver_telephone', 'to_postal_code', 'invoice_id', 'bag_id'
    ];

    public function getSourcePostalNameAttribute()
    {
    }

    /**
     * Get the SourcePostalCode that owns the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sourcePostalCode(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class, 'from_postal_code', 'postal_code');
    }

    /**
     * Get the SourcePostalCode that owns the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationPostalCode(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class, 'to_postal_code', 'postal_code');
    }

    /**
     * Get all of the statuses for the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class, 'Package_Status', 'tracking_id', 'status_id', 'tracking_number')
            ->as('package_movement')
            ->withPivot('status_id')
            ->withTimestamps();
    }

    public function scopeCalculateServiceFee($q, $weight)
    {
        $price = 40;
        if ($weight > 1) {
            $remaining_weight = ceil($weight - 1);
            $price += 25 * $remaining_weight;
        }

        return $price;
    }
}

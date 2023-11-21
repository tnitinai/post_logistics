<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\PostalCode;

class Package extends Model
{
    use HasFactory;

    protected $table = 'Package';
    protected $primaryKey = 'tracking_number';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    // protected $with = ['statuses'];
    protected $fillable = [
        'tracking_number', 'sender_id', 'from_postal_code', 'weight', 'price', 'receiver_name', 'receiver_address', 'receiver_telephone', 'to_postal_code', 'current_status','invoice_id', 'bag_id', 'postman_id'
    ];

    public function getSourcePostalNameAttribute()
    {
    }

    public function getLastStatusAttribute()
    {
        return Status::find($this->current_status)->name;
    }

    /**
     * Get the bag that owns the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bag(): BelongsTo
    {
        return $this->belongsTo(Bag::class,'bag_id', 'bag_id');
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
        return $this->belongsToMany(Status::class, null, 'tracking_id', 'status_id', 'tracking_number')
            ->using(PackageMovement::class)
            ->withPivot(['created_at', 'created_by', 'detail', 'src_postal', 'dst_postal']);
        //return $this->belongsToMany(Status::class, 'Package_Status', 'tracking_id', 'status_id', 'tracking_number')
        //->as('package_movement')
        //->withPivot('status_id')
        //->withTimestamps();
    }

    /**
     * Get all of the movements for the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movements(): HasMany
    {
        return $this->hasMany(PackageMovement::class, 'tracking_id', 'tracking_number');
    }

    /**
     * Get the postman that owns the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postman(): BelongsTo
    {
        return $this->belongsTo(User::class,'postman_id','id');
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

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    use HasFactory;

    protected $table = 'Bag';
    protected $primaryKey = 'bag_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['bag_id', 'to_postal_code', 'transport_id'];

    public function scopeGenerateBagTag($q, $source_postal, $destination_postal)
    {
        $today = Carbon::today()->format('ymd');
        $rand = rand(100,999);

        return $today . $rand . 'B' . $source_postal . $destination_postal;
    }
}

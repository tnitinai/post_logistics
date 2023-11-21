<?php
namespace App\Traits;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Transportation;
use Illuminate\Support\Facades\Auth;

trait MovementTrait
{
    public function appendMovementLog(Package $package, int $status_id, string $detail = null)
    {
        $package->movements()->create(['status_id' => $status_id, 'created_by' => Auth::user()->id, 'detail' => $detail]);
    }

    public function recordMovementWhenReachDestination(Transportation $trans) : void {
        $trans->bags()->each(function(Bag $bag) use($trans) {
            $bag->packages()->each(function(Package $package) use($trans) {
                $this->appendMovementLog($package, 4, $trans->transportation_id);
            });
        });
    }
}

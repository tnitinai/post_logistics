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

    public function recordMovementWhenReachDestination(Transportation $trans, int $status) : void {
        $trans->bags()->each(function(Bag $bag) use($trans, $status) {
            $bag->packages()->each(function(Package $package) use($trans, $status) {
                $package->update(['current_status' => $status]);
                $this->appendMovementLog($package, $status, $trans->transportation_id);
            });
        });
    }
}

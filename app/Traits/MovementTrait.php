<?php
namespace App\Traits;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Transportation;
use Illuminate\Support\Facades\Auth;

trait MovementTrait
{
    public function appendMovementLog(Package $package, int $status_id, string $detail = null, string $src_post = null, string $dst_post = null)
    {
        $package->update(['current_status' => $status_id]);
        $package->movements()->create(['status_id' => $status_id, 'created_by' => Auth::user()->id, 'detail' => $detail, 'src_postal' => $src_post, 'dst_postal' => $dst_post]);
    }

    public function recordMovementWhenReachDestination(Transportation $trans, int $status, string $src_post = null, string $dst_post = null) : void {
        $trans->bags()->each(function(Bag $bag) use($trans, $status, $src_post, $dst_post) {
            $bag->packages()->each(function(Package $package) use($trans, $status, $src_post, $dst_post) {
                $package->update(['current_status' => $status]);
                $this->appendMovementLog($package, $status, $trans->transportation_id, $src_post, $dst_post );
            });
        });
    }

    public function recordUppackingBag(Bag $bag, int $movement_status, string $detail = null, string $src_post = null, string $dst_post = null) :void {
        $bag->packages()->each(function(Package $package) use ($movement_status, $bag, $src_post, $dst_post) {
            $package->update(['current_status' => $movement_status]);
            $this->appendMovementLog($package, $movement_status, $bag->bag_id, $src_post, $dst_post);
        });
    }
}

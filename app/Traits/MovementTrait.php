<?php
namespace App\Traits;

use App\Models\Package;
use Illuminate\Support\Facades\Auth;

trait MovementTrait
{
    public function appendMovementLog(Package $package, int $status_id)
    {
        $package->movements()->create(['status_id' => $status_id, 'created_by' => Auth::user()->id]);
    }
}

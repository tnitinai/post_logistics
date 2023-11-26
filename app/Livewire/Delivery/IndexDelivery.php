<?php

namespace App\Livewire\Delivery;

use Illuminate\Database\Eloquent\Builder;

use App\Models\PostalCode;
use App\Models\Package;
use App\Models\User;
use App\Traits\MovementTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IndexDelivery extends Component
{
    use MovementTrait;

    public $packages;
    public $postmen;
    public $postman_id;

    public function mount() {
        $this->postman_id = Auth::user()->id;
        $this->packages = Package::where('delivery_id', $this->postman_id)->get();
        $this->postmen = User::where('role_id', 4)->get();
    }

    public function searchPackages()
    {
        $this->packages = Package::where('delivery_id', $this->postman_id)->get();
    }

    public function onClickSuccess($package)
    {
        $package = Package::where('tracking_number', $package)->first();
        $this->appendMovementLog($package, 13, null,Auth::user()->post_office_id,Auth::user()->post_office_id);
    }

    public function onClickFailure($package)
    {
        $package = Package::where('tracking_number', $package)->first();
        $this->appendMovementLog($package, 14, null,Auth::user()->post_office_id,Auth::user()->post_office_id);
    }

    public function render()
    {
        $this->packages = Package::where('delivery_id', $this->postman_id)->get();
        return view('livewire.delivery.index-delivery');
    }
}

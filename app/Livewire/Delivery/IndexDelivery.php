<?php

namespace App\Livewire\Delivery;

use Illuminate\Database\Eloquent\Builder;

use App\Models\PostalCode;
use App\Models\Package;
use App\Models\User;
use Livewire\Component;

class IndexDelivery extends Component
{
    public $packages;
    public $postmen;
    public $postman_id;

    public function mount() {
        $this->packages = [];
        $this->postmen = User::where('role_id', 4)->get();
    }

    public function searchPackages()
    {
        $this->packages = Package::where('postman_id', $this->postman_id)->get();
    }

    public function onClickSuccess($package)
    {
        Package::where('tracking_number', $package)->update(['current_status' => 13]);
    }

    public function onClickFailure($package)
    {
        Package::where('tracking_number', $package)->update(['current_status' => 14]);
    }

    public function render()
    {
        return view('livewire.delivery.index-delivery');
    }
}

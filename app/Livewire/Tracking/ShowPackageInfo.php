<?php

namespace App\Livewire\Tracking;

use App\Models\Package;
use Livewire\Component;

class ShowPackageInfo extends Component
{
    public $movements;
    public $tracking;

    public function mount($tracking)
    {
        $this->tracking = $tracking;
        $this->movements = Package::where('tracking_number',$tracking)->first()->statuses;

    }

    public function render()
    {
        return view('livewire.tracking.show-package-info');
    }
}

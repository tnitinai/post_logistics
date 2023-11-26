<?php

namespace App\Livewire\Tracking;

use App\Models\Package;
use Livewire\Component;

use Livewire\Attributes\On;

class ShowPackageInfo extends Component
{
    public $movements;
    public $tracking;

    public function mount($tracking = null)
    {
        $this->tracking = $tracking;
        if(Package::where('tracking_number',$tracking)->exists()){
            $this->movements = Package::where('tracking_number',$tracking)->first()->statuses;
        }else {
            $this->movements = [];
        }

    }

    #[On('click-search-package')]
    public function showTracking($tracking)
    {
        $this->tracking = $tracking;
        ($this->movements = []);
    }

    public function render()
    {
        return view('livewire.tracking.show-package-info');
    }
}

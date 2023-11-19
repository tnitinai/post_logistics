<?php

namespace App\Livewire\Tracking;

use App\Models\Package;
use Livewire\Component;

class FindPackage extends Component
{
    public $tracking_id;
    public $movements;

    public function searchPackage()
    {
        $isExisted = Package::where('tracking_number', $this->tracking_id)->exists();

        if(!$isExisted) {
            return;
        }

        $this->redirect('/tracking/'.$this->tracking_id);
    }

    public function render()
    {
        return view('livewire.tracking.find-package');
    }
}

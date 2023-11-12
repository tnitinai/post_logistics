<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use Livewire\Component;

class IndexVehicle extends Component
{
    public $vehicles;
    public $shownCreateForm = false;

    public function render()
    {
        $this->vehicles = Vehicle::all();

        return view('livewire.vehicle.index-vehicle');
    }
}

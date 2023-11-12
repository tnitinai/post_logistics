<?php

namespace App\Livewire\Vehicle;

use App\Models\PostalCode;
use App\Models\Vehicle;
use Livewire\Component;

class CreateVehicle extends Component
{
    public $vehicle;
    public $postalCodes;
    public $vehicleTypes = [];

    public function mount()
    {
        $this->postalCodes = PostalCode::all();
        $this->vehicleTypes = Vehicle::VEHICLE_TYPES;
        $this->vehicle = [];
    }

    public function saveVehicle()
    {
        $newVehicle = Vehicle::create($this->vehicle);

        if($newVehicle) {
            session()->flash('status', ['type' => 'success', 'message' => 'บันทึกข้อมูลยานพาหนะสำเร็จ']);
            $this->redirect('vehicle');
        }else {

        }
    }

    public function render()
    {
        return view('livewire.vehicle.create-vehicle');
    }
}

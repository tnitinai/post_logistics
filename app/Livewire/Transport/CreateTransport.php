<?php

namespace App\Livewire\Transport;

use App\Models\PostalCode;
use App\Models\Transportation;
use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;
use App\Traits\MovementTrait;
use Illuminate\Support\Facades\Auth;

class CreateTransport extends Component
{
    use MovementTrait;

    public $transport;
    public $postalCodes;
    public $vehicleTypes;
    public $vehicles;
    public $drivers;

    public function mount()
    {
        $this->transport = [];
        $this->vehicles = [];
        $this->postalCodes = PostalCode::all();
        $this->vehicleTypes = Vehicle::VEHICLE_TYPES;
        $this->transport['from_post_office_code'] = Auth::user()->post_office_id;
    }

    public function onClickNext()
    {
        $this->transport['transportation_id'] = Transportation::generateTransportId(
            $this->transport['from_post_office_code'],
            $this->transport['to_post_office_code']);

        $this->drivers = User::where('post_office_id', $this->transport['from_post_office_code'])
            ->where('role_id',3)
            ->get();
    }

    public function updated($property)
    {
        // $property: The name of the current property that was updated
        if ($property === 'transport.vehicle_type') {
            $this->onChangeVehicleType();
        }
    }

    public function saveTransportation()
    {
        $newTransport = Transportation::create($this->transport);

        if($newTransport) {
            session()->flash('status', ['type' => 'success', 'message' => 'สร้างข้อมูลการขนส่งสำเร็จ']);
            $this->redirect('transportation');
        }
    }

    private function onChangeVehicleType()
    {
        $this->vehicles = Vehicle::where('vehicle_type', $this->transport['vehicle_type'])
            ->where('post_office_owner', $this->transport['from_post_office_code'])->get();
    }

    public function render()
    {
        return view('livewire.transport.create-transport');
    }
}

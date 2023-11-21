<?php

namespace App\Livewire\Transport;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Transportation;
use Carbon\Carbon;
use Livewire\Component;
use App\Traits\MovementTrait;

class ManageTransport extends Component
{
    use MovementTrait;

    public $transportations;
    public $shownNewTransportation = false;

    public function mount()
    {
        $this->transportations = Transportation::all();
    }

    public function onClickDriving($transportation)
    {
        $trans = Transportation::where('transportation_id', $transportation)->first();
        if (is_null($trans->start_driving)) {
            $trans->update(['start_driving' => Carbon::now()]);
        } else {
            $trans->update(['finish_driving' => Carbon::now(), 'current_status' => 4]);
            // when arriving at destination record movement log
            $this->recordMovementWhenReachDestination($trans);
        }

        session()->flash('status', [
            'type' => 'success',
            'message' => 'บันทึกข้อมูลการขนส่งยานพาหนะสำเร็จ'
        ]);
        $this->redirect('transportation');
    }

    public function render()
    {
        return view('livewire.transport.manage-transport');
    }
}

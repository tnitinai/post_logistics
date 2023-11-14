<?php

namespace App\Livewire\Transport;

use App\Models\Transportation;
use Carbon\Carbon;
use Livewire\Component;

class ManageTransport extends Component
{
    public $transportations;
    public $shownNewTransportation = false;

    public function mount()
    {
        $this->transportations = Transportation::all();
    }

    public function onClickDriving($transportation)
    {
        $trans = Transportation::where('transportation_id',$transportation)->first();
        if(is_null($trans->start_driving)) {
            $trans->update(['start_driving' => Carbon::now()]);
        }else {
            $trans->update(['finish_driving' => Carbon::now()]);
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

<?php

namespace App\Livewire\Transport;

use App\Models\Bag;
use App\Models\Transportation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class BagTransport extends Component
{
    public $transportation;
    public $availableBags;
    public $selectedBags = [];
    public $shownBagTransport = false;

    #[On('show-available-bags')]
    public function showAvailableBags($transportation)
    {
        $this->shownBagTransport = !$this->shownBagTransport;
        $this->transportation = $transportation;
        $this->availableBags = Bag::whereDoesntHave('transport')->get();
    }

    public function saveBags()
    {
        DB::transaction(function () use (&$result) {
            $result = null;
            $tranport = Transportation::where('transportation_id',$this->transportation)->first();
            foreach ($this->selectedBags as $bag) {
                $added = Bag::where('bag_id',$bag)->first()->transport()->associate($tranport)->save();
                $result = $added ? true : false;
            }
        });

        if ($result) {
            session()->flash('status', [
                'type' => 'success',
                'message' => 'บันทึกข้อมูลการบรรทุกถุงไปรษณีย์ลงยานพาหนะสำเร็จ'
            ]);
            $this->redirect('transportation');
        }
    }

    public function render()
    {
        return view('livewire.transport.bag-transport');
    }
}

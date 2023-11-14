<?php

namespace App\Livewire\Transport;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Bag;
use App\Models\Transportation;

class BagInTransport extends Component
{
    public $transportation;
    public $bags;
    public $shownBagInTransport = false;

    #[On('show-bags')]
    public function showBags($transportation)
    {
        $this->shownBagInTransport = !$this->shownBagInTransport;
        $this->transportation = Transportation::where('transportation_id', $transportation)->first();
        $this->bags = $this->transportation->bags;
    }

    public function removeBag($bag_id)
    {
        Bag::where('bag_id', $bag_id)->first()->transport()->disassociate()->save();
    }

    public function render()
    {
        if(!is_null($this->bags)) {
            $this->bags = $this->transportation->bags;
        }
        return view('livewire.transport.bag-in-transport');
    }
}

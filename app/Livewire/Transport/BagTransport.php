<?php

namespace App\Livewire\Transport;

use App\Models\Bag;
use Livewire\Component;
use Livewire\Attributes\On;

class BagTransport extends Component
{
    public $transportation;
    public $availableBags;
    public $selectedBags = [];

    #[On('show-available-bags')]
    public function showAvailableBags($transportation)
    {
        $this->transportation = $transportation;
        $this->availableBags = Bag::whereDoesntHave('transport')->get();
    }

    public function render()
    {
        return view('livewire.transport.bag-transport');
    }
}

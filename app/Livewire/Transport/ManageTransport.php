<?php

namespace App\Livewire\Transport;

use App\Models\Transportation;
use Livewire\Component;

class ManageTransport extends Component
{
    public $transportations;
    public $shownNewTransportation = false;
    public $shownBagTransport = false;

    public function mount()
    {
        $this->transportations = Transportation::all();
    }

    public function render()
    {
        return view('livewire.transport.manage-transport');
    }
}

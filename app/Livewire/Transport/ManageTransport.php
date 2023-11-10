<?php

namespace App\Livewire\Transport;

use Livewire\Component;

class ManageTransport extends Component
{

    public $shownTransportForm = false;

    public function onClickCreateTransport()
    {
        //show input form
        $this->shownTransportForm = !$this->shownTransportForm;
    }


    public function render()
    {
        return view('livewire.transport.manage-transport');
    }
}

<?php

namespace App\Livewire\Bag;

use App\Models\Bag;
use Livewire\Component;

class ManageBag extends Component
{
    public $bags;

    public function mount()
    {
        $this->bags = Bag::all();
    }

    public function onClickShowPackages(string $bag_id)
    {
        $this->dispatch('show-packages', bag_id: $bag_id)->to('bag.show-packages');

    }

    public function render()
    {
        return view('livewire.bag.manage-bag');
    }
}

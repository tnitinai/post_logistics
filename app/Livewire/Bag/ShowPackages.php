<?php

namespace App\Livewire\Bag;

use App\Models\Bag;
use Livewire\Component;
use Livewire\Attributes\On;

class ShowPackages extends Component
{
    public $packages = [];

    #[On('show-packages')]
    public function showPackagesInBag(string $bag_id)
    {
        $bag = Bag::find($bag_id);
        $this->packages = $bag->packages;
    }

    public function render()
    {
        return view('livewire.bag.show-packages');
    }
}

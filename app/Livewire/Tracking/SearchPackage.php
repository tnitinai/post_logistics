<?php

namespace App\Livewire\Tracking;

use App\Models\Package;
use Livewire\Component;

class SearchPackage extends Component
{
    public $tracking;
    public $movements;
    public $shownResult;

    public function mount()
    {
        $this->movements = [];
        $this->shownResult = false;
    }

    public function searchPackage()
    {
        $this->dispatch('click-search-package', tracking: $this->tracking);
    }

    public function render()
    {
        return view('livewire.tracking.search-package')
            ->layout('layouts.app');
    }
}

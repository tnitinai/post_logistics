<?php

namespace App\Livewire\Package;

use App\Models\Package;
use App\Models\Transportation;
use Livewire\Component;

class ShowPackage extends Component
{
    public $transportations;
    public $packages;

    public function mount()
    {
        // $this->transportations = Transportation::all();
        $packages = Package::whereHas('bag')->get();
        $this->packages = $packages->merge(Package::whereDoesntHave('bag.transport')->get());
    }

    public function render()
    {
        return view('livewire.package.show-package');
    }
}

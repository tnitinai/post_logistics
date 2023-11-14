<?php

namespace App\Livewire\Distribution;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Transportation;
use Livewire\Component;

class IndexDistribution extends Component
{
    public $packages;
    public $bags;
    public $transportations;

    public function mount()
    {
        $this->bags = Bag::whereHas('transport', function(Builder $query) {
            $query->whereNotNull('finish_driving');
        })->get();
    }

    public function render()
    {
        return view('livewire.distribution.index-distribution');
    }
}

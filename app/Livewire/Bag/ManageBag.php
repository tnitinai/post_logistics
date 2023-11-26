<?php

namespace App\Livewire\Bag;

use App\Models\Bag;
use App\Models\PostalCode;
use Livewire\Component;

class ManageBag extends Component
{
    public $bags;
    public $postalCodes;
    public $query = [
        'from_postal_code' => null,
        'to_postal_code' => null,
        'date' => null,
    ];

    public function mount()
    {
        $this->bags = Bag::all();
        $this->postalCodes = PostalCode::all();

    }

    public function onClickShowPackages(string $bag_id)
    {
        $this->dispatch('show-packages', bag_id: $bag_id)->to('bag.show-packages');

    }

    public function onClickSearchBags()
    {
        $from = $this->query['from_postal_code'] ?? null;
        $to = $this->query['to_postal_code'] ?? null;
        $date = $this->query['date'] ?? null;

        $this->bags = Bag::when($from, function($q, $from) {
                return $q->where('from_postal_code', $from);

            })->when($to, function($q, $to) {
                return $q->where('to_postal_code', $to);

            })->when($date, function($q, $date) {
                return $q->whereDate('created_at', $date);

            })->get();
    }

    public function render()
    {
        return view('livewire.bag.manage-bag');
    }
}

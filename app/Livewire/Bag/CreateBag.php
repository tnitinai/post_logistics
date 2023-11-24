<?php

namespace App\Livewire\Bag;

use App\Models\Bag;
use App\Models\PostalCode;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateBag extends Component
{

    public $postalCodes = [];
    public $postal = [];
    public Bag $bag;

    public function mount()
    {
        $this->postal['from_postal_code'] = Auth::user()->post_office_id;
        $this->postalCodes = PostalCode::all();
        $this->bag = new Bag();
    }

    public function onClickBagInfo()
    {
        $this->bag->from_postal_code = $this->postal['from_postal_code'];
        $this->bag->to_postal_code = $this->postal['to_postal_code'];

        $bagTag = Bag::GenerateBagTag(
            $this->bag->from_postal_code,
            $this->bag->to_postal_code
        );

        $this->bag->bag_id = $bagTag;

        $this->dispatch('bag-created', bag: $this->bag)->to('bag.show-available-packages');
    }

    public function render()
    {
        return view('livewire.bag.create-bag');
    }
}

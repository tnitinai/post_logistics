<?php

namespace App\Livewire\Bag;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Status;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;

class ShowAvailablePackages extends Component
{
    public $packages = [];
    public $bagTag;

    #[On('bag-created')]
    public function showPackages($bag)
    {
        $this->bagTag = $bag['bag_id'];
        $this->packages = Package::where('from_postal_code', $bag['from_postal_code'])
            ->whereHas('movements', function (Builder $q) {
                $q->where('status_id', 2);
            })->get();
        // $packages = Package::where('from_postal_code', $bag['from_postal_code'])
        //     ->whereHas('statuses', function(Builder $q) {
        //         $q->where('package_movement.status_id', 1);
        //     })
        //     ->get();

        // foreach ($packages as $package) {
        //     $this->packages = $package->statuses;
        // }

        // $packages->filter(function (Package $package) {
        //     // each Package
        //     $this->packages = $package->statuses->filter(function (Status $status) {
        //         return ($status->pivot->status_id > 0);
        //     });
        // });
        // $this->packages = $packages->statuses()->filter(function(Status $status) {
        //     return ($status->pivot->detail);
        // });
        dd($this->packages);
    }

    public function render()
    {
        return view('livewire.bag.show-available-packages');
    }
}

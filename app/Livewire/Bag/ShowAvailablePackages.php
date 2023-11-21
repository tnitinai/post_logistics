<?php

namespace App\Livewire\Bag;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Status;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\MovementTrait;

class ShowAvailablePackages extends Component
{
    use MovementTrait;

    public $packages = [];
    public $selectedPackages = [];
    public $bagTag;
    public $destination;

    #[On('bag-created')]
    public function showPackages($bag)
    {
        $this->bagTag = $bag['bag_id'];
        $this->destination = $bag['to_postal_code'];

        $this->packages = Package::where('from_postal_code', $bag['from_postal_code'])
            ->where('current_status', 1)->get();

        // $this->selectedPackages = [$this->packages->first()->tracking_number];
        /*
        $this->packages = Package::where('from_postal_code', $bag['from_postal_code'])
            ->whereHas('movements', function (Builder $q) {
                $q->where('status_id', 2);
            })->get();
        */
    }

    public function saveBag()
    {
        DB::transaction(function(){
            //create Bag
            $bag = Bag::create(['bag_id' => $this->bagTag, 'to_postal_code' => $this->destination]);

            foreach ($this->selectedPackages as  $package_id) {
                $package = Package::find($package_id);

                //update bag's packages
                $package->update(['bag_id' => $bag->bag_id, 'current_status' => 2]);

                // add package movement
                $this->appendMovementLog($package, 2, $bag->bag_id);
            }
        });

        session()->flash('status', [
            'type' => 'success',
            'message' => 'บันทึกข้อมูลถุงไปรษณ๊ย์สำเร็จ'
        ]);

        $this->redirect('bag');
    }

    public function render()
    {
        return view('livewire.bag.show-available-packages');
    }
}

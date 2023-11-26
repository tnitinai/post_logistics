<?php

namespace App\Livewire\Distribution;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Bag;
use App\Models\Package;
use App\Models\PostalCode;
use App\Models\Transportation;
use App\Models\User;
use App\Traits\MovementTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IndexDistribution extends Component
{
    use MovementTrait;

    public $packages;
    public $bags;
    public $transportations;
    public $postalCodes;
    public $postmen;
    public $post_office;
    public $postman_id;
    public $selectedPackages = [];

    public function mount()
    {
        $this->postalCodes = PostalCode::all();
        $this->post_office = Auth::user()->post_office_id;

        // packages ที่มีปลายทางเดียวกับต้นทางและตรงกับที่ทำการของ user AND current_status in 1,9
        $this->packages = Package::where('to_postal_code', $this->post_office)->whereIn('current_status', [1, 9])->get();

        $this->postmen = User::where('post_office_id', $this->post_office)->where('role_id', 4)->get();;
        /*
        // bags ที่มีสถานะ ถึงที่ทำการปลายทาง
        $this->bags = Bag::whereHas('transport', function(Builder $query) {
            $query->whereNotNull('finish_driving');
        })->get();
        */
    }

    public function searchPackages()
    {
        $this->packages = Package::where('to_postal_code', $this->post_office)->whereIn('current_status', [1, 9])->get();

    }

    public function updatedPostOffice($postal_code) {
        return $this->postmen = User::where('post_office_id', $postal_code)->where('role_id', 4)->get();
    }

    public function store()
    {
        //update delivery_id in Packages
        Package::findMany($this->selectedPackages)->each(function(Package $package){
            $package->update(['delivery_id' => $this->postman_id]);
            $this->appendMovementLog($package, 11, $this->postman_id, null,$package->to_postal_code,$package->to_postal_code );
        });

        session()->flash('status', [
            'type' => 'success',
            'message' => 'จ่ายงานให้บุรุษไปรษณีย์สำเร็จ'
        ]);
        $this->redirect('distribution');

    }

    public function render()
    {
        return view('livewire.distribution.index-distribution');
    }
}

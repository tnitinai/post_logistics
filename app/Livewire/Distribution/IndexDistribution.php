<?php

namespace App\Livewire\Distribution;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Bag;
use App\Models\Package;
use App\Models\PostalCode;
use App\Models\Transportation;
use App\Models\User;
use Livewire\Component;

class IndexDistribution extends Component
{
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
        $this->postmen = [];
        $this->bags = Bag::whereHas('transport', function(Builder $query) {
            $query->whereNotNull('finish_driving');
        })->get();
    }

    public function searchPackages()
    {
        $this->bags = Bag::whereHas('packages', function(Builder $q) {
            $q->where('to_postal_code', $this->post_office);
        })->get();
    }

    public function updatedPostOffice($postal_code) {
        return $this->postmen = User::where('post_office_id', $postal_code)->where('role_id', 4)->get();
    }

    public function store()
    {
        //update postman_id in Packages
        Package::findMany($this->selectedPackages)->each(function(Package $package){
            $package->update(['postman_id' => $this->postman_id]);
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

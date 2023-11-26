<?php

namespace App\Livewire\Distribution;

use App\Models\Bag;
use App\Models\PostalCode;
use App\Traits\MovementTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UnpackPackage extends Component
{
    use MovementTrait;

    public $postalCodes;
    public $postal;
    public $bags;

    public function mount()
    {
        $this->postalCodes = PostalCode::all();
        $this->bags = [];
        $this->postal = Auth::user()->post_office_id;
    }

    public function onClickSearchBags() {
        //search bag where dst is the same as current user' location AND finish_driving is not null
        $this->bags = Bag::where('to_postal_code', $this->postal)
                ->whereHas('transport', function(Builder $q) {
                    $q->whereNotNull('finish_driving');
                })
                ->whereHas('packages', function(Builder $q) {
                    $q->whereIn('current_status', [4,7,9]);
                })
            ->get();

    }

    public function onClickUnpacking(Bag $bag)
    {
        //update status to คัดแยกและบรรจุถุง
        DB::transaction(function() use ($bag){
            $this->recordUppackingBag($bag, 5, null, $bag->from_postal_code, $bag->to_postal_code);
        });
        session()->flash('status', [
            'type' => 'success',
            'message' => 'เปิดถุงไปรษณ๊ย์สำเร็จ'
        ]);

        $this->redirect('unpack');
    }

    public function render()
    {
        return view('livewire.distribution.unpack-package');
    }
}

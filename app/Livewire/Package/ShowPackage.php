<?php

namespace App\Livewire\Package;

use App\Models\Package;
use App\Models\PostalCode;
use App\Models\Transportation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShowPackage extends Component
{
    public $transportations;
    public $packages;
    public $postalCodes;
    public $query = [
        'from_postal_code' => null,
        'to_postal_code' => null,
        'date' => null,
    ];

    public function mount()
    {
        $this->postalCodes = PostalCode::all();
        $this->query['from_postal_code'] = Auth::user()->post_office_id;
        $this->query['date'] = Carbon::today()->toDateString();
        $this->packages = Package::where('from_postal_code', $this->query['from_postal_code'])
            ->whereDate('created_at', $this->query['date'])->get();
    }

    public function onClickSearchPackages()
    {
        $from = $this->query['from_postal_code'] ?? null;
        $to = $this->query['to_postal_code'] ?? null;
        $date = $this->query['date'] ?? null;

        $this->packages = Package::when($from, function($q, $from) {
                return $q->where('from_postal_code', $from);

            })->when($to, function($q, $to) {
                return $q->where('to_postal_code', $to);

            })->when($date, function($q, $date) {
                return $q->whereDate('created_at', $date);
                
            })->get();
    }

    public function render()
    {
        return view('livewire.package.show-package');
    }
}

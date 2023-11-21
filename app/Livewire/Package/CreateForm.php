<?php

namespace App\Livewire\Package;

use App\Models\Invoice;
use Livewire\Component;

use App\Models\Sender;
use App\Models\Package;
use App\Models\PostalCode;
use App\Traits\MovementTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreateForm extends Component
{
    use MovementTrait;

    public $package = [];
    public $packages = [];
    public $senders;
    public $sender = [];
    public $postalCodes;

    public function mount()
    {
        $this->senders = Sender::all();
        $this->postalCodes = PostalCode::all();
    }

    public function onClickAddedItem()
    {
        // append postal location to package
        $postal_loc = PostalCode::findOrFail($this->package['to_postal_code'])->postal_location;
        $this->package['postal_location'] = $postal_loc;
        array_push($this->packages, $this->package);
    }

    public function updatedPackageWeight()
    {
        $this->package['price'] = Package::calculateServiceFee($this->package['weight']);
    }

    public function save()
    {

        $result = null;
        // sum price in packages
        $total_price = array_sum(array_map(fn ($package) => $package['price'], $this->packages));
        DB::transaction(function () use ($total_price, &$result) {

            // create invoice
            $invoice_id = Invoice::generateInvoice($total_price);

            // create packages
            foreach ($this->packages as $package) {
                // generate tracking_number
                $tracking_nb = Carbon::now()->format('ymd') . rand(1000000, 9999999) . "TH";

                // append other attributes to package
                $package['tracking_number'] = $tracking_nb;
                $package['sender_id'] = $this->sender['sender_id'];
                $package['invoice_id'] = $invoice_id;
                $package['from_postal_code'] = $this->sender['from_postal_code'];
                $package['current_status'] = 1;

                // save to database
                $newPackage = Package::create($package);
                $this->appendMovementLog($newPackage, 1, $invoice_id);
            }

            $result = $invoice_id;
        });

        if ($result) {
            session()->flash('status', ['type' => 'success', 'message' => 'บันทึกข้อมูลพัสดุสำเร็จ']);
            $this->redirect('receipt/' . $result);
        }
    }

    public function render()
    {
        return view('livewire.package.create-form');
    }
}

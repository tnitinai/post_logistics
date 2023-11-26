<?php

namespace App\Livewire\Package;

use App\Models\Invoice;
use Livewire\Component;

use Livewire\Attributes\Validate;
use App\Models\Package;
use App\Models\PostalCode;
use App\Traits\MovementTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateForm extends Component
{
    use MovementTrait;
    public $package = [];
    public $packages = [];
    public $postalCodes;

    public function rules()
    {
        return [
            'package.sender_cid' => ['required','numeric','digits:13'],
            'package.sender_name' => ['required','max:60'],
            'package.from_postal_code' => ['required','digits:5'],
            'package.to_postal_code' => ['required','digits:5'],
            'package.receiver_name' => ['required','max:5'],
            'package.receiver_address' => ['required','max:255'],
            'package.receiver_telephone' => ['required','digits:10', 'numeric'],
            'package.weight' => ['required', 'numeric'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'package.sender_cid' => 'เลขประจำตัวประชาชน',
            'package.sender_name' => 'ชื่อผู้ส่ง',
            'package.from_postal_code' => 'รหัสไปรษณีย์ต้นทาง',
            'package.to_postal_code' => 'รหัสไปรษณีย์ปลายทาง',
            'package.receiver_name' => 'ชื่อผู้รับ',
            'package.receiver_address' => 'ที่อยู่จัดส่ง',
            'package.receiver_telephone' => 'เบอร์ติดต่อ',
            'package.weight' => 'นำหนัก',
        ];
    }

    public function mount()
    {
        $this->postalCodes = PostalCode::all();
        $this->package['from_postal_code'] = Auth::user()->post_office_id;
    }

    public function onClickAddedItem()
    {
        $this->validate();
        // append postal location to package
        $postal_loc = PostalCode::findOrFail($this->package['to_postal_code'])->postal_location;
        $this->package['postal_location'] = $postal_loc;
        array_push($this->packages, $this->package);
    }

    public function updatedPackageWeight()
    {
        $this->validateOnly('package.weight');
        $this->package['price'] = Package::calculateServiceFee($this->package['weight']);
    }

    public function save()
    {
        $this->validate();
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
                $package['sender_name'] = $this->package['sender_name'];
                $package['sender_cid'] = $this->package['sender_cid'];
                $package['invoice_id'] = $invoice_id;
                $package['from_postal_code'] = $this->package['from_postal_code'];
                $package['current_status'] = 1;

                // save to database
                $newPackage = Package::create($package);
                $this->appendMovementLog($newPackage, 1, $invoice_id,$this->package['from_postal_code'],$this->package['to_postal_code']);
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

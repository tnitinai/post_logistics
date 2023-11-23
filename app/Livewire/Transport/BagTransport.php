<?php

namespace App\Livewire\Transport;

use App\Models\Bag;
use App\Models\Package;
use App\Models\Status;
use App\Models\Transportation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\MovementTrait;
use Illuminate\Database\Eloquent\Builder;

class BagTransport extends Component
{
    use MovementTrait;

    public $transportation;
    public $availableBags;
    public $selectedBags = [];
    public $shownBagTransport = false;

    #[On('show-available-bags')]
    public function showAvailableBags($transportation)
    {
        $this->shownBagTransport = !$this->shownBagTransport;
        $this->transportation = $transportation;
        //newly created bags with no transportation
        $this->availableBags = Bag::whereDoesntHave('transport')->get();
        //dd($this->availableBags);


        // get bag id of each package
        $bagsIdInDestinationPackage = Package::where('current_status', 4)->select('bag_id')->get()->toArray();

        // find bags which package has status 4
        $bagsInDestinationPackage = Bag::whereIn('bag_id', $bagsIdInDestinationPackage)->get();
        // dd($bagsInDestinationPackage);
        $this->availableBags = $this->availableBags->merge($bagsInDestinationPackage);
    }

    public function saveBags()
    {
        // get bag id where status = 4 in each package
        $bagsIdInDestinationPackage = Package::whereIn('current_status', [4, 15])->select('bag_id')->get()->toArray();

        $tranport = Transportation::where('transportation_id', $this->transportation)->first();

        foreach ($this->selectedBags as $bag_id) {

            $latestStatus = Bag::where('bag_id', $bag_id)->first()->packages->random()->current_status;

            // ถ้าสถานะของพัสดุล่าสุดคือ พัสดุถึงศูนย์ฯ (status =4) ให้ปรับสถานะเป็น อยู่ระหว่างการขนส่งไปศูนย์ปลายทาง
            // ถ้าสถานะของพัสดุล่าสุดคือ ใส่พัสดุลงถุง (status =15) ให้ปรับสถานะเป็น อยู่ระหว่างการขนส่งไปที่ทำการปลายทาง
            // กรณีอื่นๆ ให้ปรับสถานะเป็น อยู่ระหว่างการขนส่งไปยังศูนย์ไปรษณีย์ต้นทาง
            if ($latestStatus === 4) {
                DB::transaction(function () use (&$result, $bag_id, $tranport) {
                    $result = null;
                    //foreach ($this->selectedBags as $bag) {
                    $bagBeAdded = Bag::where('bag_id', $bag_id)->first();
                    $added = $bagBeAdded->transport()->associate($tranport)->save();
                    $bagBeAdded->packages()->each(function (Package $package) use ($tranport) {
                        $this->appendMovementLog($package, 6, $tranport->transportation_id);
                    });

                    $result = $added ? true : false;
                    //}
                });
            } elseif ($latestStatus === 15) {
                DB::transaction(function () use (&$result, $bag_id, $tranport) {
                    $result = null;
                    //foreach ($this->selectedBags as $bag) {
                    $bagBeAdded = Bag::where('bag_id', $bag_id)->first();
                    $added = $bagBeAdded->transport()->associate($tranport)->save();
                    $bagBeAdded->packages()->each(function (Package $package) use ($tranport) {
                        $this->appendMovementLog($package, 8, $tranport->transportation_id);
                    });

                    $result = $added ? true : false;
                    //}
                });
            } else {
                // update package status to 3 and movement status to 3
                DB::transaction(function () use (&$result, $bag_id, $tranport) {
                    $result = null;
                    //foreach ($this->selectedBags as $bag) {
                    $bagBeAdded = Bag::where('bag_id', $bag_id)->first();
                    $added = $bagBeAdded->transport()->associate($tranport)->save();
                    $bagBeAdded->packages()->each(function (Package $package) use ($tranport) {
                        $this->appendMovementLog($package, 3, $tranport->transportation_id);
                    });

                    $result = $added ? true : false;
                    //}
                });
            }
            /*
            }

            if (in_array($bag_id, array_column($bagsIdInDestinationPackage, 'bag_id'))) {
                DB::transaction(function () use (&$result, $bag_id, $tranport) {
                    $result = null;
                    //foreach ($this->selectedBags as $bag) {
                    $bagBeAdded = Bag::where('bag_id', $bag_id)->first();
                    $added = $bagBeAdded->transport()->associate($tranport)->save();
                    $bagBeAdded->packages()->each(function (Package $package) use ($tranport) {
                        $package->update(['current_status'=> 6]);
                        $this->appendMovementLog($package, 6, $tranport->transportation_id);
                    });

                    $result = $added ? true : false;
                    //}
                });

            } else {

            }
            */
            //update packages' bag to status 6

            if ($result) {
                session()->flash('status', [
                    'type' => 'success',
                    'message' => 'บันทึกข้อมูลการบรรทุกถุงไปรษณีย์ลงยานพาหนะสำเร็จ'
                ]);
                $this->redirect('transportation');
            }
        }
    }

    public function render()
    {
        return view('livewire.transport.bag-transport');
    }
}

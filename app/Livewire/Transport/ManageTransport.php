<?php

namespace App\Livewire\Transport;

use App\Models\Bag;
use App\Models\Package;
use App\Models\PostalCode;
use App\Models\Transportation;
use Carbon\Carbon;
use Livewire\Component;
use App\Traits\MovementTrait;
use Illuminate\Support\Facades\Auth;

class ManageTransport extends Component
{
    use MovementTrait;

    public $transportations;
    public $postalCodes;
    public $query = [
        'from_postal_code' => null,
        'to_postal_code' => null,
        'date' => null,
    ];

    public $shownNewTransportation = false;

    public function mount()
    {
        $this->transportations = Transportation::where('from_post_office_code', Auth::user()->post_office_id)
            ->orWhere('to_post_office_code', Auth::user()->post_office_id)
            ->get();
        $this->postalCodes = PostalCode::all();
    }

    public function onClickDriving($transportation)
    {
        $trans = Transportation::where('transportation_id', $transportation)->first();

        if (is_null($trans->start_driving)) {
            $trans->update(['start_driving' => Carbon::now()]);
            session()->flash('status', [
                'type' => 'success',
                'message' => 'บันทึกข้อมูลการขนส่งยานพาหนะสำเร็จ'
            ]);
            return $this->redirect('transportation');
        }

        // ถ้า current_status ของ package = 3(ระหว่างขนส่งไปศูนย์ต้นทาง) ให้อัพเดทสถานะเป็น 4 เมื่อพัสดุถึงศูนย์ต้นทาง
        $packagesIntransit = $this->checkPackagesIntransit($trans, 3);
        if ($packagesIntransit) {
            $trans->update(['finish_driving' => Carbon::now()]);
            $this->recordMovementWhenReachDestination($trans, 4, $trans->from_postal_office_code, $trans->to_postal_office_code);
            session()->flash('status', [
                'type' => 'success',
                'message' => 'บันทึกข้อมูลการขนส่งยานพาหนะถึงศูนย์ไปรษณีย์ต้นทางสำเร็จ'
            ]);
            return $this->redirect('transportation');
        }

        // ถ้า current_status ของ package = 6(ระหว่างขนส่งไปศูนย์ปลายทาง) ให้อัพเดทสถานะเป็น 7 เมื่อพัสดุถึงศูนย์ปลายทาง
        $packagesIntransit = $this->checkPackagesIntransit($trans, 6);
        if ($packagesIntransit) {
            $trans->update(['finish_driving' => Carbon::now()]);
            $this->recordMovementWhenReachDestination($trans, 7, $trans->from_postal_office_code, $trans->to_postal_office_code);
            session()->flash('status', [
                'type' => 'success',
                'message' => 'บันทึกข้อมูลการขนส่งยานพาหนะถึงศูนย์ไปรษณีย์ปลายทางสำเร็จ'
            ]);
            return $this->redirect('transportation');
        }

        // ถ้า current_status ของ package = 8(ระหว่างขนส่งไปที่ทำการปลายทาง) ให้อัพเดทสถานะเป็น 9 เมื่อพัสดุถึงที่ทำการปลายทาง
        $packagesIntransit = $this->checkPackagesIntransit($trans, 8);
        if ($packagesIntransit) {
            $trans->update(['finish_driving' => Carbon::now()]);
            $this->recordMovementWhenReachDestination($trans, 9, $trans->from_postal_office_code, $trans->to_postal_office_code);
            session()->flash('status', [
                'type' => 'success',
                'message' => 'บันทึกข้อมูลการขนส่งยานพาหนะถึงที่ทำการปลายทางสำเร็จ'
            ]);
            return $this->redirect('transportation');
        }

        session()->flash('status', [
            'type' => 'warning',
            'message' => 'ไม่มีข้อมูลเปลี่ยนแปลง'
        ]);
        $this->redirect('transportation');
    }

    public function onClickSearchTransportations()
    {
        $from = $this->query['from_postal_code'] ?? null;
        $to = $this->query['to_postal_code'] ?? null;
        $date = $this->query['date'] ?? null;

        $this->transportations = Transportation::when($from, function($q, $from) {
                return $q->where('from_postal_office_code', $from);

            })->when($to, function($q, $to) {
                return $q->where('to_postal_office_code', $to);

            })->when($date, function($q, $date) {
                return $q->whereDate('created_at', $date);

            })->get();
    }

    public function render()
    {
        return view('livewire.transport.manage-transport');
    }

    private function checkPackagesIntransit(Transportation $trans, int $prev_status): bool
    {
        $isValid = [];
        foreach ($trans->bags as $bag) {
            foreach ($bag->packages as $package) {
                if ($package->current_status != $prev_status) {
                    $isValid[] = false;
                } else {
                    $isValid[] = true;
                }
            }
        }
        $isValid = collect($isValid);
        $packagesIntransit = $isValid->every(function ($item) {
            return $item === true;
        });

        return $packagesIntransit;
    }
}

<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>จัดการการขนส่ง</h5>
            <button type="button" class="btn btn-success" wire:click="$toggle('shownNewTransportation')">สร้างการขนส่งใหม่</button>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>หมายเลขการขนส่ง</td>
                                <td>หมายเลขทะเบียนรถ</td>
                                <td>ประเภทรถ</td>
                                <td>พนักงานขับ</td>
                                <td>สถานีต้นทาง</td>
                                <td>เวลาออกจากต้นทาง</td>
                                <td>สถานีปลายทาง</td>
                                <td>เวลาถึงปลายทาง</td>
                                <td>เครื่องมือ</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transportations as $transportation)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$transportation->transportation_id}}</td>
                                <td>{{$transportation->plate_number}}</td>
                                <td>{{$transportation->vehicle->vehicle_type}}</td>
                                <td>{{$transportation->driver->fullname}}</td>
                                <td>{{$transportation->sourcePostal->district}}</td>
                                <td>{{$transportation->start_driving}}</td>
                                <td>{{$transportation->destinationPostal->district}}</td>
                                <td>{{$transportation->end_driving}}</td>
                                <td>
                                    <div class="d-flex content-justify-center">
                                        <button class="btn btn-sm btn-warning mr-1" wire:click="$dispatchTo('transport.bag-transport', 'show-available-bags', { transportation: {{ $transportation->transportation_id }} })">เพิ่มถุงไปรษณีย์</button>
                                        <button class="btn btn-sm btn-success" wire:click="onClickFinishDriving('{{$transportation->transportation_id}}')" >บันทึกเวลาถึงปลายทาง</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        {{-- when click show available bags --}}
        <livewire:transport.bag-transport>

        </div>


        <div class="card-footer d-flex justify-content-center">
        </div>
    </div>

    @if ($shownNewTransportation)
        <livewire:transport.create-transport />
    @endif
</div>

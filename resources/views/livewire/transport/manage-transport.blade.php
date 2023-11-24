<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>จัดการการขนส่ง</h5>
            <button type="button" class="btn btn-success"
                wire:click="$toggle('shownNewTransportation')">สร้างการขนส่งใหม่</button>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transportation->transportation_id }}</td>
                                    <td>{{ $transportation->plate_number }}</td>
                                    <td>{{ $transportation->vehicle->vehicle_type }}</td>
                                    <td>{{ $transportation->driver->fullname }}</td>
                                    <td>{{ $transportation->sourcePostal->postal_location }}</td>
                                    <td>{{ $transportation->start_driving }}</td>
                                    <td>{{ $transportation->destinationPostal->postal_location }}</td>
                                    <td>{{ $transportation->finish_driving }}</td>
                                    <td>
                                        <div class="d-flex content-justify-center">
                                            @if (is_null($transportation->start_driving))
                                                <button class="btn btn-sm btn-warning mr-1"
                                                    wire:click="$dispatchTo('transport.bag-transport', 'show-available-bags', { transportation: '{{ $transportation->transportation_id }}' })">เพิ่มถุงไปรษณีย์</button>
                                            @endif
                                            <button class="btn btn-sm btn-info mr-1"
                                                wire:click="$dispatchTo('transport.bag-in-transport', 'show-bags', { transportation: '{{ $transportation->transportation_id }}' })">รายละเอียด</button>
                                            @if (is_null($transportation->start_driving))
                                                <button class="btn btn-sm btn-success"
                                                    wire:confirm="ต้องการบันทึกข้อมูลการขนส่งหรือไม่?"
                                                    wire:click="onClickDriving('{{ $transportation->transportation_id }}')">
                                                    บันทึกเวลาเริ่มเดินทาง
                                                </button>
                                            @elseif(is_null($transportation->finish_driving))
                                                <button class="btn btn-sm btn-success"
                                                    wire:confirm="ต้องการบันทึกข้อมูลการขนส่งหรือไม่?"
                                                    wire:click="onClickDriving('{{ $transportation->transportation_id }}')">
                                                    บันทึกเวลาถึงปลายทาง
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- when click show untransported bags --}}
            <livewire:transport.bag-transport>

                {{-- when click show transported bags --}}
                <livewire:transport.bag-in-transport>

        </div>

        <div class="card-footer d-flex justify-content-center">
        </div>
    </div>

    @if ($shownNewTransportation)
        <livewire:transport.create-transport />
    @endif
</div>

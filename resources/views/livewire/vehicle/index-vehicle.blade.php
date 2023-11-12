<div>
    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h5>จัดการข้อมูลยานพาหนะ</h5>
            <button class="btn btn-sm btn-success" wire:click="$toggle('shownCreateForm')">เพิ่มข้อมูลรถ</button>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ประเภทรถ</th>
                                <th>ทะเบียนรถ</th>
                                <th>หน่วยงานที่ดูแล</th>
                                <th>เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$vehicle->vehicle_type}}</td>
                                    <td>{{$vehicle->plate_number}}</td>
                                    <td>{{$vehicle->owner->district}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info">ประวัติการใช้งาน</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">

        </div>

    </div>

    @if ($shownCreateForm)
        <livewire:vehicle.create-vehicle />
    @endif
</div>

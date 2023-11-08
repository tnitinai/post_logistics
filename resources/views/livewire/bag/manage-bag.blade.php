<div class="card">
    <div class="card-header">
        <h5>จัดการถุงไปรษณีย์</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>หมายเลขถุง</th>
                            <th>สถานที่ปลายทาง</th>
                            <th>จำนวนพัสดุ</th>
                            <th>เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bags as $bag)
                        <tr>
                            <td>{{$bag->bag_id}}</td>
                            <td>{{$bag->postalCode->district}}</td>
                            <td>{{$bag->packages()->count()}}</td>
                            <td class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-info" wire:click="onClickShowPackages('{{$bag->bag_id}}')">รายการพัสดุ</button>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-body">
        <livewire:bag.show-packages />
    </div>

    <div class="card-footer">

    </div>
</div>

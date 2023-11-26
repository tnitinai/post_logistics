<div class="card">
    <div class="card-header">
        <h5>จัดการถุงไปรษณีย์</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <label for="query.from_postal_code" class="form-label">รหัสไปรษณีย์ต้นทาง</label>
                <select class="form-control" id="query.from_postal_code" wire:model.defer='query.from_postal_code'>
                    <option>-------------</option>
                    @foreach ($postalCodes as $postalCode)
                    <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <label for="query.to_postal_code" class="form-label">รหัสไปรษณีย์ปลายทาง</label>
                <select class="form-control" id="query.to_postal_code" wire:model.defer='query.to_postal_code'>
                    <option>-------------</option>
                    @foreach ($postalCodes as $postalCode)
                    <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <label for="query.date" class="form-label">วันที่รับเข้าระบบ</label>
                <input class="form-control" id="query.date" type="date" wire:model.defer='query.date' />
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12 d-flex justify-content-center">
                <button type="button" wire:click='onClickSearchBags' class="btn btn-success">ค้นหา</button>
            </div>
        </div>

        <hr>

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
                            <td>{{$bag->postalCode->postal_location}}</td>
                            <td>{{$bag->packages()->count()}}</td>
                            <td class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-info"
                                    wire:click="onClickShowPackages('{{$bag->bag_id}}')">รายการพัสดุ</button>
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

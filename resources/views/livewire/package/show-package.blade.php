<div>
    <div class="card">
        <div class="card-header">
            <h5>ข้อมูลพัสดุไปรษณีย์ทั้งหมด</h5>
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
                    <button type="button" wire:click='onClickSearchPackages' class="btn btn-success">ค้นหา</button>
                </div>
            </div>

            <hr>


            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>วันที่เข้าระบบ</th>
                            <th>Tracking</th>
                            <th>ต้นทาง</th>
                            <th>ปลายทาง</th>
                            <th>Bag</th>
                            <th>Transport</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr style="white-space: nowrap;">
                                <td>{{ $package->invoice->created_at }}</td>
                                <td>{{ $package->tracking_number }}</td>
                                <td>{{ $package->sourcePostalCode->postal_location }}</td>
                                <td>{{ $package->destinationPostalCode->postal_location }}</td>
                                <td>{{ $package->bag_id }}</td>
                                <td>{{ $package->bag ? $package->bag->transport_id : null }}</td>
                                <td>{{ $package->last_status }}</td>
                            </tr>
                        @endforeach
                        {{-- @foreach ($transportations as $trans)
                            @foreach ($trans->bags as $bag)
                                @foreach ($bag->packages as $package)
                                    <tr>
                                        <td>{{ $package->tracking_number }}</td>
                                        <td>{{ $package->sourcePostalCode->district }}</td>
                                        <td>{{ $package->destinationPostalCode->district }}</td>
                                        <td>{{ $trans->transportation_id }}</td>
                                        <td>{{ $bag->bag_id }}</td>
                                        <td>{{ $package->last_status }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

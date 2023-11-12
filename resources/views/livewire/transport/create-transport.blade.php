<div class="card mt-2">

    <form wire:submit='saveTransportation'>
    <div class="card-header">
        <h5>เพิ่มข้อมูลการขนส่ง</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <label for="transport.from_post_office_code" class="form-label">รหัสไปรษณีย์ต้นทาง</label>
                <select class="form-control" id="transport.from_post_office_code"
                    wire:model.defer='transport.from_post_office_code'>
                    <option>-------------</option>
                    @foreach ($postalCodes as $postalCode)
                        <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6">
                <label for="transport.to_post_office_code" class="form-label">รหัสไปรษณีย์ปลายทาง</label>
                <select class="form-control" id="transport.to_post_office_code"
                    wire:model.defer='transport.to_post_office_code'>
                    <option>-------------</option>
                    @foreach ($postalCodes as $postalCode)
                        <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 d-flex justify-content-center">
                <button class="btn btn-sm btn-success" type="button" wire:click='onClickNext'>ถัดไป</button>
            </div>
        </div>

        @isset($transport['transportation_id'])
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h4>รายละเอียดหมายเลขการขนส่ง {{ $transport['transportation_id'] }}</h4>
                </div>
                <div class="col-lg-4">
                    <label for="transport.vehicle_type" class="form-label">ประเภทยานพาหนะ</label>
                    <select class="form-control" id="transport.vehicle_type" wire:model.change='transport.vehicle_type'>
                        <option>-------------</option>
                        @foreach ($vehicleTypes as $idx => $type)
                            <option value="{{ $idx }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="transport.plate_number" class="form-label">หมายเลขยานพาหนะ</label>
                    <select class="form-control" id="transport.plate_number" wire:model.defer='transport.plate_number'>
                        <option>-------------</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->plate_number }}">{{ $vehicle->plate_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="transport.driver_id" class="form-label">ผู้ขับยานพาหนะ</label>
                    <select class="form-control" id="transport.driver_id" wire:model.defer='transport.driver_id'>
                        <option>-------------</option>
                        @foreach ($drivers as $driver)
                            <option value={{ $driver->id }}>{{ $driver->fullname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        @endisset
    </div>

    <div class="card-footer">
        @isset($transport['transportation_id'])
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
        @endisset
    </div>
    </form>
</div>

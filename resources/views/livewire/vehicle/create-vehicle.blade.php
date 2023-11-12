<div class="card mt-3">
    <form wire:submit='saveVehicle'>
        <div class="card-header">
            <h5>เพิ่มข้อมูลยานพาหนะ</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="vehicle.plate_number" class="form-label">หมายเลขทะเบียนรถ</label>
                        <input type="text" wire:model.defer='vehicle.plate_number' class="form-control"
                            id="vehicle.plate_number" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="vehicle.vehicle_type" class="form-label">ประเภทรถ</label>
                        <select class="form-control" id="vehicle.vehicle_type" wire:model.defer='vehicle.vehicle_type' >
                            <option value=null>--------</option>
                            @foreach ($vehicleTypes as $idx => $type)
                                <option value={{ $idx }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="vehicle.post_office_owner" class="form-label">หน่วยงานที่ดูแล</label>
                        <select class="form-control" id="vehicle.post_office_owner"
                            wire:model.defer='vehicle.post_office_owner' >
                            <option value=null>--------</option>
                            @foreach ($postalCodes as $postalCode)
                                <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </div>
    </form>
</div>

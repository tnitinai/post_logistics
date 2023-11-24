<div>
    <div class="row">
        <div class="col-lg-6">
            <label for="postal.from_postal_code" class="form-label">รหัสไปรษณีย์ต้นทาง</label>
            <select class="form-control" id="postal.from_postal_code" wire:model.defer='postal.from_postal_code' @cannot('admin') disabled @endcannot>
                <option>-------------</option>
                @foreach ($postalCodes as $postalCode)
                    <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6">
            <label for="postal.to_postal_code" class="form-label">รหัสไปรษณีย์ปลายทาง</label>
            <select class="form-control" id="postal.to_postal_code" wire:model.defer='postal.to_postal_code'>
                <option>-------------</option>
                @foreach ($postalCodes as $postalCode)
                    <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 d-flex justify-content-center">
            <button class="btn btn-sm btn-success" type="button" wire:click='onClickBagInfo'>สร้างถุงไปรษณีย์</button>
        </div>
    </div>
</div>

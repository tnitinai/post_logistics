<div>
    <div class="card">
        <div class="card-header">
            <h5>คัดแยกถุงไปรษณีย์</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <label for="postal" class="form-label">รหัสไปรษณีย์ปัจจุบัน</label>
                    <select class="form-control" id="postal" wire:model.defer='postal' @cannot('admin') disabled @endcannot>
                        <option>-------------</option>
                        @foreach ($postalCodes as $postalCode)
                        <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12 d-flex justify-content-center">
                    <button class="btn btn-sm btn-success" type="button"
                        wire:click='onClickSearchBags'>ค้นหาถุงไปรษณีย์</button>
                </div>
            </div>
        </div>
    </div>

    @if ($bags)


    <div class="card mt-3">
        <div class="card-header">
            <h5>ข้อมูลถุงไปรษณีย์ที่รอคัดแยก</h5>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>หมายเลขถุง</th>
                            <th>ต้นทาง</th>
                            <th>ปลายทาง</th>
                            <th>เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bags as $bag)
                        <tr>
                            <td>{{$bag->bag_id}}</td>
                            <td>{{$bag->from_postal_code}}</td>
                            <td>{{$bag->postalCode->postal_location}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button wire:click="onClickUnpacking('{{$bag->bag_id}}')" wire:confirm='คุณต้องการเปิดถุงไปรษณีย์เพื่อคัดแยกที่นี่หรือไม่' type="button" class="btn btn-sm btn-success">เปิดถุงไปรษณีย์</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

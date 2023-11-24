<div class="card">
    <form wire:submit="save">
        <h5 class="card-header">บันทึกข้อมูลรับพัสดุ</h5>
        <div class="card-body">
            <h5>ข้อมูลผู้ส่ง</h5>
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="sender.sender_id" class="form-label">ชื่อผู้ส่ง</label>
                        <select class="form-control" id="sender.sender_id" wire:model.defer='sender.sender_id'>
                            <option>-----</option>
                            @foreach ($senders as $sender)
                                <option value={{ $sender->citizen_id }}>{{ $sender->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="citizen_id" class="form-label">เลขประจำตัวประชาชน</label>
                        <input type="text" class="form-control" id="citizen_id">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="sender.from_postal_code" class="form-label">รหัสไปรษณีย์ต้นทาง</label>
                        <select class="form-control" id="sender.from_postal_code" wire:model.defer='sender.from_postal_code' @cannot('admin') disabled @endcannot>
                            @foreach ($postalCodes as $postalCode)
                                <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <h5>บันทึกรายละเอียดพัสดุ</h5>
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="receiver_name" class="form-label">ชื่อผู้รับ</label>
                        <input type="text" wire:model.defer='package.receiver_name' class="form-control"
                            id="receiver_name">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="receiver_address" class="form-label">ที่อยู่จัดส่ง</label>
                        <input type="text" wire:model.defer='package.receiver_address' class="form-control"
                            id="receiver_address">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="receiver_telephone" class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" wire:model.defer='package.receiver_telephone' class="form-control"
                            id="receiver_telephone">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="weight" class="form-label">น้ำหนักพัสดุ (kg)</label>
                        <input type="text" wire:model.lazy='package.weight' class="form-control" id="weight">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="price" class="form-label">ราคาพัสดุ</label>
                        <input type="text" wire:model.defer='package.price' class="form-control" id="price" readonly>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="package.to_postal_code" class="form-label">รหัสไปรษณีย์ปลายทาง</label>
                        <select class="form-control" id="package.to_postal_code"
                            wire:model.defer='package.to_postal_code'>
                            @foreach ($postalCodes as $postalCode)
                                <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-end">
                    <div class="mb-3">
                        <button type="button" wire:click='onClickAddedItem'
                            class="btn btn-sm btn-success">บันทึกข้อมูลพัสดุ</button>
                    </div>
                </div>
            </div>

            @if ($packages)
                <hr>
                <h5>สรุปข้อมูล</h5>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table-sm table">
                            <thead>
                                <tr>
                                    <td>รายการที่</td>
                                    <td>ชื่อผู้รับ</td>
                                    <td>ที่อยู่จัดส่ง</td>
                                    <td>เบอร์ติดต่อ</td>
                                    <td>น้ำหนัก</td>
                                    <td>ราคา</td>
                                    <td>รหัสไปรษณีย์ปลายทาง</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package['receiver_name'] }}</td>
                                        <td>{{ $package['receiver_address'] }}</td>
                                        <td>{{ $package['receiver_telephone'] }}</td>
                                        <td>{{ $package['weight'] }}</td>
                                        <td>{{ $package['price'] }}</td>
                                        <td>{{ $package['postal_location'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer d-flex justify-content-center">
            @if ($packages)
                <button type="submit" class="btn btn-success">บันทึกและออกใบเสร็จ</button>
            @endif
        </div>
    </form>
</div>

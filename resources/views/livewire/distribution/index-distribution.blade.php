<div>
    <div class="card">
        <form wire:submit.prevent='store'>
            <div class="card-header">
                <h5>{{ _('เตรียมการนำจ่าย') }}</h5>
            </div>

            <div class="card-body">
                <label for="post_office" class="form-label">รหัสไปรษณีย์และบุรุษไปรษณีย์</label>
                <div class="input-group mb-3">
                    <select class="form-control" id="post_office" wire:model.live='post_office'>
                        <option>-------------</option>
                        @foreach ($postalCodes as $postalCode)
                            <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                        @endforeach
                    </select>
                    <select class="form-control" id="postman_id" wire:model.defer='postman_id'>
                        <option>เลือกบุรุษไปรษณีย์</option>
                        @foreach ($postmen as $postman)
                            <option value={{ $postman->id }}>{{ $postman->full_name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" wire:click='searchPackages'>เลือก</button>
                    </div>
                </div>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>หมายเลขถุง</th>
                            <th>#</th>
                            <th>หมายเลขพัสดุ</th>
                            <th>ชื่อผู้รับ</th>
                            <th>ที่อยู่</th>
                            <th>เบอร์ติดต่อ</th>
                            <th>บุรุษไปรษณีย์</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bags as $bag)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bag->bag_id }}</td>
                                <td colspan="6"></td>
                            </tr>
                            @foreach ($bag->packages as $package)
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.live="selectedPackages" id="selectedPackages"
                                                value={{ $package->tracking_number }}>
                                        </div>
                                    </td>
                                    <td>{{ $package->tracking_number }}</td>
                                    <td>{{ $package->receiver_name }}</td>
                                    <td>{{ $package->receiver_address }}</td>
                                    <td>{{ $package->receiver_telephone }}</td>
                                    <td>{{ $package->postman ? $package->postman->full_name : null }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>

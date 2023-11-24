<div class="card">
    <div class="card-header">บันทึกการนำจ่าย</div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <label for="post_office" class="form-label">บุรุษไปรษณีย์</label>
                <div class="input-group mb-3">
                    <select class="form-control" id="postman_id" wire:model.defer='postman_id'
                        @cannot('admin') disabled @endcannot>
                        <option>เลือกบุรุษไปรษณีย์</option>
                        @foreach ($postmen as $postman)
                            <option value={{ $postman->id }}>{{ $postman->full_name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" wire:click='searchPackages'>เลือก</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>หมายเลขพัสดุ</th>
                                <th>ชื่อผู้รับ</th>
                                <th>ที่อยู่</th>
                                <th>เบอร์ติดต่อ</th>
                                <th>สถานะ</th>
                                <th>เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $package->tracking_number }}</td>
                                    <td>{{ $package->receiver_name }}</td>
                                    <td>{{ $package->receiver_address }}</td>
                                    <td>{{ $package->receiver_telephone }}</td>
                                    <td>{{ $package->last_status }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if ($package->current_status === 13)
                                                <i class="fas fa-check-circle text-success"></i>
                                            @elseif($package->current_status === 14)
                                                <i class="fas fa-check-circle text-danger"></i>
                                            @else
                                                <button wire:click="onClickSuccess('{{ $package->tracking_number }}')"
                                                    wire:confirm='บันทึกนำจ่ายสำเร็จ ยืนยันหรือไม่'
                                                    class="btn btn-sm btn-success mr-1">สำเร็จ</button>
                                                <button wire:click="onClickFailure('{{ $package->tracking_number }}')"
                                                    wire:confirm='บันทึกนำจ่ายไม่สำเร็จ ยืนยันหรือไม่'
                                                    class="btn btn-sm btn-danger">ไม่สำเร็จ</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer"></div>
</div>

<div>
    <form wire:submit='saveBag'>
        @if ($packages && count($packages))
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h3>รายละเอียดพัสดุในถุงไปรษณีย์ หมายเลข {{ $bagTag }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table-sm table table-bordered">
                        <thead>
                            <tr>
                                <td>เลือกบรรจุ</td>
                                <td>รายการที่</td>
                                <td>เลขพัสดุ</td>
                                <td>น้ำหนัก</td>
                                <td>รหัสต้นทาง</td>
                                <td>รหัสปลายทาง</td>
                                <td>ชื่อที่ทำการปลายทาง</td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($packages as $package)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model.live="selectedPackages"
                                                id="selectedPackages" value={{ $package->tracking_number }}>
                                            {{-- <label class="form-check-label" for="selectedPackages">
                                          {{}}
                                        </label> --}}
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $package->tracking_number }}</td>
                                    <td>{{ $package->weight }}</td>
                                    <td>{{ $package->from_postal_code }}</td>
                                    <td>{{ $package->to_postal_code }}</td>
                                    <td>{{ $package->destinationPostalCode->district }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif ($packages && !count($packages))
            <div class="alert alert-danger mt-3">ไม่พบข้อมูลการค้นหา</div>
        @endif

        @if (count($selectedPackages))
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">บันทึกการบรรจุ</button>
                </div>
            </div>
        @endif
    </form>
</div>

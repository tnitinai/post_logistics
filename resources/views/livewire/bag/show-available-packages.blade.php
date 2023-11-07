<div>
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

</div>

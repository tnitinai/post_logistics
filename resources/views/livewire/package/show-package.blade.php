<div>
    <div class="card">
        <div class="card-header">
            <h5>ข้อมูลพัสดุไปรษณีย์ทั้งหมด</h5>
        </div>
        <div class="card-body">
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

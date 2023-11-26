<div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <h4>ข้อมูลพัสดุในถุงไปรษณีย์ หมายเลข {{$bagTag}}</h4>
        </div>
        <div class="col-lg-12 table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tracking No.</th>
                        <th>Destination</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$package->tracking_number}}</td>
                        <td>{{$package->destinationPostalCode->postal_location}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

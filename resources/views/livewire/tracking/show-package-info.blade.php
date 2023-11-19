<div class="card">
    <div class="card-header">
        <h4>รายละเอียดการขนส่ง {{$tracking}}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>สถานที่</th>
                    <th>สถานะ</th>
                    <th>เมื่อ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movements as $movement)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{__('location')}}</td>
                        <td>{{$movement->name}}</td>
                        <td>{{$movement->pivot->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
    <div class="card-footer"></div>
</div>

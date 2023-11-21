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
                    <th>ต้นทาง</th>
                    <th>ปลายทาง</th>
                    <th>สถานะ</th>
                    <th>เมื่อ</th>
                    <th>รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movements as $movement)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$movement->pivot->src_postal}}</td>
                        <td>{{$movement->pivot->dst_postal}}</td>
                        <td>{{$movement->name}}</td>
                        <td>{{$movement->pivot->created_at}}</td>
                        <td>
                            @switch($movement->status_id)
                                @case(1)

                                    @break
                                @case(2)
                                    หมายเลขถุง {{$movement->pivot->detail}}
                                    @break
                                @case(3)
                                    หมายเลขการขนส่ง {{$movement->pivot->detail}}
                                    @break
                                @case(4)
                                    หมายเลขการขนส่ง {{$movement->pivot->detail}}
                                    @break
                                @case(6)
                                    หมายเลขถุง {{$movement->pivot->detail}}
                                    @break
                                @default

                            @endswitch
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
    <div class="card-footer"></div>
</div>

<div class="card">
    <div class="card-header">
        <h4>รายละเอียดการขนส่ง {{$tracking}}</h4>
    </div>
    <div class="card-body">
        @if ($movements)
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
                            @case(5)
                            หมายเลขถุง {{$movement->pivot->detail}}
                            @break
                            @case(6)
                            หมายเลขถุง {{$movement->pivot->detail}}
                            @break
                            @case(8)
                            หมายเลขการขนส่ง {{$movement->pivot->detail}}
                            @break
                            @case(9)
                            หมายเลขการขนส่ง {{$movement->pivot->detail}}
                            @break
                            @case(11)
                            ผู้นำจ่าย {{$movement->pivot->detail}}
                            @break
                            @case(15)
                            หมายเลขถุง {{$movement->pivot->detail}}
                            @break
                            @default

                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </div>
        </table>
        @else
        <h3 class="text-danger">ไม่พบหมายเลขพัสดุในระบบ</h3>
        @endif


    </div>
    <div class="card-footer"></div>
</div>

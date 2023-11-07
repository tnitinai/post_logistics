@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">บันทึกข้อมูลรับพัสดุ</h5>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="sender_id" class="form-label">ชื่อผู้ส่ง</label>
                            <select class="form-control" id="sender_id"></select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="sender_id" class="form-label">เลขประจำตัวประขาขน</label>
                            <input type="text" class="form-control" id="sender_id">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">รหัสไปรษณีย์ต้นทาง</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

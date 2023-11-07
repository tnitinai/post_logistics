<div class="card">
    <div class="card-header">
        <h5>ใบเสร็จรับเงิน {{ $invoice->invoice_id }}</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <h3>Postman Logistics Company Ltd,.</h3>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <h5>{{ $invoice->packages()->first()->sourcePostalCode->district }}</h5>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <h4>ใบรับเงิน</h4>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div>#created {{ $invoice->created_at }}</div>
                        <div>#invoice {{ $invoice->invoice_id }}</div>
                        <div>#user {{ $invoice->user->fname }}</div>
                    </div>
                </div>
                <hr>
                @foreach ($packages as $package)
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            Tracking# {{ $package->tracking_number }}
                        </div>
                        <div class="col-lg-12 d-flex justify-content-between">
                            <div>{{ $package->weight }} (Kg)</div>
                            <div>{{ $package->to_postal_code }} {{ $package->destinationPostalCode->district }}</div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-between">
                            <div>ชื่อผู้รับ {{ $package->receiver_name }}</div>
                            <div>฿ {{ $package->price }}</div>
                        </div>
                    </div>
                @endforeach
                <hr>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-between font-weight-bold">
                        <div>รวมทั้งสิ้น</div>
                        <div>฿ {{ $invoice->price }}</div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <h3>ขอบคุณที่ใช้บริการ</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success">สั่งพิมพ์</button>
        <a role="button" href={{ route('package') }} class="btn btn-danger ml-2">กลับหนักหลัก</a>
    </div>
</div>

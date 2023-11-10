<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>จัดการการขนส่ง</h5>
            <button type="button" class="btn btn-success" wire:click='onClickCreateTransport'>สร้างการขนส่งใหม่</button>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>หมายเลขการขนส่ง</td>
                                <td>หมายเลขทะเบียนรถ</td>
                                <td>ประเภทรถ</td>
                                <td>พนักงานขับ</td>
                                <td>สถานีต้นทาง</td>
                                <td>เวลาออกจากต้นทาง</td>
                                <td>สถานีปลายทาง</td>
                                <td>เวลาถึงปลายทาง</td>
                                <td>เครื่องมือ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>4323001T1202233321</td>
                                <td>A1234 BKK</td>
                                <td>รถบรรทุก 6 ล้อ</td>
                                <td>Andrew</td>
                                <td>90010</td>
                                <td>23:15</td>
                                <td>10020</td>
                                <td></td>
                                <td><button class="btn btn-sm btn-success">บันทึกเวลาถึงปลายทาง</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <div class="card-footer d-flex justify-content-center">
        </div>
    </div>

    @if ($shownTransportForm)
        <livewire:transport.create-transport />
    @endif
</div>

<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ค้นหาพัสดุของคุณ</h5>
            <p class="card-text">ติดตามพัสดุของคุณด้วยปลายนิ้ว</p>
                <div class="mb-3">
                    <label for="tracking" class="form-label">ระบุเลขพัสดุ</label>
                    <input type="text" class="form-control" id="tracking" style="font-size:22pt;height:70px;"
                        wire:model='tracking'>
                </div>
                <button type="button" class="btn btn-danger" wire:click="searchPackage">ค้นหา</button>
        </div>
    </div>
    @if ($tracking)
    <livewire:tracking.show-package-info :tracking='$tracking'>
    @endif
</div>

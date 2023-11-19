<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" wire:submit.prevent='searchPackage'>
    <div class="input-group">
        <input wire:model.defer='tracking_id' type="text" class="form-control bg-light border-0 small" placeholder="ติดตามพัสดุที่นี่"
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-danger" wire:click="searchPackage">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

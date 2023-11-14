<div>
    <div class="card">
        <div class="card-header">
            <h5>{{ _('เตรียมการนำจ่าย') }}</h5>
        </div>

        <div class="card-body">

            @foreach ($bags as $bag)
                <div class="font-weight-bold">{{ $bag->bag_id }}</div>
                @foreach ($bag->packages as $package)
                    <div class="font-weight-light">{{ $package->tracking_number }}</div>
                @endforeach
                <br>
            @endforeach
        </div>

        <div class="card-footer">

        </div>
    </div>
</div>

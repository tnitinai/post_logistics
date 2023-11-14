<div>
    @if ($shownBagInTransport)
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>หมายเลขถุง</th>
                                <th>สถานีปลายทาง</th>
                                <th>เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bags as $bag)
                                <tr>
                                    <td>{{ $bag->bag_id }}</td>
                                    <td>{{ $bag->postalCode->district }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            wire:click="removeBag('{{ $bag->bag_id }}')">นำออก</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

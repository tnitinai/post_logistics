<div>
    @if ($shownBagTransport)
    <form wire:submit='saveBags'>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>หมายเลขถุง</th>
                                <th>สถานีปลายทาง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($availableBags as $bag)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model.live="selectedBags"
                                                id="selectedBags" value={{ $bag->bag_id }}>
                                        </div>
                                    </td>
                                    <td>{{ $bag->bag_id }}</td>
                                    <td>{{ $bag->postalCode->district }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </div>
    </form>
    @endif
</div>

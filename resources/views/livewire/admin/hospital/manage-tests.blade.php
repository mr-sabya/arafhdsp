<div>
    @if($hospital)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); overflow-y: auto;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom p-3">
                    <h5 class="fw-bold mb-0">Manage Medical Tests: <span class="text-primary">{{ $hospital->name_bn }}</span></h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- SEARCH & ADD SECTION -->
                    <div class="card border-0 bg-light mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 position-relative">
                                    <label class="small fw-bold">Search Test (Blood, MRI, X-Ray...)</label>
                                    <input type="text" class="form-control form-control-sm shadow-none" placeholder="Search..." wire:model.live.debounce.300ms="search_test">

                                    @if(count($searchResults) > 0)
                                    <ul class="list-group position-absolute w-100 shadow z-3 mt-1">
                                        @foreach($searchResults as $res)
                                        <button wire:click="selectTest({{ $res->id }})" class="list-group-item list-group-item-action small py-2">
                                            {{ $res->name_bn }} ({{ $res->name_en }})
                                        </button>
                                        @endforeach
                                    </ul>
                                    @endif

                                    @if($selected_test)
                                    <div class="mt-2 p-2 border rounded bg-white d-flex justify-content-between align-items-center">
                                        <span class="small fw-bold text-success"><i class="ri-check-line"></i> {{ $selected_test->name_bn }}</span>
                                        <button wire:click="clearSelection" class="btn btn-sm p-0 text-danger"><i class="ri-close-circle-fill fs-5"></i></button>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold">Standard Price</label>
                                    <input type="number" class="form-control form-control-sm" wire:model="price">
                                </div>
                                <div class="col-md-2">
                                    <label class="small fw-bold">App Disc %</label>
                                    <input type="number" class="form-control form-control-sm" wire:model="discount_percent">
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button wire:click="addTest" class="btn btn-sm btn-primary w-100" @if(!$selected_test) disabled @endif><i class="ri-add-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ASSIGNED TESTS TABLE -->
                    <h6 class="fw-bold mb-3"><i class="ri-flask-line me-2"></i> Available Tests & Discounts</h6>
                    <div class="table-responsive border rounded">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light small fw-bold">
                                <tr>
                                    <th class="ps-3">Test Name</th>
                                    <th>Regular Price</th>
                                    <th>App Discount</th>
                                    <th>After Discount</th>
                                    <th class="text-end pe-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @forelse($hospital->tests as $test)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $test->name_bn }}</td>
                                    <td>{{ number_format($test->pivot->price) }} TK</td>
                                    <td><span class="badge bg-success">{{ $test->pivot->discount_percent }}% OFF</span></td>
                                    <td class="fw-bold text-primary">
                                        {{ number_format($test->pivot->price - ($test->pivot->price * $test->pivot->discount_percent / 100)) }} TK
                                    </td>
                                    <td class="text-end pe-3">
                                        <button wire:click="removeTest({{ $test->id }})" class="btn btn-sm text-danger border-0"><i class="ri-delete-bin-line"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No tests assigned yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
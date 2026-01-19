<div>
    @if($hospital)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); overflow-y: auto;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Assign Doctors to: <span class="text-success">{{ $hospital->name_bn }}</span></h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- ADVANCED SEARCH SECTION -->
                    <div class="card border-0 bg-light mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Find and Assign Doctor</h6>
                            <div class="row g-3">

                                <!-- Search Input -->
                                <div class="col-md-6 position-relative">
                                    <label class="small fw-bold">Search Doctor (Name/Specialty)</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white"><i class="ri-search-line"></i></span>
                                        <input type="text" class="form-control shadow-none"
                                            placeholder="Type name..."
                                            wire:model.live.debounce.300ms="search_doctor">
                                    </div>

                                    <!-- Search Results Dropdown -->
                                    @if(count($searchResults) > 0)
                                    <ul class="list-group position-absolute w-100 shadow-sm z-3 mt-1" style="max-height: 200px; overflow-y: auto;">
                                        @foreach($searchResults as $result)
                                        <button type="button" wire:click="selectDoctor({{ $result->id }})"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-bold small">{{ $result->name_bn }}</div>
                                                <div class="x-small text-muted">{{ $result->designation_bn }}</div>
                                            </div>
                                            <i class="ri-add-circle-line text-success fs-5"></i>
                                        </button>
                                        @endforeach
                                    </ul>
                                    @endif

                                    <!-- Selected Doctor Badge -->
                                    @if($selected_doctor)
                                    <div class="mt-2 p-2 border rounded bg-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-success mb-1">Selected</span>
                                            <div class="small fw-bold text-dark">{{ $selected_doctor->name_bn }}</div>
                                        </div>
                                        <!-- FIX: Changed from $set to clearSelection method -->
                                        <button type="button" wire:click="clearSelection" class="btn btn-sm btn-link text-danger p-0">
                                            <i class="ri-close-circle-fill fs-5"></i>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                                <!-- Fee & Discount -->
                                <div class="col-md-3">
                                    <label class="small fw-bold">Consultation Fee</label>
                                    <input type="number" class="form-control form-control-sm" wire:model="fee" placeholder="TK">
                                </div>
                                <div class="col-md-2">
                                    <label class="small fw-bold">Disc %</label>
                                    <input type="number" class="form-control form-control-sm" wire:model="discount_percent">
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-sm btn-success w-100" wire:click="addDoctor" @if(!$selected_doctor) disabled @endif>
                                        <i class="ri-check-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CURRENT LIST SECTION -->
                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="ri-user-follow-line me-2 text-primary"></i> Currently Assigned Doctors
                    </h6>
                    <div class="table-responsive rounded border">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr class="small text-uppercase">
                                    <th class="ps-3">Doctor</th>
                                    <th>Regular Fee</th>
                                    <th>Discount</th>
                                    <th>Patient Pays</th>
                                    <th class="text-end pe-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @forelse($hospital->doctors as $doctor)
                                <tr wire:key="assigned-{{ $doctor->id }}">
                                    <td class="ps-3">
                                        <div class="fw-bold text-dark">{{ $doctor->name_bn }}</div>
                                        <div class="x-small text-muted">{{ $doctor->designation_bn }}</div>
                                    </td>
                                    <td class="small">{{ number_format($doctor->pivot->fee) }} TK</td>
                                    <td><span class="badge bg-soft-info text-info">{{ $doctor->pivot->discount_percent }}% OFF</span></td>
                                    <td class="fw-bold text-success">
                                        {{ number_format($doctor->pivot->fee - ($doctor->pivot->fee * $doctor->pivot->discount_percent / 100)) }} TK
                                    </td>
                                    <td class="text-end pe-3">
                                        <button onclick="confirm('Remove this doctor?') || event.stopImmediatePropagation()"
                                            wire:click="removeDoctor({{ $doctor->id }})"
                                            class="btn btn-sm btn-outline-danger border-0">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted small">No doctors assigned to this location yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Close Manager</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
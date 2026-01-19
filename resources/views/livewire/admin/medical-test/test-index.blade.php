<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-success">Master Medical Tests</h5>
                    <div class="d-flex gap-2">
                        <!-- Filter by Category -->
                        <select class="form-select form-select-sm" style="width: 200px;" wire:model.live="filterCategory">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->display_name }}</option>
                            @endforeach
                        </select>

                        <input type="text" class="form-control form-control-sm" style="width: 200px;"
                            placeholder="Search Test..." wire:model.live.debounce.300ms="search">

                        <button wire:click="openModal" class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add Test
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Category</th>
                                    <th>Test Name (EN)</th>
                                    <th>Test Name (BN)</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tests as $test)
                                <tr wire:key="test-{{ $test->id }}">
                                    <td class="ps-4">
                                        <span class="badge bg-soft-primary text-primary px-3">{{ $test->category->display_name }}</span>
                                    </td>
                                    <td class="fw-bold">{{ $test->name_en }}</td>
                                    <td>{{ $test->name_bn }}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                wire:click="toggleStatus({{ $test->id }})"
                                                {{ $test->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button wire:click="edit({{ $test->id }})" class="btn btn-sm btn-outline-info border-0"><i class="ri-edit-line"></i></button>
                                        <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $test->id }})" class="btn btn-sm btn-outline-danger border-0"><i class="ri-delete-bin-line"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No medical tests found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    {{ $tests->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Test Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success py-3">
                    <h5 class="fw-bold mb-0 text-white">{{ $isEditMode ? 'Edit Medical Test' : 'New Medical Test' }}</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Select Category</label>
                            <select class="form-select" wire:model="medical_test_category_id">
                                <option value="">-- Choose Category --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->display_name }}</option>
                                @endforeach
                            </select>
                            @error('medical_test_category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Test Name (English)</label>
                            <input type="text" class="form-control" wire:model="name_en" placeholder="e.g. Complete Blood Count (CBC)">
                            @error('name_en') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Test Name (Bangla)</label>
                            <input type="text" class="form-control" wire:model="name_bn" placeholder="যেমন: সিবিসি পরীক্ষা">
                            @error('name_bn') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Status</label>
                            <select class="form-select" wire:model="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="modal-footer px-0 pb-0 mt-3 border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                {{ $isEditMode ? 'Update Test' : 'Save Test' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
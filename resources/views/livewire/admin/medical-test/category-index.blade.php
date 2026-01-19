<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">Test Categories</h5>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control form-control-sm" style="width: 200px;"
                            placeholder="Search..." wire:model.live.debounce.300ms="search">
                        <button wire:click="openModal" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add Category
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Sort</th>
                                    <th>Name (English)</th>
                                    <th>Name (Bangla)</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr wire:key="cat-{{ $category->id }}">
                                    <td class="ps-4">#{{ $category->sort_order }}</td>
                                    <td class="fw-bold">{{ $category->name_en }}</td>
                                    <td>{{ $category->name_bn }}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                wire:click="toggleStatus({{ $category->id }})"
                                                {{ $category->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-outline-info border-0"><i class="ri-edit-line"></i></button>
                                        <button onclick="confirm('Delete this category and all its tests?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $category->id }})" class="btn btn-sm btn-outline-danger border-0"><i class="ri-delete-bin-line"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No categories found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary p-3">
                    <h5 class="fw-bold mb-0 text-white">{{ $isEditMode ? 'Edit Category' : 'New Category' }}</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Name (English)</label>
                            <input type="text" class="form-control" wire:model="name_en" placeholder="e.g. Pathology">
                            @error('name_en') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Name (Bangla)</label>
                            <input type="text" class="form-control" wire:model="name_bn" placeholder="যেমন: প্যাথলজি">
                            @error('name_bn') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer px-0 pb-0 mt-3 border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                {{ $isEditMode ? 'Update Category' : 'Save Category' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
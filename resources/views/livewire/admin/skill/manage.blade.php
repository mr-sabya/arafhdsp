<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <div class="search-box">
                                <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Search {{ $viewType }}...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-sm-auto ms-auto">
                            <div class="list-grid-nav hstack gap-2">

                                {{-- View Switcher Buttons --}}
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-{{ $viewType === 'categories' ? 'primary' : 'outline-primary' }}" wire:click="setView('categories')">
                                        Categories
                                    </button>
                                    <button type="button" class="btn btn-{{ $viewType === 'skills' ? 'primary' : 'outline-primary' }}" wire:click="setView('skills')">
                                        Skills
                                    </button>
                                </div>

                                <button
                                    class="btn btn-success"
                                    wire:click="create"
                                    data-bs-toggle="modal"
                                    data-bs-target="#skillModal">
                                    <i class="ri-add-fill me-1 align-bottom"></i> Add {{ $viewType === 'skills' ? 'Skill' : 'Category' }}
                                </button>

                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Controls --}}
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-2 col-6">
                            <select wire:model.live="perPage" class="form-select form-select-sm">
                                <option value="5">5 per page</option>
                                <option value="10">10 per page</option>
                                <option value="25">25 per page</option>
                            </select>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    {{-- Dynamic Headers based on View Type --}}
                                    <th style="cursor: pointer" wire:click="sortBy('id')">ID <i class="fas fa-sort"></i></th>

                                    @if($viewType === 'skills')
                                    <th>Category</th>
                                    <th style="cursor: pointer" wire:click="sortBy('name')">Skill Name <i class="fas fa-sort"></i></th>
                                    <th style="cursor: pointer" wire:click="sortBy('percent')">Percentage <i class="fas fa-sort"></i></th>
                                    @else
                                    <th style="cursor: pointer" wire:click="sortBy('title')">Category Title <i class="fas fa-sort"></i></th>
                                    <th>Skills Count</th>
                                    @endif

                                    <th style="cursor: pointer" wire:click="sortBy('sort_order')">Order <i class="fas fa-sort"></i></th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>

                                    @if($viewType === 'skills')
                                    <td><span class="badge bg-info text-dark">{{ $item->category->title ?? 'Uncategorized' }}</span></td>
                                    <td class="fw-bold">{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">{{ $item->percent }}%</span>
                                            <div class="progress flex-grow-1" style="height: 5px; width: 50px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $item->percent }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    @else
                                    <td class="fw-bold">{{ $item->title }}</td>
                                    <td><span class="badge bg-secondary">{{ $item->skills->count() }} Skills</span></td>
                                    @endif

                                    <td><span class="badge bg-light text-dark border">{{ $item->sort_order }}</span></td>
                                    <td>
                                        <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                            {{ $item->status ? 'Active' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button wire:click="edit({{ $item->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#skillModal"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button wire:confirm="Are you sure? This action cannot be undone."
                                            wire:click="delete({{ $item->id }})"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No records found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $data->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Universal Modal --}}
    <div class="modal fade" id="skillModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $isEditMode ? 'Edit' : 'Add New' }} {{ $viewType === 'skills' ? 'Skill' : 'Category' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit.prevent="store">
                    <div class="modal-body">

                        {{-- Loading --}}
                        <div wire:loading.block wire:target="edit" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>

                        <div wire:loading.remove wire:target="edit">
                            <div class="row g-3">

                                @if($viewType === 'skills')
                                {{-- SKILL FORM FIELDS --}}
                                <div class="col-12">
                                    <label class="form-label">Parent Category <span class="text-danger">*</span></label>
                                    <select class="form-select" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Skill Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="e.g. Figma">
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Percent (%) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model="percent" min="0" max="100">
                                    @error('percent') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                @else
                                {{-- CATEGORY FORM FIELDS --}}
                                <div class="col-12">
                                    <label class="form-label">Category Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="title" placeholder="e.g. Design Skills">
                                    @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                @endif

                                {{-- COMMON FIELDS --}}
                                <div class="col-md-6">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" wire:model="sort_order">
                                </div>

                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="statusSwitch" wire:model="status">
                                        <label class="form-check-label" for="statusSwitch">Active Status</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="store">{{ $isEditMode ? 'Update' : 'Save' }}</span>
                            <span wire:loading wire:target="store">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@script
<script>
    let myModal = new bootstrap.Modal(document.getElementById('skillModal'));

    $wire.on('show-modal', () => myModal.show());
    $wire.on('hide-modal', () => myModal.hide());
</script>
@endscript
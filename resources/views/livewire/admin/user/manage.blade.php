<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="ri-user-settings-line me-1"></i> {{ $isEditMode ? 'Edit User Profile' : 'Create New User' }}
                </h5>
            </div>
            <div class="card-body p-4">
                <form wire:submit.prevent="save">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <div class="row g-3">
                                <!-- Basic Identification -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="e.g. Rafiqul Islam">
                                    @error('name') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Father's Name</label>
                                    <input type="text" class="form-control" wire:model="father_name" placeholder="Father's Name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Mobile Number</label>
                                    <input type="text" class="form-control" wire:model="mobile" placeholder="017XXXXXXXX">
                                    @error('mobile') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" class="form-control" wire:model="email" placeholder="email@example.com" autocomplete="new-password">
                                    @error('email') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">NID Number</label>
                                    <input type="text" class="form-control" wire:model="nid" placeholder="NID Number">
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Password {{ $isEditMode ? '(Leave blank to keep current)' : '' }}</label>
                                    <input type="password" class="form-control" wire:model="password" autocomplete="new-password">
                                    @error('password') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Date of Birth</label>
                                    <input type="date" class="form-control" wire:model="dob">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Blood Group</label>
                                    <select class="form-select" wire:model="blood_group_id">
                                        <option value="">Select Group</option>
                                        @foreach($bloodGroups as $bg)
                                        <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">User Role</label>
                                    <select class="form-select" wire:model="role_id">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Photo Section -->
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Profile Photo</label>
                            <div class="image-preview" style="height: 260px;">
                                @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" alt="">
                                @elseif($existingPhoto)
                                <img src="{{ asset('storage/'.$existingPhoto) }}" alt="">
                                @else
                                <div class="text-center text-muted">
                                    <i class="ri-image-add-line fs-1 d-block"></i>
                                    <span class="small">Upload Photo</span>
                                </div>
                                @endif
                            </div>
                            <input type="file" class="form-control" wire:model="photo">
                            @error('photo') <span class="text-danger x-small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Additional Info -->


                        <!-- Address Section -->
                        <div class="col-12">
                            <div class="border-bottom my-2"></div>
                            <h6 class="fw-bold text-primary mb-3">Address Information</h6>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Division</label>
                            <select class="form-select" wire:model.live="division_id">
                                <option value="">Select Division</option>
                                @foreach($divisions as $div)
                                <option value="{{ $div->id }}">{{ $div->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">District</label>
                            <select class="form-select" wire:model.live="district_id">
                                <option value="">Select District</option>
                                @foreach($districts as $dis)
                                <option value="{{ $dis->id }}">{{ $dis->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Upazila</label>
                            <select class="form-select" wire:model.live="upazila_id">
                                <option value="">Select Upazila</option>
                                @foreach($upazilas as $up)
                                <option value="{{ $up->id }}">{{ $up->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Area / Village</label>
                            <select class="form-select" wire:model="area_id">
                                <option value="">Select Area</option>
                                @foreach($areas as $ar)
                                <option value="{{ $ar->id }}">{{ $ar->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label small fw-bold">Referred By (Worker)</label>
                                <select wire:model="referred_by" class="form-control">
                                    <option value="">-- No Referrer --</option>
                                    @foreach($workers as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }} ({{ $worker->referral_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer px-0 pb-0 border-top-0 mt-5">
                        <a href="{{ route('admin.user.index') }}" wire:navigate class="btn btn-light rounded-pill px-4 shadow-sm me-2">
                            <i class="ri-arrow-left-line"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-line me-1"></i> {{ $isEditMode ? 'Update User' : 'Save User' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
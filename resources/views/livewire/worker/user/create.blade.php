<div class="">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card reg-card shadow-lg border-0">
                <div class="reg-header bg-primary text-white p-4 text-center rounded-top">
                    <h2 class="fw-bold mb-2">নতুন সদস্য নিবন্ধন (অফিসিয়াল)</h2>
                    <p class="mb-0 opacity-75">সদস্যের তথ্যগুলো সঠিকভাবে পূরণ করুন</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form wire:submit.prevent="register">

                        <!-- Section 1: Personal Info -->
                        <h5 class="form-section-title mb-4 border-bottom pb-2 text-primary fw-bold">
                            <i class="fas fa-user-circle me-2"></i> ব্যক্তিগত তথ্য
                        </h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">আবেদনকারীর নাম <span class="text-danger">*</span></label>
                                <input type="text" wire:model="name" class="form-control shadow-none" placeholder="পূর্ণ নাম">
                                @error('name') <span class="text-danger x-small text-danger d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">পিতা / স্বামীর নাম</label>
                                <input type="text" wire:model="father_name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" wire:model="mobile" class="form-control shadow-none" placeholder="017xxxxxxxx">
                                @error('mobile') <span class="text-danger x-small text-danger d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">রক্তের গ্রুপ <span class="text-danger">*</span></label>
                                <select wire:model="blood_group_id" class="form-select shadow-none">
                                    <option value="">বাছাই করুন</option>
                                    @foreach($bloodGroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }} ({{ $group->bn_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">জন্ম তারিখ</label>
                                <input type="date" wire:model="dob" class="form-control shadow-none">
                            </div>
                        </div>

                        <!-- Section 2: Address -->
                        <h5 class="form-section-title mb-4 border-bottom pb-2 text-primary fw-bold">
                            <i class="fas fa-map-marker-alt me-2"></i> ঠিকানা
                        </h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">বিভাগ <span class="text-danger">*</span></label>
                                <select wire:model.live="division_id" class="form-select shadow-none">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($divisions as $div) <option value="{{ $div->id }}">{{ $div->bn_name ?? $div->name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">জেলা <span class="text-danger">*</span></label>
                                <select wire:model.live="district_id" class="form-select shadow-none">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($districts as $dis) <option value="{{ $dis->id }}">{{ $dis->bn_name ?? $dis->name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">উপজেলা <span class="text-danger">*</span></label>
                                <select wire:model.live="upazila_id" class="form-select shadow-none">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($upazilas as $upa) <option value="{{ $upa->id }}">{{ $upa->bn_name ?? $upa->name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">ইউনিয়ন / এলাকা</label>
                                <select wire:model="area_id" class="form-select shadow-none">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($areas as $ar) <option value="{{ $ar->id }}">{{ $ar->bn_name ?? $ar->name }}</option> @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Section 3: Package -->
                        <h5 class="form-section-title mb-4 border-bottom pb-2 text-primary fw-bold">
                            <i class="fas fa-box-open me-2"></i> প্যাকেজ নির্বাচন ও হিসাব
                        </h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">প্যাকেজ বাছাই করুন <span class="text-danger">*</span></label>
                                <select wire:model.live="pricing_plan_id" class="form-select shadow-none border-primary">
                                    <option value="">প্যাকেজ বাছাই করুন...</option>
                                    @foreach($pricingPlans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }} (৳{{ number_format($plan->price) }})</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($selected_plan && $selected_plan->pricing_type === 'per_member')
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">পরিবার সদস্য সংখ্যা</label>
                                <input type="number" wire:model.live="family_members" class="form-control shadow-none" min="1">
                            </div>
                            @endif

                            <div class="col-12">
                                <div class="price-summary bg-light p-4 rounded border text-center">
                                    @if($pricing_plan_id)
                                    <h4 class="mb-0 text-dark">মোট ফি: <span class="text-primary fw-bold display-6">৳{{ number_format($total_price) }}</span></h4>
                                    @if($discount_amount > 0)
                                    <div class="text-danger small">ডিসকাউন্ট প্রযোজ্য হয়েছে: ৳{{ number_format($discount_amount) }}</div>
                                    @endif
                                    @else
                                    <p class="text-muted mb-0">প্যাকেজ নির্বাচন করলে এখানে হিসাব দেখা যাবে</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Security -->
                        <h5 class="form-section-title mb-4 border-bottom pb-2 text-primary fw-bold">
                            <i class="fas fa-shield-alt me-2"></i> নিরাপত্তা ও ছবি
                        </h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">লগইন পাসওয়ার্ড <span class="text-danger">*</span></label>
                                <input type="password" wire:model="password" class="form-control shadow-none" placeholder="পাসওয়ার্ড দিন">
                                @error('password') <span class="text-danger x-small text-danger d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">সদস্যের ছবি</label>
                                <input type="file" wire:model="photo" class="form-control shadow-none">
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <div class="form-check d-inline-block mb-4">
                                <input class="form-check-input" type="checkbox" wire:model="terms" id="termsCheck">
                                <label class="form-check-label small" for="termsCheck">
                                    আমি অঙ্গীকার করছি যে তথ্যগুলো সঠিক।
                                </label>
                                @error('terms') <div class="text-danger x-small text-danger d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-lg rounded-pill shadow py-3 fw-bold">
                                    <span wire:loading wire:target="register" class="spinner-border spinner-border-sm me-2"></span>
                                    সদস্য নিবন্ধন সম্পন্ন করুন <i class="fas fa-check-circle ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
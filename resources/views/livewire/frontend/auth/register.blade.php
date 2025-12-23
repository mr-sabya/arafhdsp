<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card reg-card shadow border-0">
                <div class="reg-header bg-primary text-white p-4 text-center rounded-top">
                    <h2 class="fw-bold mb-2">সদস্য আবেদন ফরম</h2>
                    <p class="mb-0 opacity-75">সঠিক তথ্য দিয়ে নিচের ফরমটি পূরণ করুন</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form wire:submit.prevent="register">

                        <!-- Section 1: Personal Info -->
                        <h5 class="form-section-title mb-4 border-bottom pb-2 text-primary"><i class="fas fa-user me-2"></i> ব্যক্তিগত তথ্য</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">আবেদনকারীর নাম <span class="text-danger">*</span></label>
                                <input type="text" wire:model="name" class="form-control" placeholder="আপনার পূর্ণ নাম লিখুন">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" wire:model="mobile" class="form-control" placeholder="017xxxxxxxx">
                                @error('mobile') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">রক্তের গ্রুপ <span class="text-danger">*</span></label>
                                <select wire:model="blood_group_id" class="form-select">
                                    <option value="">বাছাই করুন</option>
                                    @foreach($bloodGroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }} ({{ $group->bn_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">জন্ম তারিখ</label>
                                <input type="date" wire:model="dob" class="form-control">
                            </div>
                        </div>

                        <!-- Section 2: Address -->
                        <h5 class="form-section-title mt-5 mb-4 border-bottom pb-2 text-primary"><i class="fas fa-map-marker-alt me-2"></i> ঠিকানা</h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">বিভাগ</label>
                                <select wire:model.live="division_id" class="form-select">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($divisions as $div) <option value="{{ $div->id }}">{{ $div->bn_name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">জেলা</label>
                                <select wire:model.live="district_id" class="form-select" {{ empty($districts) ? 'disabled' : '' }}>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($districts as $dis) <option value="{{ $dis->id }}">{{ $dis->bn_name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">উপজেলা</label>
                                <select wire:model.live="upazila_id" class="form-select" {{ empty($upazilas) ? 'disabled' : '' }}>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($upazilas as $upa) <option value="{{ $upa->id }}">{{ $upa->bn_name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ইউনিয়ন</label>
                                <select wire:model="area_id" class="form-select" {{ empty($areas) ? 'disabled' : '' }}>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($areas as $ar) <option value="{{ $ar->id }}">{{ $ar->bn_name }}</option> @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Section 3: Package & Advanced Pricing -->
                        <h5 class="form-section-title mt-5 mb-4 border-bottom pb-2 text-primary"><i class="fas fa-box-open me-2"></i> প্যাকেজ ও হিসাব</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">প্যাকেজ বাছাই করুন <span class="text-danger">*</span></label>
                                <select wire:model.live="pricing_plan_id" class="form-select">
                                    <option value="">বাছাই করুন...</option>
                                    @foreach($pricingPlans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }} (৳{{ $plan->price }})</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($selected_plan && $selected_plan->pricing_type === 'per_member')
                            <div class="col-md-6">
                                <label class="form-label">পরিবার সদস্য সংখ্যা</label>
                                <input type="number" wire:model.live="family_members" class="form-control" min="1">
                                <small class="text-muted">প্রতি সদস্য ৳{{ $base_unit_price }} হারে হিসাব হবে</small>
                            </div>
                            @endif

                            <div class="col-12 mt-3">
                                <div class="price-summary bg-light p-4 rounded border text-center">
                                    @if($pricing_plan_id)
                                    <div class="d-flex justify-content-center gap-3 mb-2 text-muted small">
                                        <span>বেস প্রাইস: ৳{{ number_format($base_unit_price) }}</span>
                                        @if($family_members > 1 && $selected_plan->pricing_type === 'per_member')
                                        <span>x {{ $family_members }} জন</span>
                                        @endif
                                    </div>

                                    @if($discount_amount > 0)
                                    <div class="text-danger fw-bold mb-2">
                                        ডিসকাউন্ট: -৳{{ number_format($discount_amount) }} ({{ $selected_plan->discount_percentage }}% ছাড়)
                                    </div>
                                    @endif

                                    <h4 class="mb-0">মোট ফি: <span class="text-primary fw-bold display-6">৳{{ number_format($total_price) }}</span></h4>

                                    <p class="mt-2 mb-0 text-success small italic">
                                        <i class="fas fa-calculator me-1"></i>
                                        হিসাবের উদাহরণ: {{ $family_members }} জনের জন্য {{ $selected_plan->name }} প্যাকেজে
                                        @if($discount_amount > 0) {{ $selected_plan->discount_percentage }}% ছাড়ে @endif
                                        মাত্র ৳{{ number_format($total_price) }}!
                                    </p>
                                    @else
                                    <p class="text-muted mb-0 py-2">প্যাকেজ নির্বাচন করলে এখানে হিসাব দেখাবে</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Security -->
                        <h5 class="form-section-title mt-5 mb-4 border-bottom pb-2 text-primary"><i class="fas fa-lock me-2"></i> নিরাপত্তা</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">নমিনি নাম (ঐচ্ছিক)</label>
                                <input type="text" wire:model="nominee_name" class="form-control" placeholder="নমিনির নাম">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">নমিনির সাথে সম্পর্ক</label>
                                <input type="text" wire:model="nominee_relation" class="form-control" placeholder="যেমন: স্ত্রী / ভাই">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">পাসওয়ার্ড <span class="text-danger">*</span></label>
                                <input type="password" wire:model="password" class="form-control" placeholder="******">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ছবি (Passport Size)</label>
                                <input type="file" wire:model="photo" class="form-control">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="mt-5">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="terms" id="terms">
                                <label class="form-check-label small" for="terms">আমি সকল নিয়মাবলী মেনে চলতে রাজি।</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                                আবেদন জমা দিন <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="small text-muted">ইতিমধ্যে সদস্য হয়েছেন? <a href="{{ route('login') }}" wire:navigate
                                    class="text-primary fw-bold">লগইন করুন</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card reg-card shadow-lg border-0">
                <div class="reg-header bg-primary text-white p-4 text-center rounded-top">
                    <h2 class="fw-bold mb-2">সদস্য আবেদন ফরম</h2>
                    <p class="mb-0 opacity-75">সঠিক তথ্য দিয়ে নিচের ফরমটি পূরণ করুন</p>
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
                                <input type="text" wire:model="name" class="form-control shadow-none" placeholder="আপনার পূর্ণ নাম লিখুন">
                                @error('name') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">পিতা / স্বামীর নাম</label>
                                <input type="text" wire:model="father_name" class="form-control shadow-none" placeholder="নাম লিখুন">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" wire:model="mobile" class="form-control shadow-none" placeholder="017xxxxxxxx">
                                @error('mobile') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">রক্তের গ্রুপ <span class="text-danger">*</span></label>
                                <select wire:model="blood_group_id" class="form-select shadow-none">
                                    <option value="">বাছাই করুন</option>
                                    @foreach($bloodGroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }} ({{ $group->bn_name }})</option>
                                    @endforeach
                                </select>
                                @error('blood_group_id') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">জন্ম তারিখ</label>
                                <input type="date" wire:model="dob" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">জাতীয় পরিচয়পত্র (NID)</label>
                                <input type="text" wire:model="nid" class="form-control shadow-none" placeholder="NID নম্বর">
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
                                    @foreach($divisions as $div) <option value="{{ $div->id }}">{{ $div->bn_name }}</option> @endforeach
                                </select>
                                @error('division_id') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">জেলা <span class="text-danger">*</span></label>
                                <select wire:model.live="district_id" class="form-select shadow-none" {{ empty($districts) ? 'disabled' : '' }}>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($districts as $dis) <option value="{{ $dis->id }}">{{ $dis->bn_name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">উপজেলা <span class="text-danger">*</span></label>
                                <select wire:model.live="upazila_id" class="form-select shadow-none" {{ empty($upazilas) ? 'disabled' : '' }}>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($upazilas as $upa) <option value="{{ $upa->id }}">{{ $upa->bn_name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">ইউনিয়ন / এলাকা</label>
                                <select wire:model="area_id" class="form-select shadow-none" {{ empty($areas) ? 'disabled' : '' }}>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach($areas as $ar) <option value="{{ $ar->id }}">{{ $ar->bn_name }}</option> @endforeach
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
                                    <option value="{{ $plan->id }}">{{ $plan->name }} (৳{{ number_format($plan->price) }} / {{ $plan->interval_bn }})</option>
                                    @endforeach
                                </select>
                                @error('pricing_plan_id') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>

                            @if($selected_plan && $selected_plan->pricing_type === 'per_member')
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">পরিবার সদস্য সংখ্যা</label>
                                <input type="number" wire:model.live="family_members" class="form-control shadow-none" min="1">
                                <small class="text-muted italic">এই প্যাকেজে প্রতি সদস্য ৳{{ $base_unit_price }} হারে ফি প্রযোজ্য।</small>
                            </div>
                            @endif

                            <div class="col-12">
                                <div class="price-summary bg-light p-4 rounded border text-center">
                                    @if($pricing_plan_id)
                                    <div class="d-flex justify-content-center gap-3 mb-2 text-muted small fw-bold">
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

                                    <h4 class="mb-0 text-dark">মোট ফি: <span class="text-primary fw-bold display-6">৳{{ number_format($total_price) }}</span></h4>
                                    <div class="badge bg-secondary mt-2 px-3 py-2">মেয়াদ: {{ $selected_plan->interval_bn }}</div>
                                    @else
                                    <p class="text-muted mb-0 py-2 italic">প্যাকেজ নির্বাচন করলে এখানে হিসাব দেখা যাবে</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Nominee & Security -->
                        <h5 class="form-section-title mb-4 border-bottom pb-2 text-primary fw-bold">
                            <i class="fas fa-shield-alt me-2"></i> নমিনি ও নিরাপত্তা
                        </h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">নমিনি নাম (ঐচ্ছিক)</label>
                                <input type="text" wire:model="nominee_name" class="form-control shadow-none" placeholder="নমিনির নাম">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">নমিনির সাথে সম্পর্ক</label>
                                <input type="text" wire:model="nominee_relation" class="form-control shadow-none" placeholder="যেমন: স্ত্রী / ভাই">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">পাসওয়ার্ড <span class="text-danger">*</span></label>
                                <input type="password" wire:model="password" class="form-control shadow-none" placeholder="পাসওয়ার্ড সেট করুন">
                                @error('password') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">ছবি (পাসপোর্ট সাইজ)</label>
                                <input type="file" wire:model="photo" class="form-control shadow-none">
                                <div wire:loading wire:target="photo" class="text-primary small mt-1">ছবি আপলোড হচ্ছে...</div>
                                @error('photo') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="mt-5 text-center">
                            <div class="form-check d-inline-block mb-4">
                                <input class="form-check-input" type="checkbox" wire:model="terms" id="termsCheck">
                                <label class="form-check-label small" for="termsCheck">
                                    আমি অঙ্গীকার করছি যে, উপরে প্রদত্ত তথ্যগুলো সত্য এবং আমি <a href="#" class="text-primary fw-bold">শর্তাবলী</a> মেনে চলতে রাজি।
                                </label>
                                @error('terms') <div class="text-danger x-small">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-lg rounded-pill shadow py-3 fw-bold">
                                    <span wire:loading wire:target="register" class="spinner-border spinner-border-sm me-2"></span>
                                    আবেদন জমা দিন <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>

                            <p class="mt-4 small text-muted">
                                ইতিমধ্যে সদস্য হয়েছেন? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">লগইন করুন</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
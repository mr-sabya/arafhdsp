<div class="dashboard dashboard-wrapper py-5 bg-light">
    <div class="container">

        <!-- ১. পেন্ডিং স্ট্যাটাস ব্যানার -->
        @if($user->application_status == 'pending')
        <div class="alert alert-soft-warning border-0 shadow-sm rounded-4 p-4 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="dashboard-status-icon bg-warning text-white rounded-circle me-3 animate-pulse">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 text-dark">আবেদন রিভিউ হচ্ছে</h5>
                    <p class="mb-0 small text-muted">পেমেন্ট যাচাই শেষ হলে দ্রুত আপনার অ্যাকাউন্ট সক্রিয় করা হবে।</p>
                </div>
            </div>
            <div class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold small">TrxID: {{ $user->transaction_id }}</div>
        </div>
        @endif

        <div class="row g-4">
            <!-- ২. সাইডবার (বাম পাশে) -->
            <div class="col-lg-4">
                <!-- প্রোফাইল কার্ড -->
                <div class="card border-0 shadow-sm rounded-4 text-center overflow-hidden mb-4">
                    <div class="dashboard-profile-header"></div>
                    <div class="card-body pt-0 px-4 pb-4">
                        <div class="position-relative dashboard-avatar-wrapper mb-3">
                            <img src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('assets/frontend/images/default-user.png') }}"
                                class="rounded-circle border border-4 border-white shadow-sm dashboard-avatar">
                            @if($user->application_status == 'approved')
                            <i class="fas fa-check-circle text-success dashboard-verified-icon"></i>
                            @endif
                        </div>
                        <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                        <p class="text-muted small mb-0"><i class="fas fa-phone-alt me-1 text-primary"></i> {{ $user->mobile }}</p>
                    </div>
                </div>

                <!-- মেইন সাইডবার মেনু -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="list-group list-group-flush dashboard-sidebar-menu">

                        <!-- প্রোফাইল স্ট্যাটাস (তথ্য) -->
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light-subtle">
                            <span class="text-muted small fw-bold"><i class="fas fa-tint text-danger me-2"></i> রক্তের গ্রুপ</span>
                            <span class="badge bg-danger text-white rounded-pill px-3">{{ $user->bloodGroup->name ?? 'N/A' }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light-subtle border-bottom-0">
                            <span class="text-muted small fw-bold"><i class="fas fa-users text-primary me-2"></i> মেম্বার সংখ্যা</span>
                            <span class="fw-bold text-dark">{{ $user->family_members }} জন</span>
                        </div>

                        <div class="dashboard-menu-divider px-3 py-2 bg-light text-muted small fw-bold text-uppercase">সেবা সমূহ</div>

                        <!-- আপনার ছবি থেকে নেওয়া সার্ভিস আইটেমসমূহ -->
                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <div class="dashboard-sidebar-icon bg-primary-subtle text-primary me-3">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <span class="fw-bold small text-dark">ডক্টর বুকিং</span>
                            <i class="fas fa-chevron-right ms-auto text-muted smaller"></i>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <div class="dashboard-sidebar-icon bg-success-subtle text-success me-3">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <span class="fw-bold small text-dark">ল্যাব টেস্ট</span>
                            <i class="fas fa-chevron-right ms-auto text-muted smaller"></i>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <div class="dashboard-sidebar-icon bg-info-subtle text-info me-3">
                                <i class="fas fa-ambulance"></i>
                            </div>
                            <span class="fw-bold small text-dark">অ্যাম্বুলেন্স সেবা</span>
                            <i class="fas fa-chevron-right ms-auto text-muted smaller"></i>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <div class="dashboard-sidebar-icon bg-danger-subtle text-danger me-3">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <span class="fw-bold small text-dark">মেডিক্যাল রিপোর্ট</span>
                            <i class="fas fa-chevron-right ms-auto text-muted smaller"></i>
                        </a>

                        <div class="dashboard-menu-divider px-3 py-2 bg-light text-muted small fw-bold text-uppercase">অন্যান্য</div>

                        <!-- কুইক লিঙ্কসমূহ -->
                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <i class="fas fa-id-card text-muted me-3 fs-5"></i>
                            <span class="fw-bold small text-dark">আইডি কার্ড ডাউনলোড</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                            <i class="fas fa-user-edit text-muted me-3 fs-5"></i>
                            <span class="fw-bold small text-dark">প্রোফাইল আপডেট</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৩. মেইন কন্টেন্ট (ডান পাশে) -->
            <div class="col-lg-8">
                <!-- সাবস্ক্রিপশন স্ট্যাটাস কার্ড -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-4">
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-primary border-5">
                            <small class="text-muted d-block fw-bold">প্যাকেজ প্ল্যান</small>
                            <h5 class="fw-bold mb-0 mt-1 text-primary">{{ $user->pricingPlan->name ?? 'N/A' }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-success border-5">
                            <small class="text-muted d-block fw-bold">অবশিষ্ট মেয়াদ</small>
                            <h5 class="fw-bold mb-0 mt-1 text-success">{{ $user->subscriptionDaysLeft() }} দিন</h5>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-info border-5">
                            <small class="text-muted d-block fw-bold">পেমেন্ট স্ট্যাটাস</small>
                            <h5 class="fw-bold mb-0 mt-1 text-info">{{ $user->payment_status == 'paid' ? 'পরিশোধিত' : 'বকেয়া' }}</h5>
                        </div>
                    </div>
                </div>

                <!-- ইউজার ডিটেইলস টেবিল -->
                <!-- ইউজার ডিটেইলস টেবিল: সকল তথ্য প্রদর্শনী -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-address-card text-primary me-2"></i> ব্যক্তিগত প্রোফাইল তথ্য
                        </h5>
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">সদস্য আইডি: #{{ $user->id }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 dashboard-info-table">
                                <tbody class="small text-dark">
                                    <!-- ১. বেসিক ইনফরমেশন -->
                                    <tr class="bg-light-subtle">
                                        <td colspan="4" class="ps-4 py-2 fw-bold text-primary opacity-75 uppercase" style="font-size: 0.75rem;">সাধারণ তথ্য</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted" width="20%">পূর্ণ নাম</td>
                                        <td class="fw-bold" width="30%">: {{ $user->name }}</td>
                                        <td class="text-muted" width="20%">লিঙ্গ</td>
                                        <td class="fw-bold" width="30%">: {{ $user->gender ?? 'পুরুষ' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">পিতার নাম</td>
                                        <td class="fw-bold">: {{ $user->father_name }}</td>
                                        <td class="text-muted">মাতার নাম</td>
                                        <td class="fw-bold">: {{ $user->mother_name ?? 'প্রদান করা হয়নি' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">জন্ম তারিখ</td>
                                        <td class="fw-bold">: {{ $user->dob ? $user->dob->format('d M, Y') : 'N/A' }}</td>
                                        <td class="text-muted">রক্তের গ্রুপ</td>
                                        <td class="fw-bold">: <span class="text-danger">{{ $user->bloodGroup->name ?? 'N/A' }}</span></td>
                                    </tr>

                                    <!-- ২. পরিচয় ও যোগাযোগ -->
                                    <tr class="bg-light-subtle">
                                        <td colspan="4" class="ps-4 py-2 fw-bold text-primary opacity-75 uppercase" style="font-size: 0.75rem;">পরিচয় ও যোগাযোগ</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">এনআইডি নম্বর</td>
                                        <td class="fw-bold">: {{ $user->nid }}</td>
                                        <td class="text-muted">মোবাইল নম্বর</td>
                                        <td class="fw-bold">: {{ $user->mobile }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">জরুরী যোগাযোগ</td>
                                        <td class="fw-bold">: {{ $user->emergency_contact ?? 'N/A' }}</td>
                                        <td class="text-muted">পরিবারের সদস্য</td>
                                        <td class="fw-bold">: {{ $user->family_members }} জন</td>
                                    </tr>

                                    <!-- ৩. বর্তমান ঠিকানা -->
                                    <tr class="bg-light-subtle">
                                        <td colspan="4" class="ps-4 py-2 fw-bold text-primary opacity-75 uppercase" style="font-size: 0.75rem;">ঠিকানা ও এলাকা</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">বিভাগ</td>
                                        <td class="fw-bold">: {{ $user->division->name ?? 'N/A' }}</td>
                                        <td class="text-muted">জেলা</td>
                                        <td class="fw-bold">: {{ $user->district->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">থানা/উপজেলা</td>
                                        <td class="fw-bold">: {{ $user->upazila->name ?? 'N/A' }}</td>
                                        <td class="text-muted">এলাকা/গ্রাম</td>
                                        <td class="fw-bold">: {{ $user->area->name ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- ৪. মেম্বারশিপ তথ্য -->
                                    <tr class="bg-light-subtle">
                                        <td colspan="4" class="ps-4 py-2 fw-bold text-primary opacity-75 uppercase" style="font-size: 0.75rem;">মেম্বারশিপ ও পেমেন্ট</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">রেজিস্ট্রেশন তারিখ</td>
                                        <td class="fw-bold">: {{ $user->created_at->format('d F, Y') }}</td>
                                        <td class="text-muted">পেমেন্ট মাধ্যম</td>
                                        <td class="fw-bold">: <span class="text-uppercase">{{ $user->payment_method ?? 'N/A' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 py-3 text-muted">ট্রানজেকশন আইডি</td>
                                        <td class="fw-bold">: {{ $user->transaction_id ?? 'N/A' }}</td>
                                        <td class="text-muted">আবেদন স্ট্যাটাস</td>
                                        <td class="fw-bold">:
                                            @if($user->application_status == 'approved')
                                            <span class="text-success"><i class="fas fa-check-circle"></i> অনুমোদিত</span>
                                            @else
                                            <span class="text-warning"><i class="fas fa-clock"></i> পেন্ডিং</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- হেল্প লাইন (নিচে) -->
                <div class="card border-0 shadow-sm rounded-4 bg-dark text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8 text-center text-md-start">
                            <h5 class="fw-bold mb-1 text-white">সহযোগিতা প্রয়োজন?</h5>
                            <p class="mb-0 small text-white-50">যেকোনো তথ্যের জন্য কল করুন আমাদের হটলাইনে।</p>
                        </div>
                        <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                            <a href="tel:01XXXXXXXXX" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm">কল করুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
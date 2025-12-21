@extends('frontend.layouts.app')

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container text-center">
        <span class="badge bg-warning text-dark mb-2">মেম্বারশিপ প্ল্যান</span>
        <h1 class="fw-bold display-4 text-white">আমাদের প্যাকেজ ও সুবিধাসমূহ</h1>
        <p class="lead text-white-50">স্বল্প খরচে উন্নত সেবা নিশ্চিত করতে আপনার পছন্দের প্যাকেজটি বেছে নিন</p>
    </div>
</header>

<!-- Pricing Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">সার্ভিস প্যাকেজ ও লেভেল</h2>
            <p class="text-muted">আপনার প্রয়োজন ও সাধ্যের মধ্যে সেরা প্ল্যান</p>
        </div>

        <div class="row g-4 justify-content-center">

            <!-- Level 1: General -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card card-basic">
                    <div class="pricing-header">
                        <h5 class="mb-0">সাধারণ (Level 1)</h5>
                        <div class="price-value mt-2"><span class="currency">৳</span>১০০</div>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle text-success"></i> প্রাথমিক চিকিৎসা সুবিধা</li>
                        <li><i class="fas fa-check-circle text-success"></i> ওষুধে ১০% ছাড়</li>
                        <li><i class="fas fa-check-circle text-success"></i> সাধারণ স্বাস্থ্য পরামর্শ</li>
                        <li><i class="fas fa-times-circle text-muted" style="opacity: 0.5;"></i> সার্জারি সহায়তা
                        </li>
                    </ul>
                    <div class="text-center pb-4 px-4">
                        <a href="register.html" class="btn btn-outline-secondary w-100 rounded-pill">বেছে নিন</a>
                    </div>
                </div>
            </div>

            <!-- Level 2: Special/Family -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card card-standard">
                    <div class="pricing-header">
                        <h5 class="mb-0">বিশেষ / ফ্যামিলি (Level 2)</h5>
                        <div class="price-value mt-2"><span class="currency">৳</span>২০০</div>
                        <span class="badge bg-light text-primary mt-2 rounded-pill small">জনপ্রিয়</span>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle text-success"></i> ২ জন সদস্য / পরিবার</li>
                        <li><i class="fas fa-check-circle text-success"></i> বিশেষজ্ঞ ডাক্তার পরামর্শ</li>
                        <li><i class="fas fa-check-circle text-success"></i> মেডিকেল টেস্টে ২০% ছাড়</li>
                        <li><i class="fas fa-check-circle text-success"></i> ওষুধে ২০% পর্যন্ত ছাড়</li>
                    </ul>
                    <div class="text-center pb-4 px-4">
                        <a href="register.html" class="btn btn-primary w-100 rounded-pill">বেছে নিন</a>
                    </div>
                </div>
            </div>

            <!-- Level 3: Medical -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card card-premium">
                    <div class="pricing-header">
                        <h5 class="mb-0">মেডিকেল (Level 3)</h5>
                        <div class="price-value mt-2"><span class="currency">৳</span>৩০০</div>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle text-success"></i> ১০ জনের গ্রুপ সুবিধা</li>
                        <li><i class="fas fa-check-circle text-success"></i> জরুরি চিকিৎসা সেবা</li>
                        <li><i class="fas fa-check-circle text-success"></i> ল্যাব টেস্টে ৫০% পর্যন্ত ছাড়</li>
                        <li><i class="fas fa-check-circle text-success"></i> হরমোন ও ভিটামিন টেস্ট</li>
                    </ul>
                    <div class="text-center pb-4 px-4">
                        <a href="register.html" class="btn btn-success w-100 rounded-pill">বেছে নিন</a>
                    </div>
                </div>
            </div>

            <!-- Level 4: Surgery -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card card-ultra">
                    <div class="pricing-header">
                        <h5 class="mb-0">সার্জারি সাপোর্ট</h5>
                        <div class="price-value mt-2"><span class="currency">৳</span>৫০০</div>
                    </div>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle text-success"></i> বড় ধরনের অপারেশন সহায়তা</li>
                        <li><i class="fas fa-check-circle text-success"></i> কেবিন ভাড়ায় ছাড়</li>
                        <li><i class="fas fa-check-circle text-success"></i> ৩০% স্পেশাল ডিসকাউন্ট</li>
                        <li><i class="fas fa-check-circle text-success"></i> অগ্রাধিকার ভিত্তিতে সেবা</li>
                    </ul>
                    <div class="text-center pb-4 px-4">
                        <a href="register.html"
                            class="btn btn-outline-warning text-dark fw-bold w-100 rounded-pill">বেছে নিন</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Calculation & Details -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">

            <!-- Service Details -->
            <div class="col-lg-7">
                <h3 class="fw-bold mb-4 border-start border-4 border-primary ps-3">বিস্তারিত সেবাসমূহ</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="service-box">
                            <div class="icon-box"><i class="fas fa-user-md"></i></div>
                            <h5>মেডিকেল সহায়তা</h5>
                            <p class="text-muted small">সাধারণ ডাক্তার পরামর্শ, জরুরি চিকিৎসা ও ক্ষুদ্র অপারেশনে
                                ১০%–২০% আর্থিক সহায়তা।</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-box">
                            <div class="icon-box"><i class="fas fa-brain"></i></div>
                            <h5>লাইফস্টাইল ও কাউন্সেলিং</h5>
                            <p class="text-muted small">মানসিক স্বাস্থ্য, ডিপ্রেশন, শিশু বিকাশ ও পারিবারিক সমস্যার
                                সমাধানে ৫% বিশেষ ছাড়।</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-box">
                            <div class="icon-box"><i class="fas fa-flask"></i></div>
                            <h5>ল্যাব ও ডায়াগনস্টিক</h5>
                            <p class="text-muted small">RBS, CRP, কিডনি, লিভার ও হরমোন টেস্টে সর্বোচ্চ ৫০% পর্যন্ত
                                নিশ্চিত ডিসকাউন্ট।</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-box">
                            <div class="icon-box"><i class="fas fa-hands-helping"></i></div>
                            <h5>বিশেষ সুবিধা</h5>
                            <p class="text-muted small">আর্থিক স্বচ্ছতা, নিয়মিত হিসাব ও সঠিক সময়ে টাকা জমার মাধ্যমে
                                ৫০% পর্যন্ত সুবিধা।</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calculator Section -->
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4 border-start border-4 border-success ps-3">খরচের হিসাব ও উদাহরণ</h3>
                <div class="bg-white p-4 shadow-sm rounded-4">
                    <p class="text-muted mb-4">আপনার সুবিধার জন্য নিচে কিছু হিসাবের উদাহরণ দেওয়া হলো:</p>

                    <div class="calc-box mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">২ জন সাধারণ সদস্য</h6>
                                <small class="text-muted">১০০ টাকা × ২</small>
                            </div>
                            <h4 class="text-primary fw-bold mb-0">৳২০০</h4>
                        </div>
                    </div>

                    <div class="calc-box mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">২ জন বিশেষ সদস্য</h6>
                                <small class="text-muted">১৬৫ টাকা × ২</small>
                            </div>
                            <h4 class="text-primary fw-bold mb-0">৳৩৩০</h4>
                        </div>
                    </div>

                    <div class="calc-box mb-3 border-success bg-success bg-opacity-10">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">ফ্যামিলি প্যাক (৫ জন)</h6>
                                <small class="text-success">পুরো পরিবার</small>
                            </div>
                            <h4 class="text-success fw-bold mb-0">৳৪০০</h4>
                        </div>
                    </div>

                    <div class="calc-box mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">বিশেষ সার্ভিস (সার্জারি)</h6>
                                <small class="text-muted">রেগুলার ৫০০ (৩০% ছাড়)</small>
                            </div>
                            <h4 class="text-danger fw-bold mb-0">৳৩৫০</h4>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4 text-center small">
                        <i class="fas fa-info-circle me-1"></i> ১০ জনের গ্রুপ মেম্বারশিপে বিশেষ প্যাকেজ মূল্য ৩০০
                        টাকা।
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
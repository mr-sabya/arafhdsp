@extends('frontend.layouts.app')

@section('content')
<!-- Page Header -->
<header class="page-header"
    style="background-image: linear-gradient(rgba(0, 50, 100, 0.7), rgba(0, 50, 100, 0.7)), url('https://source.unsplash.com/1600x600/?microscope,laboratory'); padding-bottom: 80px;">
    <div class="container">
        <h1 class="fw-bold display-5">ডায়াগনস্টিক ও প্যাথলজি সেবা</h1>
        <p class="lead">আধুনিক ল্যাব ও নির্ভুল রিপোর্টের নিশ্চয়তা | সর্বোচ্চ ৫০% পর্যন্ত ছাড়</p>
    </div>
</header>

<!-- Search Section -->
<div class="container">
    <div class="search-box d-flex align-items-center">
        <i class="fas fa-search text-muted ms-3 fa-lg"></i>
        <input type="text" id="searchInput" class="form-control search-input"
            placeholder="টেস্টের নাম খুঁজুন (যেমন: Blood, Hormone)...">
        <button class="btn btn-primary rounded-pill px-4 py-2 m-1 fw-bold">খুঁজুন</button>
    </div>
</div>

<!-- Diagnostic Cards Grid -->
<div class="container mb-5">
    <div class="row g-4" id="testContainer">

        <!-- Card 1: Pathology -->
        <div class="col-md-6 col-lg-4 test-card">
            <div class="diag-card p-4">
                <div class="discount-badge">৫০% পর্যন্ত ছাড়</div>
                <div class="diag-icon">
                    <i class="fas fa-vial"></i>
                </div>
                <h4 class="fw-bold mb-3">জেনারেল প্যাথলজি</h4>
                <p class="text-muted small">রক্ত ও সাধারণ রোগ নির্ণয়ের পরীক্ষা।</p>
                <hr>
                <ul class="list-unstyled test-list">
                    <li><i class="fas fa-check-circle"></i> Complete Blood Count (CBC)</li>
                    <li><i class="fas fa-check-circle"></i> Random Blood Sugar (RBS)</li>
                    <li><i class="fas fa-check-circle"></i> CRP & CRS Test</li>
                    <li><i class="fas fa-check-circle"></i> Lipid Profile</li>
                </ul>
                <a href="contact.html" class="btn btn-outline-primary w-100 mt-3 rounded-pill">বুকিং দিন</a>
            </div>
        </div>

        <!-- Card 2: Hormone -->
        <div class="col-md-6 col-lg-4 test-card">
            <div class="diag-card p-4">
                <div class="discount-badge">৩০% ছাড়</div>
                <div class="diag-icon">
                    <i class="fas fa-dna"></i>
                </div>
                <h4 class="fw-bold mb-3">হরমোন ও থাইরয়েড</h4>
                <p class="text-muted small">শরীরের হরমোন ও গ্ল্যান্ড বিষয়ক পরীক্ষা।</p>
                <hr>
                <ul class="list-unstyled test-list">
                    <li><i class="fas fa-check-circle"></i> Thyroid Profile (T3, T4, TSH)</li>
                    <li><i class="fas fa-check-circle"></i> Testosterone Test</li>
                    <li><i class="fas fa-check-circle"></i> Insulin Level</li>
                    <li><i class="fas fa-check-circle"></i> Vitamin D3 Test</li>
                </ul>
                <a href="contact.html" class="btn btn-outline-primary w-100 mt-3 rounded-pill">বুকিং দিন</a>
            </div>
        </div>

        <!-- Card 3: Liver & Kidney -->
        <div class="col-md-6 col-lg-4 test-card">
            <div class="diag-card p-4">
                <div class="discount-badge">২০% – ৩০% ছাড়</div>
                <div class="diag-icon">
                    <i class="fas fa-kidney"></i>
                </div>
                <h4 class="fw-bold mb-3">লিভার ও কিডনি</h4>
                <p class="text-muted small">শরীরের ভাইটাল অর্গান ফাংশন টেস্ট।</p>
                <hr>
                <ul class="list-unstyled test-list">
                    <li><i class="fas fa-check-circle"></i> Serum Creatinine (Kidney)</li>
                    <li><i class="fas fa-check-circle"></i> SGPT / SGOT (Liver)</li>
                    <li><i class="fas fa-check-circle"></i> Bilirubin Test</li>
                    <li><i class="fas fa-check-circle"></i> Electrolytes</li>
                </ul>
                <a href="contact.html" class="btn btn-outline-primary w-100 mt-3 rounded-pill">বুকিং দিন</a>
            </div>
        </div>

        <!-- Card 4: Imaging -->
        <div class="col-md-6 col-lg-4 test-card">
            <div class="diag-card p-4">
                <div class="discount-badge">২০% ছাড়</div>
                <div class="diag-icon">
                    <i class="fas fa-x-ray"></i>
                </div>
                <h4 class="fw-bold mb-3">ডিজিটাল ইমেজিং</h4>
                <p class="text-muted small">আধুনিক মেশিনে এক্স-রে ও স্ক্যানিং।</p>
                <hr>
                <ul class="list-unstyled test-list">
                    <li><i class="fas fa-check-circle"></i> Digital X-Ray</li>
                    <li><i class="fas fa-check-circle"></i> Ultrasonography (USG)</li>
                    <li><i class="fas fa-check-circle"></i> ECG (Heart)</li>
                    <li><i class="fas fa-check-circle"></i> CT Scan Support</li>
                </ul>
                <a href="contact.html" class="btn btn-outline-primary w-100 mt-3 rounded-pill">বুকিং দিন</a>
            </div>
        </div>

        <!-- Card 5: Viral & Immunology -->
        <div class="col-md-6 col-lg-4 test-card">
            <div class="diag-card p-4">
                <div class="discount-badge">১৫% ছাড়</div>
                <div class="diag-icon">
                    <i class="fas fa-virus"></i>
                </div>
                <h4 class="fw-bold mb-3">ভাইরাল ও ইমিউনোলজি</h4>
                <p class="text-muted small">সংক্রামক রোগ ও ভাইরাস শনাক্তকরণ।</p>
                <hr>
                <ul class="list-unstyled test-list">
                    <li><i class="fas fa-check-circle"></i> Dengue NS1</li>
                    <li><i class="fas fa-check-circle"></i> Hepatitis B (HBsAg)</li>
                    <li><i class="fas fa-check-circle"></i> Typhoid Test</li>
                    <li><i class="fas fa-check-circle"></i> Urine R/E</li>
                </ul>
                <a href="contact.html" class="btn btn-outline-primary w-100 mt-3 rounded-pill">বুকিং দিন</a>
            </div>
        </div>

        <!-- Card 6: Health Checkup -->
        <div class="col-md-6 col-lg-4 test-card">
            <div class="diag-card p-4 bg-primary text-white">
                <div class="discount-badge bg-warning text-dark">স্পেশাল প্যাকেজ</div>
                <div class="diag-icon bg-white text-primary">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <h4 class="fw-bold mb-3">ফুল বডি চেকআপ</h4>
                <p class="text-white-50 small">সুস্থ থাকতে নিয়মিত চেকআপ জরুরি।</p>
                <hr class="border-light">
                <ul class="list-unstyled test-list">
                    <li class="text-white"><i class="fas fa-check-circle text-warning"></i> ডায়াবেটিস চেকআপ</li>
                    <li class="text-white"><i class="fas fa-check-circle text-warning"></i> হার্ট ও লাং চেকআপ</li>
                    <li class="text-white"><i class="fas fa-check-circle text-warning"></i> লিভার ও কিডনি প্রোফাইল
                    </li>
                    <li class="text-white"><i class="fas fa-check-circle text-warning"></i> ডাক্তার কনসালটেন্সি</li>
                </ul>
                <a href="contact.html" class="btn btn-light text-primary fw-bold w-100 mt-3 rounded-pill">বিস্তারিত
                    দেখুন</a>
            </div>
        </div>

    </div>
</div>

<!-- Why Choose Us -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold text-primary mb-5">কেন আমাদের ল্যাব সার্ভিস সেরা?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-3">
                    <i class="fas fa-clock fa-3x text-success mb-3"></i>
                    <h5>দ্রুত রিপোর্ট ডেলিভারি</h5>
                    <p class="text-muted">জরুরি ভিত্তিতে অনলাইন ও অফলাইনে রিপোর্ট পাওয়ার সুবিধা।</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <i class="fas fa-award fa-3x text-warning mb-3"></i>
                    <h5>আধুনিক প্রযুক্তি</h5>
                    <p class="text-muted">নির্ভুল ফলাফলের জন্য আমরা ব্যবহার করি অত্যাধুনিক মেশিন।</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <i class="fas fa-hand-holding-usd fa-3x text-primary mb-3"></i>
                    <h5>সাশ্রয়ী মূল্য</h5>
                    <p class="text-muted">সদস্যদের জন্য সকল টেস্টে নিশ্চিত ডিসকাউন্ট সুবিধা।</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@extends('frontend.layouts.app')

@section('content')

<!-- Page Header -->
<header class="page-header"
    style="background-image: linear-gradient(rgba(0, 50, 100, 0.7), rgba(0, 50, 100, 0.7)), url('https://source.unsplash.com/1600x600/?surgery,hospital-room'); padding-bottom: 80px;">
    <div class="container">
        <h1 class="fw-bold display-5">হাসপাতাল ও বিশেষজ্ঞ ডাক্তার</h1>
        <p class="lead">সেরা চিকিৎসকদের পরামর্শ ও আধুনিক হাসপাতাল সুবিধা | ৩০% পর্যন্ত ছাড়</p>
    </div>
</header>

<!-- Search Section -->
<div class="container">
    <div class="search-box d-flex align-items-center">
        <i class="fas fa-search text-muted ms-3 fa-lg"></i>
        <input type="text" id="searchInput" class="form-control search-input"
            placeholder="ডাক্তারের নাম বা বিভাগ খুঁজুন (যেমন: Medicine)...">
        <button class="btn btn-primary rounded-pill px-4 py-2 m-1 fw-bold">খুঁজুন</button>
    </div>
</div>

<!-- Departments Section -->
<div class="container mb-5">
    <h4 class="fw-bold text-secondary mb-4 ps-2 border-start border-4 border-primary">বিভাগসমূহ</h4>
    <div class="row g-3">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto"><i class="fas fa-pills"></i></div>
                <h6 class="fw-bold">মেডিসিন</h6>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto"><i class="fas fa-heartbeat"></i></div>
                <h6 class="fw-bold">কার্ডিওলজি</h6>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto"><i class="fas fa-baby"></i></div>
                <h6 class="fw-bold">শিশু বিশেষজ্ঞ</h6>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto"><i class="fas fa-female"></i></div>
                <h6 class="fw-bold">গাইনি</h6>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto"><i class="fas fa-bone"></i></div>
                <h6 class="fw-bold">অর্থোপেডিক</h6>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto"><i class="fas fa-eye"></i></div>
                <h6 class="fw-bold">চক্ষু</h6>
            </div>
        </div>
    </div>
</div>

<!-- Doctors Grid -->
<div class="container mb-5">
    <h4 class="fw-bold text-primary mb-4 ps-2 border-start border-4 border-primary">আমাদের বিশেষজ্ঞ ডাক্তারগণ</h4>
    <div class="row g-4" id="doctorContainer">

        <!-- Doctor 1 -->
        <div class="col-md-6 col-lg-3 filter-item">
            <div class="doctor-card">
                <div class="discount-badge">ফি: ৩০% ছাড়</div>
                <div class="doctor-img-box">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=300&auto=format&fit=crop"
                        alt="Doctor">
                </div>
                <div class="p-3 text-center">
                    <h5 class="fw-bold mb-1">ডাঃ রফিকুল ইসলাম</h5>
                    <p class="text-muted small mb-1">MBBS, FCPS (Medicine)</p>
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3">মেডিসিন বিশেষজ্ঞ</span>
                    <div class="d-grid gap-2">
                        <a href="contact.html" class="btn btn-primary btn-sm rounded-pill">অ্যাপয়েন্টমেন্ট নিন</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor 2 -->
        <div class="col-md-6 col-lg-3 filter-item">
            <div class="doctor-card">
                <div class="discount-badge">ফি: ২০% ছাড়</div>
                <div class="doctor-img-box">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=300&auto=format&fit=crop"
                        alt="Doctor">
                </div>
                <div class="p-3 text-center">
                    <h5 class="fw-bold mb-1">ডাঃ নুসরাত জাহান</h5>
                    <p class="text-muted small mb-1">MBBS, DGO (Gynae)</p>
                    <span class="badge bg-danger bg-opacity-10 text-danger mb-3">গাইনি ও প্রসূতি</span>
                    <div class="d-grid gap-2">
                        <a href="contact.html" class="btn btn-primary btn-sm rounded-pill">অ্যাপয়েন্টমেন্ট নিন</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor 3 -->
        <div class="col-md-6 col-lg-3 filter-item">
            <div class="doctor-card">
                <div class="discount-badge">ফি: ২০% ছাড়</div>
                <div class="doctor-img-box">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=300&auto=format&fit=crop"
                        alt="Doctor">
                </div>
                <div class="p-3 text-center">
                    <h5 class="fw-bold mb-1">ডাঃ আবরার আহমেদ</h5>
                    <p class="text-muted small mb-1">MBBS, MS (Ortho)</p>
                    <span class="badge bg-success bg-opacity-10 text-success mb-3">হাড় ও জয়েন্ট</span>
                    <div class="d-grid gap-2">
                        <a href="contact.html" class="btn btn-primary btn-sm rounded-pill">অ্যাপয়েন্টমেন্ট নিন</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor 4 -->
        <div class="col-md-6 col-lg-3 filter-item">
            <div class="doctor-card">
                <div class="discount-badge">ফি: ৩০% ছাড়</div>
                <div class="doctor-img-box">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=300&auto=format&fit=crop"
                        alt="Doctor">
                </div>
                <div class="p-3 text-center">
                    <h5 class="fw-bold mb-1">ডাঃ আনিসুর রহমান</h5>
                    <p class="text-muted small mb-1">MBBS, FCPS (Surgery)</p>
                    <span class="badge bg-warning bg-opacity-10 text-dark mb-3">জেনারেল সার্জারি</span>
                    <div class="d-grid gap-2">
                        <a href="contact.html" class="btn btn-primary btn-sm rounded-pill">অ্যাপয়েন্টমেন্ট নিন</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Partner Hospitals Grid -->
<div class="container mb-5">
    <h4 class="fw-bold text-success mb-4 ps-2 border-start border-4 border-success">পার্টনার হাসপাতালসমূহ</h4>
    <div class="row g-4">

        <!-- Hospital 1 -->
        <div class="col-md-6">
            <div class="hospital-card d-flex flex-column flex-md-row align-items-center p-3">
                <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?q=80&w=200&auto=format&fit=crop"
                    class="rounded-3 mb-3 mb-md-0 me-md-4" style="width: 120px; height: 120px; object-fit: cover;"
                    alt="Hospital">
                <div class="flex-grow-1 text-center text-md-start">
                    <h5 class="fw-bold mb-1">সিটি জেনারেল হাসপাতাল</h5>
                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt me-1"></i> ধানমন্ডি, ঢাকা</p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                        <span class="badge bg-info text-dark">কেবিন: ২০% ছাড়</span>
                        <span class="badge bg-secondary">টেস্ট: ৩০% ছাড়</span>
                    </div>
                </div>
                <a href="contact.html" class="btn btn-outline-success btn-sm mt-3 mt-md-0 ms-md-3">বিস্তারিত</a>
            </div>
        </div>

        <!-- Hospital 2 -->
        <div class="col-md-6">
            <div class="hospital-card d-flex flex-column flex-md-row align-items-center p-3">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=200&auto=format&fit=crop"
                    class="rounded-3 mb-3 mb-md-0 me-md-4" style="width: 120px; height: 120px; object-fit: cover;"
                    alt="Hospital">
                <div class="flex-grow-1 text-center text-md-start">
                    <h5 class="fw-bold mb-1">উত্তরা মডার্ন ক্লিনিক</h5>
                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt me-1"></i> উত্তরা, ঢাকা</p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                        <span class="badge bg-info text-dark">সার্জারি: ১০% ছাড়</span>
                        <span class="badge bg-secondary">ইমার্জেন্সি সাপোর্ট</span>
                    </div>
                </div>
                <a href="contact.html" class="btn btn-outline-success btn-sm mt-3 mt-md-0 ms-md-3">বিস্তারিত</a>
            </div>
        </div>

    </div>
</div>

<!-- Emergency CTA -->
<section class="bg-danger text-white py-4 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="text-center text-md-start mb-3 mb-md-0">
            <h3 class="fw-bold mb-1"><i class="fas fa-ambulance me-2"></i>জরুরি অ্যাম্বুলেন্স প্রয়োজন?</h3>
            <p class="mb-0">আমরা ২৪/৭ আপনার পাশে আছি।</p>
        </div>
        <a href="tel:+8801711XXXXXX" class="btn btn-light text-danger fw-bold rounded-pill px-5 py-3 shadow">
            <i class="fas fa-phone-alt me-2"></i>কল করুন: ০ ১ ৭ ১ ১ . . .
        </a>
    </div>
</section>


@endsection
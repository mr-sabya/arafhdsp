<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - ARAF Human Development</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.html">
                <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- 'align-items-center' added for vertical alignment -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="index.html">হোম</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html">সেবাসমূহ</a></li>
                    <li class="nav-item"><a class="nav-link" href="diagnostic.html">ডায়াগনস্টিক</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospitals.html">হাসপাতাল</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">আমাদের সম্পর্কে</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">যোগাযোগ</a></li>

                    <!-- New Register Button with Design -->
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" href="register.html">
                            <i class="fas fa-user-plus me-2"></i>রেজিস্ট্রেশন
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="hero text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2">স্বাস্থ্যসেবা ও মানবিক উন্নয়ন</span>
                    <h1 class="display-3 fw-bold mb-4">আপনার সুস্বাস্থ্য ও উন্নত জীবনের<br>বিশ্বস্ত সহযোগী</h1>
                    <p class="lead mb-5 opacity-75">আমরা নিশ্চিত করি সঠিক স্বাস্থ্যসেবা, আর্থিক স্বচ্ছতা এবং দায়িত্বশীল
                        জীবনযাপন। যোগ দিন আমাদের বিশাল পরিবারে এবং উপভোগ করুন ৫০% পর্যন্ত ডিসকাউন্ট।</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="register.html" class="btn btn-light btn-lg text-primary fw-bold px-5">মেম্বার হোন</a>
                        <a href="#services" class="btn btn-outline-light btn-lg px-5">সার্ভিস দেখুন</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- News Ticker -->
    <div class="bg-dark text-white py-2">
        <div class="container d-flex align-items-center">
            <span class="badge bg-danger me-3">আপডেট</span>
            <marquee behavior="scroll" direction="left">
                User ID ও Password গ্রহণের জন্য আবেদন চলছে... | ৫০% পর্যন্ত মেডিকেল ডিসকাউন্ট সুবিধা গ্রহণ করুন |
                ফ্যামিলি প্যাকেজে বিশেষ ছাড়।
            </marquee>
        </div>
    </div>

    <!-- About & Mission -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=800&auto=format&fit=crop"
                        class="img-fluid rounded-4 shadow" alt="About Us">
                </div>
                <div class="col-lg-6">
                    <h4 class="text-primary fw-bold">আমাদের সম্পর্কে</h4>
                    <h2 class="mb-4 fw-bold">ARAF Human Development Service Program</h2>
                    <p class="text-muted">আমরা একটি সেবামূলক প্রতিষ্ঠান যা মানুষের জীবনযাত্রার মান উন্নয়ন, স্বাস্থ্য
                        সচেতনতা (NCD প্রতিরোধ) এবং আর্থিক সুরক্ষা নিশ্চিত করতে কাজ করে যাচ্ছি। আমাদের লক্ষ্য হলো একটি
                        দায়িত্বশীল সমাজ গড়ে তোলা।</p>

                    <div class="row mt-4">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">স্বচ্ছ হিসাব</h6>
                                    <small>শতভাগ আর্থিক স্বচ্ছতা</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-md text-success fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">দক্ষ ডাক্তার</h6>
                                    <small>বিশেষজ্ঞ পরামর্শ</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#rules" class="btn btn-outline-primary mt-3">আরও জানুন <i
                            class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section id="services" class="py-5 bg-light">
        <div class="container">
            <div class="section-title">
                <h2>আমাদের প্রধান সেবাসমূহ</h2>
                <p class="text-muted">এক ছাদের নিচে সকল স্বাস্থ্য ও লাইফস্টাইল সমাধান</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="icon mb-4">
                            <i class="fas fa-stethoscope fa-3x text-primary"></i>
                        </div>
                        <h5>প্রাথমিক চিকিৎসা</h5>
                        <p class="text-muted small">বমি, সর্দি, জ্বর, ব্যথা ও সাধারণ রোগের দ্রুত ও সঠিক চিকিৎসা সেবা।
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="icon mb-4">
                            <i class="fas fa-flask fa-3x text-success"></i>
                        </div>
                        <h5>ল্যাব টেস্ট ডিসকাউন্ট</h5>
                        <p class="text-muted small">RBS, CRP, হরমোন, লিভার ও কিডনি টেস্টে ২০% থেকে ৫০% পর্যন্ত ছাড়।</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="icon mb-4">
                            <i class="fas fa-procedures fa-3x text-danger"></i>
                        </div>
                        <h5>সার্জারি সহায়তা</h5>
                        <p class="text-muted small">বড় ধরনের চিকিৎসা ও অপারেশনের ক্ষেত্রে বিশেষ আর্থিক ও পরামর্শ সহায়তা।
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="icon mb-4">
                            <i class="fas fa-brain fa-3x text-warning"></i>
                        </div>
                        <h5>কাউন্সেলিং ও মোটিভেশন</h5>
                        <p class="text-muted small">মানসিক স্বাস্থ্য, ডিপ্রেশন, শিশু বিকাশ ও পারিবারিক সমস্যার সমাধান।
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="icon mb-4">
                            <i class="fas fa-users fa-3x text-info"></i>
                        </div>
                        <h5>ফ্যামিলি সাপোর্ট</h5>
                        <p class="text-muted small">পরিবারের ৫ জন সদস্যের জন্য মাত্র ৪০০ টাকায় স্বাস্থ্য সুরক্ষা
                            প্যাকেজ।</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="icon mb-4">
                            <i class="fas fa-pills fa-3x text-secondary"></i>
                        </div>
                        <h5>ওষুধ সহায়তা</h5>
                        <p class="text-muted small">প্রেসক্রিপশন অনুযায়ী ওষুধ ক্রয়ে ১০% থেকে ৩০% পর্যন্ত নিশ্চিত ছাড়।
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Counter -->
    <section class="stat-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">৫০০+</h2>
                    <p class="text-white-50">সন্তুষ্ট সদস্য</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">৫০%</h2>
                    <p class="text-white-50">সর্বোচ্চ ডিসকাউন্ট</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">২০+</h2>
                    <p class="text-white-50">বিশেষজ্ঞ ডাক্তার</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold">২৪/৭</h2>
                    <p class="text-white-50">জরুরি সেবা</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Discount Chart (Visual) -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">স্বাস্থ্য পরীক্ষায় বিশাল ছাড়!</h2>
                    <p class="lead text-muted">আমাদের সদস্যদের জন্য দেশের স্বনামধন্য ল্যাব ও হাসপাতালে বিশেষ সুবিধা।</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i>ব্লাড টেস্ট (CBC/CRP) -
                            ৫০% পর্যন্ত</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i>হরমোন ও ভিটামিন - ৩০%
                            পর্যন্ত</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i>আল্ট্রাসনোগ্রাম ও এক্স-রে
                            - ২০% পর্যন্ত</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="card shadow border-0">
                        <div class="card-body p-4">
                            <h5 class="mb-4">ডিসকাউন্ট মিটার</h5>

                            <label class="fw-bold">RBS / CRP / CBC</label>
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%;">৫০% ছাড়
                                </div>
                            </div>

                            <label class="fw-bold">হরমোন টেস্ট</label>
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%;">৩০% ছাড়</div>
                            </div>

                            <label class="fw-bold">ওষুধ ও সার্জারি</label>
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-warning text-dark" role="progressbar" style="width: 25%;">
                                    ২৫% ছাড়</div>
                            </div>

                            <label class="fw-bold">কিডনি ও লিভার টেস্ট</label>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%;">২০% ছাড়</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section id="pricing" class="py-5 bg-light">
        <div class="container">
            <div class="section-title">
                <h2>সার্ভিস প্যাকেজ ও মূল্য</h2>
                <p>সব শ্রেণীর মানুষের জন্য আমাদের সাশ্রয়ী প্যাকেজ</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Plan 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card price-card h-100 text-center p-4">
                        <h5 class="fw-bold text-muted">সাধারণ</h5>
                        <h2 class="fw-bold text-primary my-3">৳১০০</h2>
                        <ul class="list-unstyled text-start small mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>প্রাথমিক চিকিৎসা</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>ওষুধে ১০% ছাড়</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>হেলথ টিপস</li>
                        </ul>
                        <a href="register.html" class="btn btn-outline-primary w-100 mt-auto">বাছাই করুন</a>
                    </div>
                </div>
                <!-- Plan 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card price-card h-100 text-center p-4 border-primary">
                        <div class="popular-badge">Best</div>
                        <h5 class="fw-bold text-primary">ফ্যামিলি / বিশেষ</h5>
                        <h2 class="fw-bold text-primary my-3">৳২০০</h2>
                        <ul class="list-unstyled text-start small mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>২ জন সদস্য / ফ্যামিলি</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>বিশেষজ্ঞ ডাক্তার</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>টেস্টে ২০% ছাড়</li>
                        </ul>
                        <a href="register.html" class="btn btn-primary w-100 mt-auto">বাছাই করুন</a>
                    </div>
                </div>
                <!-- Plan 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card price-card h-100 text-center p-4">
                        <h5 class="fw-bold text-muted">মেডিকেল</h5>
                        <h2 class="fw-bold text-primary my-3">৳৩০০</h2>
                        <ul class="list-unstyled text-start small mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>জরুরি চিকিৎসা</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>ল্যাব টেস্টে ৫০% ছাড়</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>১০ জনের গ্রুপ সুবিধা</li>
                        </ul>
                        <a href="register.html" class="btn btn-outline-primary w-100 mt-auto">বাছাই করুন</a>
                    </div>
                </div>
                <!-- Plan 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="card price-card h-100 text-center p-4">
                        <h5 class="fw-bold text-muted">সার্জারি</h5>
                        <h2 class="fw-bold text-primary my-3">৳৫০০</h2>
                        <ul class="list-unstyled text-start small mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>অপারেশন সহায়তা</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>হাসপাতাল কেবিন সুবিধা</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>৩০% বিশেষ ছাড়</li>
                        </ul>
                        <a href="register.html" class="btn btn-outline-primary w-100 mt-auto">বাছাই করুন</a>
                    </div>
                </div>
            </div>

            <div class="alert alert-info mt-5 text-center shadow-sm">
                <strong><i class="fas fa-calculator me-2"></i>হিসাবের উদাহরণ:</strong> পরিবার (৫ জন) = ৪০০ টাকা | বিশেষ
                সার্ভিস = ৫০০ টাকা (৩০% ছাড়ে ৩৫০ টাকা)।
            </div>
        </div>
    </section>

    <!-- Responsibility & Financial Rules -->
    <section id="rules" class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-header bg-primary text-white p-3">
                            <h4 class="mb-0"><i class="fas fa-tasks me-2"></i>সদস্যদের দায়িত্বসমূহ</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fas fa-check text-primary me-2"></i>সঠিক তথ্য
                                    প্রদান করা ও নিয়ম মেনে চলা।</li>
                                <li class="list-group-item"><i class="fas fa-check text-primary me-2"></i>NCD প্রতিরোধ ও
                                    স্বাস্থ্য সচেতনতা তৈরি।</li>
                                <li class="list-group-item"><i class="fas fa-check text-primary me-2"></i>সময়মতো রিপোর্ট
                                    প্রদান ও আপডেট করা।</li>
                                <li class="list-group-item"><i class="fas fa-check text-primary me-2"></i>দায়িত্বশীল
                                    আচরণ ও দলগত অংশগ্রহণ।</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-header bg-success text-white p-3">
                            <h4 class="mb-0"><i class="fas fa-hand-holding-usd me-2"></i>আর্থিক নিয়মাবলী</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>অর্থ
                                    ব্যবস্থাপনায় শতভাগ স্বচ্ছতা বজায় রাখা।</li>
                                <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>নিয়মিত হিসাব
                                    রাখা ও সঠিক সময়ে জমা দেওয়া।</li>
                                <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>নির্ধারিত নিয়ম
                                    অনুযায়ী অর্থ প্রদানে দায়িত্বশীল হওয়া।</li>
                                <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>সদস্যরা
                                    শর্তসাপেক্ষে <strong>৫০% পর্যন্ত সুবিধা</strong> পাবেন।</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Join (Timeline) -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title">
                <h2>যোগদানের প্রক্রিয়া</h2>
                <p class="text-muted">সহজ ৪টি ধাপে আমাদের পরিবারের সদস্য হোন</p>
            </div>

            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="timeline-step text-center">
                        <div class="mb-3">
                            <span
                                class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; font-weight: bold;">১</span>
                        </div>
                        <h5>ফর্ম পূরণ</h5>
                        <p class="small text-muted">আপনার নাম, ঠিকানা ও প্রয়োজনীয় তথ্য দিয়ে ফর্মটি পূরণ করুন।</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="timeline-step text-center" style="border-left-color: #198754;">
                        <div class="mb-3">
                            <span
                                class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; font-weight: bold;">২</span>
                        </div>
                        <h5>প্যাকেজ নির্বাচন</h5>
                        <p class="small text-muted">আপনার প্রয়োজন অনুযায়ী ১০০-৫০০ টাকার প্যাকেজ বেছে নিন।</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="timeline-step text-center" style="border-left-color: #ffc107;">
                        <div class="mb-3">
                            <span
                                class="bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; font-weight: bold;">৩</span>
                        </div>
                        <h5>সাবমিট</h5>
                        <p class="small text-muted">তথ্য যাচাই করে সাবমিট করুন এবং কনগ্র্যাচুলেশন মেসেজ দেখুন।</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="timeline-step text-center" style="border-left-color: #0dcaf0;">
                        <div class="mb-3">
                            <span
                                class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; font-weight: bold;">৪</span>
                        </div>
                        <h5>আইডি গ্রহণ</h5>
                        <p class="small text-muted">কর্তৃপক্ষ যাচাই শেষে আপনাকে User ID ও Password প্রদান করবে।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">আপনি কি আপনার স্বাস্থ্য সুরক্ষা নিয়ে চিন্তিত?</h2>
            <p class="lead mb-4">আর দেরি না করে আজই আরাফ হিউম্যান ডেভেলপমেন্ট সার্ভিসের সদস্য হোন।</p>
            <a href="register.html" class="btn btn-warning btn-lg text-dark fw-bold px-5 rounded-pill shadow">আবেদন
                করুন</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <a class="navbar-brand fw-bold text-primary" href="index.html">
                        <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
                    </a>
                    <p class="small">মানুষের কল্যাণে, স্বাস্থ্যের নিরাপত্তায়। আমাদের লক্ষ্য একটি সুস্থ ও সচেতন সমাজ গড়ে
                        তোলা।</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-3">দ্রুত লিঙ্ক</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#home">হোম</a></li>
                        <li><a href="#services">সেবাসমূহ</a></li>
                        <li><a href="#pricing">প্যাকেজ</a></li>
                        <li><a href="register.html">রেজিস্ট্রেশন</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">সার্ভিসসমূহ</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#">প্রাথমিক চিকিৎসা</a></li>
                        <li><a href="#">চক্ষু ও চর্ম বিশেষজ্ঞ</a></li>
                        <li><a href="#">ডায়াবেটিস চেকআপ</a></li>
                        <li><a href="#">মানসিক স্বাস্থ্য</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">যোগাযোগ</h5>
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-map-marker-alt me-2"></i>কয়রা সদর, কয়রা, খুলনা</li>
                        <li><i class="fas fa-phone me-2"></i>+৮৮০ ১৭১১-XXXXXX</li>
                        <li><i class="fas fa-envelope me-2"></i>info@arafhds.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center small">
                <p class="mb-0">&copy; ২০২৫ ARAF Human Development Service Program. সর্বস্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
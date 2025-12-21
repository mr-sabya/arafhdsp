@extends('frontend.layouts.app')

@section('content')

<header class="page-header">
    <div class="container">
        <h1 class="fw-bold">যোগাযোগ করুন</h1>
        <p>যেকোনো প্রয়োজনে আমাদের সাথে যোগাযোগ করুন</p>
    </div>
</header>

<div class="container mb-5">
    <div class="row g-5">
        <div class="col-lg-6">
            <h3 class="mb-4 text-primary">আমাদের ঠিকানা</h3>
            <div class="d-flex mb-3">
                <i class="fas fa-map-marker-alt fa-2x text-primary me-3"></i>
                <div>
                    <h5>অফিস লোকেশন</h5>
                    <p class="text-muted">কয়রা সদর, কয়রা, খুলনা</p>
                </div>
            </div>
            <div class="d-flex mb-3">
                <i class="fas fa-phone-alt fa-2x text-success me-3"></i>
                <div>
                    <h5>মোবাইল নম্বর</h5>
                    <p class="text-muted">+৮৮০ ১৭১১-XXXXXX<br>+৮৮০ ১৯১১-XXXXXX</p>
                </div>
            </div>
            <div class="d-flex mb-3">
                <i class="fas fa-envelope fa-2x text-warning me-3"></i>
                <div>
                    <h5>ইমেইল</h5>
                    <p class="text-muted">info@arafhds.com</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm p-4">
                <h4 class="mb-3">বার্তা পাঠান</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label">আপনার নাম</label>
                        <input type="text" class="form-control" placeholder="নাম লিখুন">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ফোন নম্বর</label>
                        <input type="text" class="form-control" placeholder="মোবাইল নম্বর">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">বার্তা</label>
                        <textarea class="form-control" rows="4" placeholder="আপনার প্রশ্ন লিখুন..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">মেসেজ পাঠান</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Google Map Embed -->
    <div class="mt-5">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9024424301377!2d90.39108031536267!3d23.75085809467771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b888ad3b91bf%3A0xbcb78432250119d8!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1625562145698!5m2!1sen!2sbd"
            width="100%" height="400" style="border:0; border-radius: 10px;" allowfullscreen=""
            loading="lazy"></iframe>
    </div>
</div>

@endsection
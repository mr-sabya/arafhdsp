@extends('frontend.layouts.app')

@section('content')
<!-- Main Registration Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card reg-card">
                <div class="reg-header">
                    <h2 class="fw-bold mb-2">সদস্য আবেদন ফরম</h2>
                    <p class="mb-0 opacity-75">সঠিক তথ্য দিয়ে নিচের ফরমটি পূরণ করুন</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="#" method="POST">

                        <!-- Section 1: Personal Info -->
                        <h5 class="form-section-title"><i class="fas fa-user"></i> ব্যক্তিগত তথ্য</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">আবেদনকারীর নাম <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="আপনার পূর্ণ নাম লিখুন"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">পিতা / স্বামীর নাম</label>
                                <input type="text" class="form-control" placeholder="নাম লিখুন">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" placeholder="017xxxxxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">জন্ম তারিখ</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">রক্তের গ্রুপ <span class="text-danger">*</span></label>
                                <select class="form-select" required>
                                    <option value="" selected disabled>বাছাই করুন</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">জাতীয় পরিচয়পত্র / জন্মনিবন্ধন নং</label>
                                <input type="text" class="form-control" placeholder="NID Number">
                            </div>
                        </div>

                        <!-- Section 2: Address -->
                        <h5 class="form-section-title"><i class="fas fa-map-marker-alt"></i> ঠিকানা</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">জেলা</label>
                                <input type="text" class="form-control" placeholder="আপনার জেলা">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">থানা / উপজেলা</label>
                                <input type="text" class="form-control" placeholder="থানা">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">গ্রাম / এলাকা</label>
                                <input type="text" class="form-control" placeholder="গ্রাম">
                            </div>
                        </div>

                        <!-- Section 3: Package Selection -->
                        <h5 class="form-section-title"><i class="fas fa-box-open"></i> প্যাকেজ নির্বাচন</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">প্যাকেজ লেভেল <span class="text-danger">*</span></label>
                                <select class="form-select" id="packageSelect" onchange="updatePrice()" required>
                                    <option value="" selected disabled>প্যাকেজ বাছাই করুন...</option>
                                    <option value="100">লেভেল ১ - সাধারণ (৳১০০)</option>
                                    <option value="200">লেভেল ২ - ফ্যামিলি / বিশেষ (৳২০০)</option>
                                    <option value="300">লেভেল ৩ - মেডিকেল / গ্রুপ (৳৩০০)</option>
                                    <option value="500">লেভেল ৪ - সার্জারি সাপোর্ট (৳৫০০)</option>
                                </select>
                            </div>

                            <!-- Dynamic Family Member Field (Hidden by default) -->
                            <div class="col-md-6 d-none" id="familyMembersField">
                                <label class="form-label">মোট ফ্যামিলি সদস্য সংখ্যা</label>
                                <input type="number" class="form-control" placeholder="যেমন: ৫">
                            </div>

                            <div class="col-12 mt-3">
                                <div class="price-display">
                                    <h5 class="mb-0 text-muted">আপনার মোট ফি: <span
                                            class="text-primary fw-bold display-6" id="totalPrice">৳০</span></h5>
                                    <small class="text-danger" id="priceNote"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Nominee & Password -->
                        <h5 class="form-section-title"><i class="fas fa-shield-alt"></i> নমিনি ও নিরাপত্তা</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">নমিনি নাম (ঐচ্ছিক)</label>
                                <input type="text" class="form-control" placeholder="নমিনির নাম">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">নমিনির সাথে সম্পর্ক</label>
                                <input type="text" class="form-control" placeholder="যেমন: স্ত্রী / ভাই">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">পাসওয়ার্ড সেট করুন <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" required placeholder="******">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ছবি আপলোড করুন (Passport Size)</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>

                        <!-- Terms & Submit -->
                        <div class="mt-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label small" for="termsCheck">
                                    আমি এই মর্মে অঙ্গীকার করছি যে, উপরে প্রদত্ত সকল তথ্য সত্য এবং আমি <a href="#"
                                        class="text-primary">প্রতিষ্ঠানের নিয়মাবলী</a> মেনে চলতে বাধ্য থাকব।
                                </label>
                            </div>
                            <div class="d-grid">
                                <button type="submit"
                                    class="btn btn-primary btn-register rounded-pill text-white fw-bold">
                                    আবেদন জমা দিন <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
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
@endsection
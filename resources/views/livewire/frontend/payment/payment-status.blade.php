<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- উপরের রঙিন বার -->
                <div class="status-top-bar {{ auth()->user()->application_status == 'approved' ? 'bg-success' : 'bg-warning' }}"></div>

                <div class="card-body p-5 text-center">
                    @if(auth()->user()->application_status == 'pending')
                    <!-- পেন্ডিং স্টেট -->
                    <div class="status-icon text-warning mb-4">
                        <i class="fas fa-clock fa-spin-slow animate-pulse"></i>
                    </div>
                    <h2 class="fw-bold mb-3">আবেদনটি প্রক্রিয়াধীন আছে</h2>
                    <div class="alert alert-soft-warning border-0 rounded-3 mb-4">
                        <p class="mb-0 text-dark">
                            আপনার <strong>৳ {{ number_format(auth()->user()->total_price, 2) }}</strong> পেমেন্ট এবং ট্রানজেকশন আইডি ({{ auth()->user()->transaction_id }}) আমাদের সার্ভারে জমা হয়েছে।
                        </p>
                    </div>
                    <p class="text-muted mb-4 fs-6">আমাদের প্রতিনিধি আপনার তথ্য যাচাই করছেন। সাধারণত ২৪-৪৮ ঘণ্টার মধ্যে অ্যাকাউন্ট সক্রিয় করে দেওয়া হয়। আপনার ধৈর্য্যর জন্য ধন্যবাদ।</p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="/" wire:navigate class="btn btn-outline-primary px-4 py-2 rounded-pill fw-bold">
                            <i class="fas fa-home me-2"></i> হোমে ফিরে যান
                        </a>
                    </div>

                    @elseif(auth()->user()->application_status == 'approved')
                    <!-- এপ্রুভড স্টেট -->
                    <div class="status-icon text-success mb-4">
                        <i class="fas fa-check-circle scale-up"></i>
                    </div>
                    <h2 class="fw-bold text-success mb-2">অভিনন্দন!</h2>
                    <h4 class="mb-3">আপনার অ্যাকাউন্ট এখন সক্রিয়</h4>
                    <p class="text-muted mb-4">আপনার পেমেন্ট সফলভাবে যাচাই করা হয়েছে। আপনি এখন আমাদের সকল ডিজিটাল সেবা এবং ড্যাশবোর্ড ব্যবহার করতে পারবেন।</p>

                    <div class="d-grid gap-2 col-md-8 mx-auto">
                        <a href="{{ route('dashboard') }}" wire:navigate class="btn btn-success btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm">
                            <i class="fas fa-tachometer-alt me-2"></i> ড্যাশবোর্ডে প্রবেশ করুন
                        </a>
                    </div>

                    @elseif(auth()->user()->application_status == 'rejected')
                    <!-- রিজেক্টেড স্টেট (অতিরিক্ত নিরাপত্তা হিসেবে রাখা হয়েছে) -->
                    <div class="status-icon text-danger mb-4">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <h2 class="fw-bold text-danger mb-2">আবেদনটি গৃহীত হয়নি</h2>
                    <p class="text-muted mb-4">দুঃখিত, আপনার দেওয়া তথ্যে বা পেমেন্টে কোনো অসংগতি পাওয়া গেছে। বিস্তারিত জানতে আমাদের সাপোর্টে যোগাযোগ করুন।</p>
                    <a href="tel:01XXXXXXXXX" class="btn btn-danger rounded-pill px-4">যোগাযোগ করুন</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
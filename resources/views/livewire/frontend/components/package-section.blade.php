<section id="pricing" class="py-5 pricing-section bg-light">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase">Pricing Plans</h6>
            <h2 class="fw-bold display-5">সার্ভিস প্যাকেজ ও মূল্য</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                আপনার প্রয়োজন ও সাধ্যের মধ্যে আমরা নিয়ে এসেছি সেরা সব প্যাকেজ। আজই আপনার জন্য সঠিক প্ল্যানটি বেছে নিন।
            </p>
        </div>

        <div class="row g-4 align-items-stretch justify-content-center">
            @foreach($plans as $plan)
            <div class="col-md-6 col-lg-3">
                <div class="card pricing-card h-100 p-4 {{ $plan->is_featured ? 'featured shadow-lg border-primary' : 'border-0 shadow-sm' }}">

                    @if($plan->is_featured && $plan->ribbon_text)
                    <div class="popular-ribbon">{{ $plan->ribbon_text }}</div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <span class="level-badge {{ $plan->is_featured ? 'bg-primary text-white' : 'bg-light text-muted' }}">
                                {{ $plan->level_text }}
                            </span>
                        </div>

                        <h4 class="fw-bold">{{ $plan->name }}</h4>

                        <div class="price-box my-3">
                            @php
                            $displayPrice = $plan->price;
                            if($plan->discount_percentage > 0) {
                            $displayPrice = $plan->price - ($plan->price * ($plan->discount_percentage / 100));
                            }
                            @endphp

                            <h2 class="price-tag mb-0 {{ $plan->is_featured ? 'text-primary' : '' }}">
                                <span>৳</span>{{ number_format($displayPrice) }}
                            </h2>

                            @if($plan->discount_percentage > 0)
                            <div class="text-muted small">
                                <del>৳{{ number_format($plan->price) }}</del>
                                <span class="text-danger fw-bold">-{{ $plan->discount_percentage }}%</span>
                            </div>
                            @endif

                            <small class="text-muted fw-bold">
                                / {{ $plan->interval_bn }}
                                @if($plan->pricing_type === 'per_member') (প্রতি জন) @endif
                            </small>
                        </div>

                        <ul class="feature-list flex-grow-1">
                            @if($plan->features)
                            @foreach($plan->features as $feature)
                            <li class="{{ isset($feature['available']) && !$feature['available'] ? 'text-muted opacity-50' : '' }}">
                                @if(isset($feature['available']) && !$feature['available'])
                                <i class="fas fa-times-circle text-danger"></i>
                                @else
                                <i class="fas fa-check-circle text-success"></i>
                                @endif
                                {{ $feature['text'] }}
                            </li>
                            @endforeach
                            @endif
                        </ul>

                        <a href="{{ route('register', ['plan' => $plan->id]) }}"
                            class="btn {{ $plan->is_featured ? 'btn-primary' : 'btn-outline-primary' }} btn-pricing w-100 mt-4 shadow-sm">
                            বাছাই করুন
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Calculation Helper (Dynamic Examples) -->
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-9">
                <div class="alert calc-alert text-center p-4 shadow-sm border-0 bg-white">
                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                        <span class="badge bg-primary me-2 mb-2 mb-md-0 px-3 py-2">হিসাবের উদাহরণ</span>
                        <span class="text-dark">
                            @foreach($plans as $plan)
                            @if($plan->pricing_type === 'per_member' && isset($plan->pricing_rules['fixed_price_for_5']))
                            <strong>{{ $plan->name }}:</strong> ৫ জনের পরিবার মাত্র ৳{{ $plan->pricing_rules['fixed_price_for_5'] }} |
                            @endif
                            @if($plan->discount_percentage > 0)
                            <strong>{{ $plan->name }}:</strong> {{ $plan->discount_percentage }}% ছাড়ে মাত্র ৳{{ number_format($plan->price * (1 - $plan->discount_percentage/100)) }}!
                            @endif
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@extends('frontend.layouts.app')

@section('content')
<!-- Page Header -->
<livewire:frontend.components.page-header
    badge="মেম্বারশিপ প্ল্যান"
    title="আমাদের প্যাকেজ ও সুবিধাসমূহ"
    subtitle="স্বল্প খরচে উন্নত সেবা নিশ্চিত করতে আপনার পছন্দের প্যাকেজটি বেছে নিন" />

<!-- Pricing Section -->
<livewire:frontend.components.package-section />

<!-- Calculation & Details -->
<livewire:frontend.components.calculation />

@endsection
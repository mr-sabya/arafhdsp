@extends('frontend.layouts.app')

@section('content')
<!-- Page Header -->
<livewire:frontend.components.page-header
    badge="মেম্বারশিপ প্ল্যান"
    title="ডায়াগনস্টিক ও প্যাথলজি সেবা"
    subtitle="আধুনিক ল্যাব ও নির্ভুল রিপোর্টের নিশ্চয়তা | সর্বোচ্চ ৫০% পর্যন্ত ছাড়" />

<!-- Search Section -->
<livewire:frontend.diagnostic.search />

<!-- Diagnostic Cards Grid -->
<livewire:frontend.diagnostic.index />

<!-- Why Choose Us -->
<livewire:frontend.components.why-choose />

@endsection
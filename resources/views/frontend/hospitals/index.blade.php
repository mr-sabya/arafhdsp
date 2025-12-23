@extends('frontend.layouts.app')

@section('content')

<!-- Page Header -->
<livewire:frontend.components.page-header
    badge="মেম্বারশিপ প্ল্যান"
    title="হাসপাতাল ও বিশেষজ্ঞ ডাক্তার"
    subtitle="সেরা চিকিৎসকদের পরামর্শ ও আধুনিক হাসপাতাল সুবিধা | ৩০% পর্যন্ত ছাড়" />


<!-- Search Section -->
<livewire:frontend.hospital.search />

<!-- Departments Section -->
<livewire:frontend.hospital.departments />

<!-- Doctors Grid -->
<livewire:frontend.hospital.doctors />

<!-- Partner Hospitals Grid -->
<livewire:frontend.hospital.hospitals />

<!-- Emergency CTA -->
<livewire:frontend.hospital.cta />

@endsection
@extends('frontend.layouts.app')

@section('content')
<!-- Hero Section -->
<livewire:frontend.components.hero-section />

<!-- News Ticker -->
<livewire:frontend.components.news-ticker />

<!-- About & Mission -->
<livewire:frontend.components.about-section />

<!-- Services Grid -->
<livewire:frontend.components.service-section />

<!-- Stats Counter -->
<livewire:frontend.components.counter-section />

<!-- Discount Chart (Visual) -->
<livewire:frontend.components.discount-section />

<!-- Pricing Packages -->
<livewire:frontend.components.package-section />

<!-- Responsibility & Financial Rules -->
<livewire:frontend.components.rules-section />

<!-- How to Join (Timeline) -->
<livewire:frontend.components.timeline-section />

<!-- Call to Action -->
<livewire:frontend.components.call-to-action />

@endsection
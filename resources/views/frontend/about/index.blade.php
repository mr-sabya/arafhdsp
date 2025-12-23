@extends('frontend.layouts.app')

@section('content')
<!-- Page Header -->
<livewire:frontend.components.page-header
    badge="About"
    title="আমাদের সম্পর্কে"
    subtitle="আমাদের লক্ষ্য, উদ্দেশ্য ও কার্যক্রম" />


<!-- about page -->
<livewire:frontend.about.index />

@endsection
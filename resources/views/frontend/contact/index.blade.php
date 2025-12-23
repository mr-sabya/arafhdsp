@extends('frontend.layouts.app')

@section('content')
<!-- Page Header -->
<livewire:frontend.components.page-header
    badge="Contact"
    title="যোগাযোগ করুন"
    subtitle="যেকোনো প্রয়োজনে আমাদের সাথে যোগাযোগ করুন" />

<!-- contact page -->
<livewire:frontend.contact.index />

@endsection
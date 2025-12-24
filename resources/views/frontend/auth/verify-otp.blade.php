@extends('frontend.layouts.app')

@section('content')
<livewire:frontend.auth.verify-otp mobile="{{ $user->mobile }}" />
@endsection
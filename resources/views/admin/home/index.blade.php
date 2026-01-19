@extends('admin.layouts.app')

@section('content')
<livewire:admin.home.index />
@endsection

@push('scripts')
<!-- apexcharts -->
<script data-navigate-once src="{{ asset('assets/backend/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector map-->
<script data-navigate-once src="{{ asset('assets/backend/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script data-navigate-once src="{{ asset('assets/backend/libs/jsvectormap/maps/world-merc.js') }}"></script>
@endpush
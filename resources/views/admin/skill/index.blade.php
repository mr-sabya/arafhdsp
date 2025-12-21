@extends('admin.layouts.app')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Skill Management</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" wire:navigate>Dashboard</a></li>
                    <li class="breadcrumb-item active">Skills</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<livewire:admin.skill.manage />

@endsection
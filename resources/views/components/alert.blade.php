<!-- resources/views/components/alert.blade.php -->
<div x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        icon: 'ri-checkbox-circle-line' 
    }"
    x-on:notify.window="
        show = true; 
        message = $event.detail.message; 
        type = $event.detail.type || 'success';
        icon = (type === 'success') ? 'ri-checkbox-circle-line' : 'ri-error-warning-line';
        setTimeout(() => show = false, 5000)
    "
    x-show="show"
    x-transition.duration.500ms
    style="display: none; position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 250px;">

    <div :class="'alert alert-' + type + ' shadow-lg border-0 d-flex align-items-center'" role="alert">
        <i :class="icon + ' me-2 fs-5'"></i>
        <div>
            <span x-text="message"></span>
        </div>
        <button type="button" class="btn-close ms-auto" @click="show = false"></button>
    </div>
</div>

<!-- Support for standard Session Flash (for non-livewire redirects) -->
@if (session()->has('success'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
    style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 250px;">
    <div class="alert alert-success shadow-lg border-0 d-flex align-items-center">
        <i class="ri-checkbox-circle-line me-2 fs-5"></i>
        {{ session('success') }}
        <button type="button" class="btn-close ms-auto" @click="show = false"></button>
    </div>
</div>
@endif
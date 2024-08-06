@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Genius Auto Ecole - POS')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/dropzone/dropzone.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/bs-stepper/bs-stepper.scss', 'resources/assets/vendor/libs/rateyo/rateyo.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/wizard-ex-checkout.scss', 'resources/assets/vendor/scss/pages/front-page-payment.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')

    @vite(['resources/assets/vendor/libs/dropzone/dropzone.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/jquery/jquery.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/bs-stepper/bs-stepper.js', 'resources/assets/vendor/libs/rateyo/rateyo.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/forms-file-upload.js', 'resources/assets/js/modal-add-new-address.js', 'resources/assets/js/wizard-ex-checkout.js', 'resources/assets/js/pages-pricing.js', 'resources/assets/js/front-page-payment.js'])
@endsection

@livewireStyles()
@section('content')
    @livewire('wizard-form', ['categories' => $categories, 'subventions' => $subventions, 'sources' => $sources, 'pieces' => $pieces])
    <!-- Add new address modal -->
    @include('_partials/_modals/modal-add-new-address')
@endsection



@livewireScripts()

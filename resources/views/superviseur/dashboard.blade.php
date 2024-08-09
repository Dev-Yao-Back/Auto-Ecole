@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
    $pageConfigs = ['myLayout' => 'blank'];
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Superviseur Dashboard - Apps')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])

    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])

    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/dashboards-crm.js'])

    @vite(['resources/assets/js/app-ecommerce-product-list.js'])
@endsection

@livewireStyles()


@section('content')
    <h4 class="container-fluid py-3 mb-4">
        <span class="text-muted fw-light"> <a href="/admin">Superviseur</a> /</span> Dashboard
    </h4>

    <!-- Product List Widget -->
    @livewire('superviseur')

    @livewireScripts()
@endsection

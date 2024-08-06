@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Coming Soon - Pages')

@section('page-style')
    <!-- Page -->
    @vite('resources/assets/vendor/scss/pages/page-misc.scss')
@endsection

@section('content')
    <!-- Coming soon -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-1 mx-2 bg-body-tertiary focus-ring-success">Félication Vous avez été Prinscrit</h2>
            <h4 class="mb-4 mx-2 ql-color-green">Passer au bureau avec votre récu pour completr votre candidature</h4>
            <form onsubmit="return false" class="mb-4">
                <div class="mb-0">
                    @if (session('moyen_payement') == 'Cash')
                        <p class="mb-0">Vous pouvez passer au Bureau pour effectuer votre</p>
                    @elseif (session('moyen_payement') == 'Wave')
                        <a href="" class="btn btn-primary">Passer au Paiement</a>
                    @else
                    @endif

                </div>
            </form>
            <div class="mt-4">
                <img src="{{ asset('assets/img/illustrations/page-misc-launching-soon.png') }}"
                    alt="page-misc-launching-soon" width="263" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container-fluid misc-bg-wrapper">
        <img src="{{ asset('assets/img/illustrations/bg-shape-image-' . $configData['style'] . '.png') }}"
            alt="page-misc-coming-soon" data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png">
    </div>
    <!-- /Coming soon -->
@endsection

@if (session('downloadPdf'))
    <script>
        window.onload = function() {
            var path = "{{ session('path_to_pdf') }}";
            var a = document.createElement('A');
            a.href = path;
            a.download = path.substr(path.lastIndexOf('/') + 1);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
@endif

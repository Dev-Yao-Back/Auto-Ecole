@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Genius Auto Ecole - Candidats')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')

    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/bs-stepper/bs-stepper.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/pages-auth-multisteps.js'])
@endsection

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">

            <!-- Left Text -->
            <div
                class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
                <img src="{{ asset('assets/img/cars.jpg') }}" class="img-fluid" Width="100%" height="auto">

            </div>
            <!-- /Left Text -->

            <!-- Multi Steps Registration -->
            <div class="d-flex col-lg-8 align-items-center justify-content-center p-sm-5 p-3">
                <div class="w-px-700">
                    <div id="multiStepsValidation" class=" shadow-none">
                        <!-- Step headers -->
                        <!-- Pricing Free Trial -->
                        <div class="col g-3 g-lg-4 py-2 px-3">

                            <section class="pricing-free-trial bg-label-primary">
                                <div class="container">
                                    <div class="position-relative">
                                        <div
                                            class="d-flex justify-content-between flex-column-reverse flex-lg-row align-items-center py-4 px-5">
                                            <div class="text-center text-lg-start mt-2 ms-3">
                                                <h3 class="text-primary mb-1">Permis Gratuit à Gogo !!!
                                                </h3>
                                                <p class="text-body mb-1">Obtenez votre permis de conduire gratuitement
                                                    grâce à
                                                    nos programmes de subvention. Suivez les étapes
                                                    ci-dessous pour compléter votre inscription.</p>

                                            </div>
                                            <!-- image -->
                                            <div class="text-center">
                                                <img src="{{ asset('assets/img/chauffeur1.png') }}"
                                                    class="img-fluid me-lg-5 pe-lg-1 mb-3 mb-lg-0" alt="Api Key Image"
                                                    width="202">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!--/ Pricing Free Trial -->
                        <!-- Step contents -->
                        @livewire('candidat-online')
                    </div>
                </div>
            </div>
            <!-- / Multi Steps Registration -->


        </div>
    </div>



    <script type="module">
        // Check selected custom option
        window.Helpers.initCustomOptionCheck();
    </script>



@endsection

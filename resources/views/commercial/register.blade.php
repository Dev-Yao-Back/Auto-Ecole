@php
    //  $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
    $isMenu = false;
    $navbarHideToggle = true;
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Inscription Commercial - Pages')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Carte d'Inscription -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' => 'fill: #fff;'])</span>
                                <span
                                    class="app-brand-text demo text-body fw-bold ms-1">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Rejoignez-nous en tant que Commercial 🚀</h4>
                        <p class="mb-4">Élargissez votre réseau et gagnez des commissions en rejoignant notre équipe !</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('commercial.register') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom Complet</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Entrez votre nom complet" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Entrez votre email" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'Utilisateur</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Entrez votre nom d'utilisateur" required>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Mot de Passe</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="referral_code" class="form-label">Code de Parrainage (Optionnel)</label>
                                <input type="text" class="form-control" id="referral_code" name="referral_code"
                                    placeholder="Entrez le code de parrainage si vous en avez un">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms"
                                        required>
                                    <label class="form-check-label" for="terms-conditions">
                                        J'accepte la
                                        <a href="javascript:void(0);">politique de confidentialité & les conditions</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">
                                S'inscrire en tant que Commercial
                            </button>
                        </form>

                        <p class="text-center">
                            <span>Vous avez déjà un compte ?</span>
                            <a href="{{ url('auth/login-basic') }}">
                                <span>Connectez-vous ici</span>
                            </a>
                        </p>

                        <div class="divider my-4">
                            <div class="divider-text">ou</div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                                <i class="tf-icons fa-brands fa-google fs-5"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Carte d'Inscription -->
            </div>
        </div>
    </div>
@endsection

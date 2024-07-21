<div>
    <div class="container-xxl ">
        <section class="authentication-wrapper authentication-basic container-p-y">
            <!-- Checkout Wizard -->
            <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
                <div class="bs-stepper-header m-auto border-0 py-4">
                    <div class="step" data-target="#checkout-data">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-icon">
                                <svg viewBox="0 0 58 54">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icons/wizard-checkout-address.svg#wizardCheckoutAddress') }}">
                                    </use>
                                </svg>
                            </span>
                            <span class="bs-stepper-label">Données</span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="ti ti-chevron-right"> </i>
                    </div>
                    <div class="step" data-target="#checkout-cart">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-icon">
                                <svg viewBox="0 0 58 54">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icons/wizard-checkout-cart.svg#wizardCart') }}">
                                    </use>
                                </svg>
                            </span>
                            <span class="bs-stepper-label">Paiement</span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#checkout-confirmation">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-icon">
                                <svg viewBox="0 0 58 54">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm') }}">
                                    </use>
                                </svg>
                            </span>
                            <span class="bs-stepper-label">Confirmation</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content border-top">

                    @if ($step == 1)
                        <!-- Data -->
                        <div id="checkout-data" class="container">
                            @include('dons.components.register-data')
                        </div>
                    @endif

                    @if ($step == 2)
                        <!-- Cart -->
                        <div id="checkout-cart" class="container">
                            @include('dons.components.cart')
                        </div>
                    @endif

                    @if ($step == 3)
                        <!-- Confirmation -->
                        <div id="checkout-confirmation" class="container">

                            @include('dons.components.confirme')
                                @if($isOpen)
                                    @include('dons.components.modale')
                                @endif
                        </div>
                    @endif


                </div>
            </div>
            <!--/ Checkout Wizard -->
        </section>

    </div>

</div>


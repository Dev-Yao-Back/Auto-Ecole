<div class="row">
    <!-- Cart left -->
    <div class="col-xl-8 mb-3 mb-xl-0">

        @if ($total > $prix_normal)
            <!-- Offer alert -->
            <div class="alert alert-danger mb-3" role="alert">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                        <i class="ti ti-bookmarks ti-sm alert-icon alert-icon-lg"></i>
                    </div>

                    <div class="flex-grow-1">
                        <div class="fw-medium fs-5 mb-2">Le montant total à payer ne doit pas dépasser 180 000 FCFA</div>
                        <ul class="list-unstyled mb-0">
                            <li> - Veuillez tenir compte que le Candidat Bénéfice Déjà une Subvetion de
                                {{ $lib_subvention }}
                            </li>
                            <li> - La Montant payer saisie + la subvention ne doivent pas être supperieur à
                                {{ $prix_normal }}
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="alert alert-success mb-3" role="alert">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                        <i class="ti ti-bookmarks ti-sm alert-icon alert-icon-lg"></i>
                    </div>

                    <div class="flex-grow-1">
                        <div class="fw-medium fs-5 mb-2">Valider la Saisie</div>
                        <ul class="list-unstyled mb-0">
                            <li> - Veuillez vérifier plusieurs fois la somme saisie
                            </li>
                            <li> - Après saisie veillez valider le somme saisie
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <!-- Shopping bag -->
        <h5>Panier</h5>
        <ul class="list-group mb-3">
            <li class="list-group-item p-4">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0 d-flex align-items-center">
                        <img src="{{ asset('assets/img/permis-de-conduire.png') }}" alt="google home" class="w-px-100">
                    </div>
                    <div class="flex-grow-1">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="me-3"><a href="javascript:void(0)" class="text-body">Permis de Conduire -
                                        Catégorie - {{ $lib_categorie }}</a></p>
                                <div class="text-muted mb-2 d-flex flex-wrap"><span class="me-1">Source
                                        :</span> <a href="javascript:void(0)" class="me-3"></a>
                                    <span class="badge bg-label-success">{{ $lib_source }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-md-end">
                                    <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                    <div class="my-2 my-md-4 mb-md-5"><span class="text-primary">
                                            {{ number_format($lib_subvention ?? 0, 0, '', ' ') }} FCFA/</span><s
                                            class="text-muted">180 000 FCFA</s></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

        </ul>

        <h5>Moyen de Paiement</h5>

        <div class="row py-4 my-2">
            <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-basic checked">
                    <label
                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                        for="customRadioVisa">
                        <input name="customRadioTemp" class="form-check-input" type="radio" value="credit-card"
                            id="customRadioVisa" checked />
                        <span class="custom-option-body">
                            <img src="{{ asset('assets/img/finance.png') }}" alt="visa-card" width="46">
                            <span class="ms-3">Cash</span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-basic">
                    <label
                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                        for="customRadioPaypal">
                        <input name="customRadioTemp" class="form-check-input" type="radio" value="paypal"
                            id="customRadioPaypal" />
                        <span class="custom-option-body">
                            <img src="{{ asset('assets/logo/nav-logo.png') }}" alt="visa-card" width="100"> <span
                                class="ms-3"></span>
                        </span>
                    </label>
                </div>
            </div>
        </div>


    </div>

    <!-- Cart right -->
    <div class="col-xl-4">
        <div class="border rounded p-4 mb-3 pb-3">
            <!-- Offer -->
            <h6>Montant à Payer</h6>
            <div class="row g-3 mb-3">
                <div class="col-8 col-xxl-8 col-xl-12">
                    <input type="number" value="{{ $apayer }}"
                        class="form-control @error('montant') is-invalid @enderror" wire:model='montant'
                        placeholder="Montant" aria-label="Enter Promo Code">
                    @error('montant')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4 col-xxl-4 col-xl-12">
                    <div class="d-grid">
                        <button type="button" class="btn btn-label-primary" wire:click='calc_check'>Valider</button>
                    </div>
                </div>
            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Gift wrap -->
            <div class="bg-lighter rounded p-3">
                <p class="fw-medium mb-2">Veuillez vérifier plusieurs fois la somme saisie</p>
            </div>
            <hr class="mx-n4">

            <!-- Price Details -->
            <h6>Détails Paiement</h6>
            <dl class="row mb-0">
                <dt class="col-6 fw-normal text-heading">Prix Normal</dt>
                <dd class="col-6 text-end">{{ number_format($prix_normal ?? 0, 0, '', ' ') }} FCFA</dd>

                <dt class="col-sm-6 fw-normal">Subvention</dt>
                <dd class="col-sm-6 text-end"><a
                        href="javascript:void(0)">{{ number_format($lib_subvention ?? 0, 0, '', ' ') }} FCFA</a></dd>

                <dt class="col-6 fw-normal text-heading">Total à Payer</dt>
                <dd class="col-6 text-end">{{ number_format($apayer ?? 0, 0, '', ' ') }} FCFA</dd>

                <dt class="col-6 fw-normal text-heading">Reste</dt>
                <dd class="col-6 text-end"> <span
                        class="badge bg-label-danger ms-1">{{ number_format($reste ?? 0, 0, '', ' ') }} FCFA</span>
                </dd>

                <dt class="col-6 fw-normal text-heading">Total Payé</dt>
                <dd class="col-6 text-end">
                    <s class="text-muted"> {{ number_format($montant ?? 0, 0, '', ' ') }} FCFA</s>
                </dd>
            </dl>

            <hr class="mx-n4">
            <dl class="row mb-0">
                <dt class="col-6 text-heading">Total</dt>
                <dd class="col-6 fw-medium text-end text-heading mb-0"> {{ number_format($total ?? 0, 0, '', ' ') }}
                    FCFA</dd>
            </dl>
        </div>
        <div class="row gy-2">
            <div class="col d-grid">
                <button class="btn btn-secondary" wire:click='preview_step'>Retour</button>
            </div>
            <div class="col d-grid">
                @if ($total > $prix_normal)
                @else
                    <button class="btn btn-primary" wire:click='next_step'
                        @if ($apayer > $prix_normal) disabled @endif>Continuer</button>
                @endif
            </div>
        </div>
    </div>

</div>

<div>
    <!-- Step contents -->
    <div class="bs-stepper-content">
        <form id="multiStepsForm" onSubmit="return false">

            @if ($step == 1)
                <!-- Personal Information -->
                <div id="personalInfoValidation" class="content">
                    <div class="content-header mb-4">
                        <h3 class="mb-1">Informations Personnelles</h3>
                        <p>Entrez vos informations personnelles</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsFirstName">Prénom</label>
                            <input type="text" wire:model="name" class="form-control" placeholder="Jéremie"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsLastName">Nom</label>
                            <input type="text" wire:model="surname" class="form-control" placeholder="N'da"
                                value="{{ old('surname') }}" required>
                            @error('surname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsEmail">Email</label>
                            <input type="email" wire:model="email" class="form-control"
                                placeholder="jeremie@gmail.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsMobile">Téléphone</label>
                            <input type="text" wire:model="tel_number1" class="form-control" placeholder="🇨🇮"
                                value="{{ old('tel_number1') }}" required>
                            @error('tel_number1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multiStepsGender">Sexe</label>
                            <select wire:model="sexe" class="w-100 form-select">
                                <option selected>Sexe</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Feminin">Feminin</option>
                            </select>
                            @error('sexe')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multiStepsBirthdate">Date de Naissance</label>
                            <input wire:model="date_birth" type="date" class="form-control"
                                value="{{ old('date_birth') }}">
                            @error('date_birth')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="multiStepsCommune">Commune</label>
                            <select wire:model="commune_residence" class="w-100 form-select" required>
                                <option selected>Votre Commune</option>
                                @if ($communes && count($communes) > 0)
                                    @foreach ($communes as $commune)
                                        <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                    @endforeach
                                @else
                                    <option disabled>No communes available</option>
                                @endif

                            </select>
                            @error('commune_residence')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="multiStepsCategorie">Catégorie</label>
                            <select name="categorie_permis_id" wire:model="categorie_permis_id"
                                class="w-100 form-select" required>
                                <option selected>Votre Catégorie </option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">
                                        {{ $categorie->type }}</option>
                                @endforeach
                            </select>
                            @error('categorie_permis_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="multiStepsSubvention">Subvention</label>
                            <select name="subvention_id" wire:model="subvention_id" id="multiStepsSubvention"
                                class="w-100 form-select">
                                <option selected>Votre Subvention</option>
                                @foreach ($subventions as $subvention)
                                    <option value="{{ $subvention->id }}">
                                        {{ $subvention->lib_subvention }}</option>
                                @endforeach
                            </select>
                            @error('subvention_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="codepromo">Code Promo</label>
                            <input type="text" wire:model="promo_code" id="codepromo" class="form-control"
                                placeholder="Entrez le code promo" value="{{ old('promo_code') }}">
                            @error('promo_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 d-flex justify-content-between mt-4">
                            <button class="btn btn-label-secondary" wire:click='backStep'>
                                <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Précédent</span>
                            </button>
                            <button class="btn btn-primary" wire:click="nextStep">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Suivant</span>
                                <i class="ti ti-arrow-right ti-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            @if ($step == 2)
                <!-- Confirmation Information -->
                <div id="confirmationValidation" class="content">

                    <div class="row mb-3">
                        <!-- Confirmation details -->
                        <div class="col-xl-12">
                            <ul class="list-group list-group-horizontal-md">
                                <li class="col-12 list-group-item flex-fill p-4 text-heading">
                                    <h4 class="d-flex align-items-center gap-1">
                                        <i class="ti ti-user"></i>
                                        <strong>Info Client</strong>
                                    </h4>
                                    <address class="mb-0">
                                        Nom du Candidat : <b>{{ $name }}</b> {{ $surname }}<br />
                                        Sexe : {{ $sexe }}<br>
                                        Né(e) le : {{ $date_birth }}<br />
                                    </address>
                                    <p class="mb-0 mt-3">
                                        <i class="ti ti-phone"></i> Numéro de Téléphone : {{ $tel_number1 }}
                                    </p>
                                    <p>
                                        <i class="ti ti-user"></i> Category : {{ $lib_categorie }}<br>
                                        <i class="ti ti-credit-card"></i> Subvention :
                                        {{ number_format($lib_subvention ?? 0, 0, '', ' ') }}
                                        FCFA<br>

                                    </p>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="row">

                        <!-- Confirmation total -->
                        <div class="col-xl-12">
                            <div class="border rounded p-4 pb-3">
                                <!-- Price Details -->
                                <h4 class="d-flex align-items-center gap-1">
                                    <i class="ti ti-credit-card"></i>
                                    <strong>Paiement Details</strong>
                                </h4>
                                <dl class="row mb-0">

                                    <dt class="col-6 fw-normal text-heading">Total </dt>
                                    <dd class="col-6 text-end">{{ number_format($total ?? 0, 0, '', ' ') }}
                                        FCFA</span>
                                    </dd>
                                </dl>
                                <hr class="mx-n4">
                                <dl class="row mb-0">
                                    <dt class="col-6 text-heading">Subvention</dt>
                                    <dd class="col-6 fw-medium text-end text-heading mb-0">
                                        {{ number_format($lib_subvention ?? 0, 0, '', ' ') }} FCFA</dd>
                                </dl>
                                <hr class="mx-n4">
                                <dl class="row mb-0">
                                    <dt class="col-6 text-heading">Reste a payer</dt>
                                    <dd class="col-6 fw-medium text-end text-heading mb-0">
                                        <span
                                            class="badge bg-label-danger ms-1">{{ number_format($reste ?? 0, 0, '', ' ') }}
                                            FCFA</span>
                                    </dd>
                                </dl>
                            </div>


                            <div class="row py-1 my-1">
                                <div class="col-md mb-md-0 mb-2">
                                    <div class="form-check custom-option custom-option-basic checked">
                                        <label
                                            class="form-check-label custom-option-content form-check-input-payment d-flex gap-11 align-items-center"
                                            for="customRadioVisa">
                                            <input name="moyen_payement" wire:model="moyen_payement"
                                                class="form-check-input" type="radio" value="Cash"
                                                id="moyen_payement" checked />
                                            <span class="custom-option-body">
                                                <img src="{{ asset('assets/img/finance.png') }}" alt="visa-card"
                                                    width="46">
                                                <span class="ms-3">Cash</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md mb-md-0 mb-2">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label
                                            class="form-check-label custom-option-content form-check-input-payment d-flex gap-1 align-items-center"
                                            for="customRadioPaypal">
                                            <input name="moyen_payement" wire:model="moyen_payement"
                                                class="form-check-input" type="radio" value="Wave"
                                                id="moyen_payement" />
                                            <span class="custom-option-body">
                                                <img src="{{ asset('assets/logo/nav-logo.png') }}" alt="visa-card"
                                                    width="100"> <span class="ms-3"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between mt-4">
                                <button class="btn btn-label-secondary btn-prev" wire:click="prevStep">
                                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Précédent</span>
                                </button>
                                <button type="submit" class="btn btn-success btn-next" wire:click="store">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Valider</span>
                                    <i class="ti ti-arrow-right ti-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>

</div>

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
                    <i class="ti ti-credit-card"></i> Subvention : {{ number_format($lib_subvention ?? 0, 0, '', ' ') }}
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

                <dt class="col-6 fw-normal text-heading">Reste a payer </dt>
                <dd class="col-6 text-end"><span
                        class="badge bg-label-danger ms-1">{{ number_format($reste ?? 0, 0, '', ' ') }} FCFA</span>
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
                <dt class="col-6 text-heading">Total</dt>
                <dd class="col-6 fw-medium text-end text-heading mb-0">{{ number_format($total ?? 0, 0, '', ' ') }}
                    FCFA</dd>
            </dl>
        </div>
        <div class="col-12 d-flex justify-content-between mt-4">
            <button class="btn btn-label-secondary btn-prev" wire:click="prevStep">
                <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Précédent</span>
            </button>
            <button type="submit" class="btn btn-success btn-next" wire:click="nextStep">
                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Suivant</span>
                <i class="ti ti-arrow-right ti-xs"></i>
            </button>
        </div>
    </div>
</div>

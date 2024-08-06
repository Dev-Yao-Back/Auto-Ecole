<div class="row mb-3">
    <div class="col-12 col-lg-8 mx-auto text-center mb-3">
        <h4 class="mt-2">AUTO-ECOLE!!! 😇</h4>
        <p>Votre commande <a href="javascript:void(0)"> {{ $ticketNumber }}</a> a été placée !</p>
        <p>Nous avons envoyé un message WhatsApp à <a href="https://wa.me/{{ $phone1 }}">{{ $phone1 }}</a>
            avec la confirmation de votre commande et le reçu. Si vous n'avez pas reçu le message dans les deux minutes,
            veuillez vérifier votre application WhatsApp.</p>
        <p><span class="fw-medium"><i class="ti ti-clock me-1"></i> Heure de la commande :&nbsp;</span>
            {{ $date }} {{ $time }}</p>
    </div>

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
                    Né(e) le : {{ $date_born }}<br />
                </address>
                <p class="mb-0 mt-3">
                    <i class="ti ti-phone"></i> Numéro de Téléphone : {{ $phone1 }} / {{ $phone2 }}
                </p>
                <p>
                    <i class="ti ti-user"></i> Nom du Père : {{ $father }}<br>
                    <i class="ti ti-user"></i> Nom de la Mère : {{ $mother }}<br>
                </p>
            </li>
            <li class="col-12 list-group-item flex-fill p-4 text-heading">
                <h4 class="d-flex align-items-center gap-1">
                    <i class="ti ti-car"></i>
                    <strong>Informations concernant le Permis</strong>
                </h4>
                <p class="fw-medium mb-3">
                    <i class="ti ti-gift"></i> Source : {{ $lib_source }}<br>
                    <i class="ti ti-category"></i> Catégorie : {{ $lib_categorie }}<br>
                    <i class="ti ti-credit-card"></i> Subvention :
                    {{ number_format($lib_subvention ?? 0, 0, '', ' ') }} FCFA<br>
                    <i class="ti ti-file"></i> Pièce : {{ $lib_piece }}<br>
                    <i class="ti ti-file-text"></i> Référence de la Pièce : {{ $ref_piece }}<br>
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
        <div class="row my-1 gy-2 d-flex justify-content-center">
            <div class="col-4 d-grid">
                <button class="btn btn-secondary" wire:click='preview_step'>Retour</button>
            </div>
            @if ($candidateRegistered)
                <div class="col d-grid ">
                    <button class="btn btn-primary text-lg-start" wire:click='restartComponent'>Incrire un
                        Nouveau</button>
                </div>
            @else
                <div class="col d-grid ">
                    <button class="btn btn-success text-lg-start" wire:click='store'>Valider</button>
                </div>
            @endif



        </div>
    </div>
</div>

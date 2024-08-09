<div class="container-fluid">

    <div>
        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div class="card-body pt-0">
                                    <h6 class="mb-2">Chiffre d'affaires total</h6>
                                    <h4 class="mb-2">{{ number_format($totalRevenue, 0, 0, ' ') }} FCFA</h4>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <p class="mb-0">Nombre Total de Candidats</p>
                                        <small class="text-success">{{ $totalCandidates }}</small>
                                    </div>
                                </div>
                                <span class="avatar me-sm-4">
                                    <span class="avatar-initial bg-label-secondary rounded"><i
                                            class="ti-md ti ti-wallet text-body"></i></span>
                                </span>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div class="card-body pt-0">
                                    <h6 class="mb-2">Chiffre d'affaires validé</h6>
                                    <h4 class="mb-2">{{ number_format($validatedRevenue, 0, 0, ' ') }} FCFA</h4>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <p class="mb-0">Candidats Validés</p>
                                        <small class="text-success">{{ $validatedCandidates }}</small>
                                    </div>
                                </div>
                                <span class="avatar p-2 me-lg-4">
                                    <span class="avatar-initial bg-label-success rounded"><i
                                            class="ti-md ti ti-check text-body"></i></span>
                                </span>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div class="card-body pt-0">
                                    <h6 class="mb-2">Chiffre d'affaires restant</h6>
                                    <h4 class="mb-2">{{ number_format($remainingRevenue, 0, 0, ' ') }} FCFA</h4>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <p class="mb-0">Candidats en Attente</p>
                                        <small class="text-success">{{ $notValidatedCandidates }}</small>
                                    </div>
                                </div>
                                <span class="avatar p-2 me-sm-4">
                                    <span class="avatar-initial bg-label-warning rounded"><i
                                            class="ti-md ti ti-time text-body"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="card-body pt-0">
                                    <h6 class="mb-2">Chiffre d'affaires d'aujourd'hui</h6>
                                    <h4 class="mb-2">{{ number_format($todayRevenue, 0, 0, ' ') }} FCFA</h4>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <p class="mb-0">Candidats Validés Aujourd'hui</p>
                                        <small class="text-success">{{ $nowValidatedCandidates }}</small>
                                    </div>
                                </div>
                                <span class="avatar p-2">
                                    <span class="avatar-initial bg-label-info rounded"><i
                                            class="ti-md ti ti-calendar text-body"></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Candidates Table -->
    <div class="card">
        <div class="card-header">
            <h5>Liste des Candidats</h5>
            <div class="d-flex align-items-center">
                <select class="form-control me-2" wire:model="filters.statut_id">
                    <option value="">Tous les statuts</option>
                    <option value="1">En attente</option>
                    <option value="2">Validé</option>
                </select>
                <button wire:click="resetFilters" class="btn btn-secondary">Réinitialiser les filtres</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>Statut</th>
                        <th>Montant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->matricule }}</td>
                            <td>{{ $candidate->name }}</td>
                            <td>{{ $candidate->category->type }}</td>
                            <td>{{ $candidate->statut_id == 2 ? 'Validé' : 'En attente' }}</td>
                            <td>{{ number_format($candidate->amont, 2) }} XOF</td>
                            <td>
                                @if ($candidate->statut_id != 2)
                                    <button wire:click="validateCandidat({{ $candidate->id }})"
                                        class="btn btn-success btn-sm">Valider</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>

<div class="row">
    <div class="container px-4">
        <div class="row gx-5 align-items-center">
            <div class="col">
                <h4 class="mb-2">INSCRIPTION AUTO ECOLE</h4>
            </div>
            <div class="col">
                <div class="row gx-5">
                    <div class="col-md mb-md-0 mb-2">
                        <div class="form-check custom-option custom-option-icon">
                            <label class="form-check-label custom-option-content">
                                <h3 class="custom-option-body">
                                    <input type="text" wire:model="matricule" placeholder="Enter Matricule"
                                        class="form-control">
                                </h3>
                            </label>
                        </div>
                    </div>
                    <div class="col-md mb-md-0 mb-2">
                        <div class="form-check custom-option custom-option-icon">
                            <label class="form-check-label custom-option-content">
                                <h3 class="custom-option-body">
                                    <button wire:click="fetchCandidatOnline" class="btn btn-primary">Verifier</button>
                                </h3>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-4 py-3">
            <div class="divider divider-primary">
                <div class="divider-text">
                    <h4 class="mt-2 mb-4">Informations</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 card-body border-end">
                    <div class="container px-4 py-4">
                        <div class="row gy-3">
                            <div class="col-6">
                                <label class="form-label">Nom</label>
                                <input type="text" wire:model='name' class="form-control" value="{{ $name }}"
                                    placeholder="Nom">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" id="surname" name="surname" wire:model="surname"
                                    class="form-control" placeholder="Prénom" value="{{ $surname }}">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Téléphone 1</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone1" class="input-group-text">🇨🇮</span>
                                    <input type="tel" id="phone-number" class="form-control phone-mask"
                                        placeholder="07 04 750 465" aria-label="Numéro de téléphone sans le code pays"
                                        aria-describedby="country-code" pattern="^\d{10}$" maxlength="10" name="phone1"
                                        wire:model="phone1" value="{{ $phone1 }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Téléphone 2</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text">🇨🇮</span>
                                    <input type="tel" id="phone-number" class="form-control phone-mask"
                                        placeholder="07 04 750 465" aria-label="Numéro de téléphone sans le code pays"
                                        aria-describedby="country-code" pattern="^\d{10}$" maxlength="10" name="phone2"
                                        wire:model="phone2" />
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Nom et Prénom du Père</label>
                                <input type="text" name="father" class="form-control"
                                    placeholder="Nom et Prénom du Père" wire:model="father">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Nom et Prénom de la Mère</label>
                                <input type="text" name="mother" class="form-control"
                                    placeholder="Nom et Prénom de la Mère" wire:model="mother">
                            </div>


                            <div class="col-6">
                                <div class="form-check custom-option custom-option-icon d-flex align-items-center">
                                    @if ($sexe == 'Masculin')
                                        <input class="form-check-input" type="radio" value="Masculin" name="sexe"
                                            id="sexe_homme" wire:model="sexe" checked>
                                    @else
                                        <input class="form-check-input" type="radio" value="Masculin" name="sexe"
                                            id="sexe" wire:model="sexe">
                                    @endif
                                    <label class="form-check-label custom-option-content" for="sexe_homme">
                                        <span class="custom-option-body">
                                            <span class="custom-option-title">Masculin</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-check custom-option custom-option-icon d-flex align-items-center">
                                    @if ($sexe == 'Feminin')
                                        <input class="form-check-input" type="radio" value="Feminin"
                                            name="sexe" id="sexe" wire:model="sexe" checked>
                                    @else
                                        <input class="form-check-input" type="radio" value="Feminin"
                                            name="sexe" id="sexe_femme" wire:model="sexe">
                                    @endif
                                    <label class="form-check-label custom-option-content" for="sexe_femme">
                                        <span class="custom-option-body">
                                            <span class="custom-option-title">Feminin</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" wire:model="date_born">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Commercial</label>
                                <select id="source" wire:model='source' class="selectpicker w-100 form-select">
                                    @if ($source)
                                        <option value="{{ $source }}" selected>
                                            {{ $source }}</option>
                                    @endif
                                    <option default>Commercial</option>

                                    @foreach ($sources as $sc)
                                        <option value="{{ $sc->id }}">
                                            {{ $sc->referral_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <br>
                            @if ($commune_residence)
                            @else
                                <label class="form-label">Commune</label>
                                <select id="commune_residence" wire:model='commune_residence'
                                    class="selectpicker w-100 form-select">
                                    <option default>Commune</option>
                                    @foreach ($communes as $sc)
                                        <option value="{{ $sc->id }}">
                                            {{ $sc->nom_commune }}</option>
                                    @endforeach
                            @endif

                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-lg-5 card-body">
                    <div class="container px-2 py-3">
                        <div class="container py-2 px-4">
                            <div class="row gx-5">
                                <div class="col">
                                    <label class="form-label">Type de Pièce</label>
                                    <select id="type_piece" wire:model='piece'
                                        class="selectpicker w-100 form-select">
                                        <option default>Pièce</option>
                                        @foreach ($pieces as $piece)
                                            <option value="{{ $piece->id }}">{{ $piece->type_piece }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-label">Référence Identité</label>
                                    <input type="text" name="ref_piece" class="form-control"
                                        placeholder="Référence Identité" wire:model="ref_piece">
                                </div>
                            </div>
                        </div>
                        <div class="container py-2 px-4">
                            <div class="row gx-3">
                                <div class="col-6">
                                    @if ($piece_rUrl)
                                        <img src="{{ $piece_rUrl }}" alt="Image Preview"
                                            style="max-width: 100%; height: auto;">
                                    @else
                                        <form wire:submit.prevent="upload" class="dropzone needsclick"
                                            id="dropzone-basic">
                                            <div class="dz-message needsclick">Pièces R°</div>
                                            <div class="fallback">
                                                <input name="piece_r" type="file" wire:model="piece_r" />
                                            </div>
                                        </form>
                                    @endif
                                </div>

                                <div class="col-6">
                                    @if ($piece_vUrl)
                                        <img src="{{ $piece_vUrl }}" alt="Image Preview"
                                            style="max-width: 100%; height: auto;">
                                    @else
                                        <form wire:submit.prevent="upload" class="dropzone needsclick"
                                            id="dropzone-basic">
                                            <div class="dz-message needsclick">Pièces V°</div>
                                            <div class="fallback">
                                                <input name="piece_v" type="file" wire:model="piece_v" />
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid mt-3">
                                <button wire:click='upload_check' class="btn btn-success">Vérifiez</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($categorie)
        @else
            <div class="container px-3 py-0">
                <div class="divider divider-primary">
                    <div class="divider-text">
                        <h4 class="mt-2 mb-4">Catégorie de Permis</h4>
                    </div>
                </div>
                <div class="row gy-2 gx-3">
                    @forelse ($categories as $categorie)
                        <div class="col-md mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-icon">
                                <input class="form-check-input" type="radio" value="{{ $categorie->id }}"
                                    name="categorie" id="categorie_{{ $categorie->id }}" wire:model="categorie">
                                <label class="form-check-label custom-option-content"
                                    for="categorie_{{ $categorie->id }}">
                                    <span class="custom-option-body">
                                        <span class="custom-option-title">Catégorie {{ $categorie->type }}</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    @empty
                        <p>Pas de Catégorie enregistrée</p>
                    @endforelse
                </div>

            </div>
        @endif

        @if ($subvention)
        @else
            <div class="container px-4 py-3">
                <div class="divider divider-danger">
                    <div class="divider-text">
                        <h4 class="mt-2 mb-4">Prix et Montant</h4>
                    </div>
                </div>
                <div class="row gy-4 gx-3">
                    @forelse ($subventions as $subvention)
                        <div class="col-md mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-icon">
                                <input class="form-check-input" type="radio" value="{{ $subvention->id }}"
                                    name="subvention" id="subvention_{{ $subvention->id }}" wire:model='subvention'
                                    checked>
                                <label class="form-check-label custom-option-content"
                                    for="subvention_{{ $subvention->id }}">
                                    <span class="custom-option-body">
                                        <span class="custom-option-title">{{ $subvention->lib_subvention }}</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    @empty
                        <p>Pas de Subventions enregistrées</p>
                    @endforelse
                </div>
            </div>
        @endif
        <div class="container px-4 py-3">
            <div class="divider divider-info">
                <div class="divider-text">
                    <h4 class="mt-2 mb-4">Autres</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md mb-md-0 mb-2">
                    <div class="form-check custom-option custom-option-icon">
                        <input class="form-check-input" type="radio" value="Déjà Inscrit Ailleurs" name="autre"
                            id="autre_deja_inscrit" wire:model='autre' checked>
                        <label class="form-check-label custom-option-content" for="autre_deja_inscrit">
                            <span class="custom-option-body">
                                <span class="custom-option-title">Déjà Inscrit Ailleurs</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md mb-md-0 mb-2">
                    <div class="form-check custom-option custom-option-icon">
                        <input class="form-check-input" type="radio" value="Pas Inscrit Ailleurs" name="autre"
                            id="autre_pas_inscrit" wire:model='autre'>
                        <label class="form-check-label custom-option-content" for="autre_pas_inscrit">
                            <span class="custom-option-body">
                                <span class="custom-option-title">Pas Inscrit Ailleurs</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md mb-md-0 mb-2">
                    <div class="form-check custom-option custom-option-icon">
                        <input class="form-check-input" type="radio" value="Il ne sait pas" name="autre"
                            id="autre_il_ne_sait_pas" wire:model='autre'>
                        <label class="form-check-label custom-option-content" for="autre_il_ne_sait_pas">
                            <span class="custom-option-body">
                                <span class="custom-option-title">Il ne sait pas</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-4">
            <div class="row gx-5">
                <div class="d-grid">
                    <button wire:click='first_check' class="btn btn-primary">Continuer</button>
                </div>
            </div>
        </div>
    </div>
</div>

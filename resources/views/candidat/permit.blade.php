<div class="content-header mb-4">
    <h3 class="mb-1">Détails du Permis de Conduire</h3>
    <p>Entrez les détails du permis que vous souhaitez obtenir</p>
</div>
<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label" for="multiStepsPermitCategory">Catégorie de
            Permis</label>
        <select name="categorie_permis_id" id="multiStepsPermitCategory" class="select2 form-select" data-allow-clear="true"
            wire:model="categorie_permis_id" required>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}"> Catégorie
                    {{ $categorie->type }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="multiStepsSubvention">
            Subvention</label>
        <select name="subvention_id" id="multiStepsSubvention" class="select2 form-select" data-allow-clear="true"
            wire:model="subvention_id" required>
            @foreach ($subventions as $subvention)
                <option value="{{ $subvention->id }}"> Subvention
                    {{ $subvention->lib_subvention }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="col-md-12">
        <label class="form-label" for="codepromo">Code Promo</label>
        <input type="text" name="moyen_payement" id="codepromo" class="form-control"
            placeholder="Entrez le code promo" wire:model="promo_code" />
    </div>
    <div class="col-12 d-flex justify-content-between mt-4">
        <button class="btn btn-label-secondary btn-prev">
            <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Précédent</span>
        </button>
        <button type="submit" class="btn btn-success btn-next ">Continuer</button>
    </div>
</div>

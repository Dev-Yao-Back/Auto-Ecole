<div class="container">
    <div class="bs-stepper-content">
        <form id="multiStepsForm" action="" method="POST">
            @csrf
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
                            <input type="text" name="name" class="form-control" placeholder="Jéremie"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsLastName">Nom</label>
                            <input type="text" name="surname" class="form-control" placeholder="N'da"
                                value="{{ old('surname') }}" required>
                            @error('surname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsEmail">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="jeremie@gmail.com"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="multiStepsMobile">Téléphone</label>
                            <input type="text" name="tel_number1" class="form-control" placeholder="🇨🇮"
                                value="{{ old('tel_number1') }}" required>
                            @error('tel_number1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multiStepsGender">Sexe</label>
                            <select name="sexe" id="multiStepsGender" class="form-select">
                                <option disabled selected>Votre Genre</option>
                                <option value="male" {{ old('sexe') == 'male' ? 'selected' : '' }}>Homme</option>
                                <option value="female" {{ old('sexe') == 'female' ? 'selected' : '' }}>Femme</option>
                            </select>
                            @error('sexe')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multiStepsBirthdate">Date de Naissance</label>
                            <input type="date" name="date_birth" id="multiStepsBirthdate" class="form-control"
                                value="{{ old('date_birth') }}">
                            @error('date_birth')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="multiStepsCommune">Commune</label>
                            <select name="commune_residence" id="multiStepsCommune" class="select2 form-select"
                                required>
                                <option selected>Votre Commune</option>
                                @foreach ($communes as $commune)
                                    <option value="{{ $commune->id }}"
                                        {{ old('commune_residence') == $commune->id ? 'selected' : '' }}>
                                        {{ $commune->nom_commune }}</option>
                                @endforeach
                            </select>
                            @error('commune_residence')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="multiStepsCommune">Catégorie</label>
                            <select name="categorie_permis_id" id="multiStepsCommune" class="select2 form-select">
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}"
                                        {{ old('categorie_permis_id') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->type }}</option>
                                @endforeach
                            </select>
                            @error('categorie_permis_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="multiStepsCommune">Subvention</label>
                            <select name="subvention_id" id="multiStepsCommune" class="select2 form-select" required>
                                <option selected>Votre Subvention</option>
                                @foreach ($subventions as $subvention)
                                    <option value="{{ $subvention->id }}"
                                        {{ old('subvention_id') == $subvention->id ? 'selected' : '' }}>
                                        {{ $subvention->lib_subvention }}</option>
                                @endforeach
                            </select>
                            @error('subvention_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="codepromo">Code Promo</label>
                            <input type="text" name="moyen_payement" id="codepromo" class="form-control"
                                placeholder="Entrez le code promo" value="{{ old('promo_code') }}">
                            @error('promo_code')
                                <div class="alert alrt-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 d-flex justify-content-between mt-4">
                            <button class="btn btn-label-secondary btn-prev" disabled>
                                <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Précédent</span>
                            </button>
                            <button class="btn btn-primary">
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
                        <!-- Display dynamic confirmation details here -->
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
<script>
    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>

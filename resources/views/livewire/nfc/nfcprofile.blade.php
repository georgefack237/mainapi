<div>

    <!-- Page content -->
    <div class="row m-0">
        <div class="col-lg-5">
            <div class="container-fluid mt-4">
                <div class="align-items-center mt-3 py-4">
                    <h4 class="h1 d-inline-block mb-0">Gérer les cartes</h4>
                </div>
                <div class="">
                    <!-- Card header -->
                    <div class="mb-4">
                        <div class="form-group position-relative d-block mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i
                                class="fas fa-search text-muted position-absolute" style="right: 10px;top:25%;"></i>
                        </div>
                        {{-- <div class="col-lg-3 col-4 text-right">
                                    <div class="form-group">
                                        <select wire:model.lazy="perPage" class="form-control form-control-sm form-control-muted bg-lighter"
                                            id="exampleFormControlSelect1">
                                            @for ($i = 5; $i <= 25; $i += 5)
                                                <option value="{{ $i }}">{{ $i }} par page</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-right d-none d-lg-block">
                                    @if ($profiles->count() == Auth::user()->profile_limit)
                                    <a href="#" class="btn btn-sm badge-warning" data-toggle="modal" data-target="#modalExhausted">
                                        <i class="fa fa-plus mr-1"></i>Limit Epuisé
                                    </a>
                                    @else
                                    <a href="#" wire:click="showCreateNfc" class="btn btn-sm btn-outline-success"><i
                                            class="fa fa-plus mr-1"></i> Nouveau profile</a>
                                    @endif
                                </div> --}}
                    </div>
                    @foreach ($profiles as $item)
                        <div class="nfc-profile-item pointer-event my-2 shadow-sm px-3 py-2 rounded border-left {{ $item->master == true ? 'mb-4 border-info' : 'border-warning' }}"
                            wire:click="showInfo({{ $item->id }})">
                            <div class="media align-items-center">
                                <a href="{{ route('nfc.show', $item->id) }}"
                                    class="avatar avatar-sm rounded-circle mr-3">
                                    <img alt="Image placeholder"
                                        src="{{ asset('storage/img/nfc/profile/' . $item->image) }}">
                                </a>
                                <a href="#" class="media-body text-default">
                                    <span class="name mb-0 text-sm font-weight-bold">{{ $item->firstname }}
                                        {{ $item->lastname }}</span>
                                    <small
                                        class="name mb-0 text-xs text-muted d-block">{{ $item->master == true ? 'Directeur Marketing' : 'Agent Commercial' }}</small>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    <!-- Card footer -->
                    <div class="">
                        <div class="col-md-6 ml-auto">
                            {{ $profiles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            @if (!$viewInfo && !$viewEdit)
                <div class="h-100vh d-flex align-items-center justify-content-center bg-secondary">
                    <div class="container mx-5 text-center">
                        <h1 class="display-1 text-light animate__animated animate__bounce">
                            <i class="bi bi-person-fill"></i>
                        </h1>
                        <h2 class="display-4 text-muted">Cliquez sur un profile</h2>
                        <p class="text-muted">Cliquer sur un profile pour afficher ou modifier ses information sur cette
                            section</p>
                    </div>
                </div>
            @endif
            @if ($viewInfo)
                <div class="h-100vh bg-secondary">
                    <div class="container-fluid pt-5 pb-4 bg-primary">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm btn-outline-white rounded-pill" wire:click='editInfo'><i
                                    class="fa fa-pencil mr-2"></i>Modifier</a>
                        </div>
                        <div class="text-center mt-4">
                            <a href="#" class="edit-picture avatar avatar-lg rounded-circle" style="width:120px;height:120px;">
                                <img alt="Image placeholder" src="{{ asset('storage/img/nfc/profile/' . $info->image) }}">
                            </a>
                            <h4 class="mt-3 h3 text-white mb-0">{{ $info->firstname . ' ' . $info->lastname }}</h4>
                            <p class="text-secondary">{{ $info->title }}</p>
                            <div class="d-flex justify-content-around mx-5 px-5 mt-3">
                                <div class="">
                                    <h4 class="display-4 text-info mb-0 animate__animated animate__jello">
                                        {{ $info->contacts->count() }}</h4>
                                    <h4 class="text-secondary font-weight-300">Contacts</h4>
                                </div>
                                <div class="">
                                    <h4 class="display-4 text-info mb-0 animate__animated animate__jello">
                                        {{ $info->sales->count() }}</h4>
                                    <h4 class="text-secondary font-weight-300">Ventes</h4>
                                </div>
                                <div class="">
                                    <h4 class="display-4 text-info mb-0 animate__animated animate__jello">
                                        {{ $info->appointments->count() }}</h4>
                                    <h4 class="text-secondary font-weight-300">Rendez-vous</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 px-3 mx-5 mt-5 px-5 animate__animated animate__fadeIn">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="bg-white rounded px-4 py-3">
                                    Adresse
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="bg-white rounded px-4 py-3">
                                    {{ $info->address }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="bg-white rounded px-4 py-3">
                                    Téléphone
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="bg-white rounded px-4 py-3">
                                    {{ $info->phone1 }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="bg-white rounded px-4 py-3">
                                    Adresse mail
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="bg-white rounded px-4 py-3">
                                    {{ $info->email }}
                                </div>
                            </div>
                        </div>
                        <div class="socials-block mt-3 py-3 px-3">
                            <div class="d-flex justify-content-center animate__animated animate__fadeInUp">
                                @if ($info->facebook)
                                    <a href="{{ $info->facebook }}" class="btn rounded-circle btn-primary bg-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if ($info->linkedin)
                                    <a href="{{ $info->linkedin }}" class="btn rounded-circle btn-info bg-in">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                                @if ($info->twitter)
                                    <a href="{{ $info->twitter }}" class="btn rounded-circle btn-primary bg-twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!$viewInfo && $viewEdit)
                <div class="d-flex align-items-center justify-content-center bg-secondary">
                    <div class="container mx-5">
                        <div class="row mt-5">
                            <div class="col-6">
                                <h4 class="h2 text-muted mb-4">Modifier le profile</h4>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                    wire:click="$toggle('viewEdit')" wire:loading.attr="disabled">Fermer</button>
                            </div>
                        </div>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Nom</label>
                                    <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="firstName" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Prenom</label>
                                    <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="lastName" id="inputPassword4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Fonction</label>
                                    <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="title" id="inputPassword4">
                                </div>
                            </div>

                            <div class="form-row">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                    wire:model="address" id="inputAddress">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Téléphone</label>
                                    <input type="phone" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="phone1" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Adresse mail</label>
                                    <input type="email" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="email" id="inputEmail4">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Facebook</label>
                                    <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="facebook" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity">LinkedIn</label>
                                    <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="linkedin" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Twitter</label>
                                    <input type="text" class="form-control form-control-muted bg-lighter border-0"
                                        wire:model="twitter" id="inputZip">
                                </div>
                            </div>

                            <div class=" mt-3 text-right">
                                <button type="button" class="btn btn-primary" wire:click="updateProfile"
                                    wire:loading.attr="disabled">Enregistrer</button>
                            </div>
                        </form>
                        <hr>
                        <h4 class="h2 text-muted mb-4">Changer mot de pass</h4>
                        <form>
                            <div class="form-group">
                                <label for="inputAddress">Entrez nouveau mot de pass</label>
                                <input type="password" class="form-control form-control-muted bg-lighter border-0"
                                    wire:model="newPassword" id="inputAddress">
                            </div>

                            <div class="mt-3 mb-4 text-right">
                                <button type="button" class="btn btn-primary" wire:click="updatePassword"
                                    wire:loading.attr="disabled">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

    </div>


    {{-- Modal Limit Exhausted --}}
    <div class="modal fade" id="modalExhausted" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalExhaustedLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fa fa-circle-exclamation fa-5x text-warning mt-3"></i>
                    <h4 class="text-uppercase text-warning font-weight-bold mt-3">Votre limite de profile est épuisé
                    </h4>
                    <p class="text-sm text-muted mx-5">Veillez contacter votre fournisseur NFC pour augmenter votre
                        limite de profile.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-warning shadow-none" data-dismiss="modal">Compris</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create profile modal -->

    <x-jet-dialog-modal maxWidth="lg" wire:model="createNfcModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{-- <input type="text" value="{{Auth::user()->name}}" wire:model="userId"> --}}
                        <label for="inputEmail4">Nom</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="firstName"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Prenom</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="lastName"
                            id="inputPassword4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Entreprise</label>
                        <input type="text" class="form-control form-control-muted border-0"
                            wire:model="companyName" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Fonction</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="title"
                            id="inputPassword4">
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="address"
                        id="inputAddress">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Téléphone</label>
                        <input type="phone" class="form-control form-control-muted border-0" wire:model="phone1"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Adresse mail</label>
                        <input type="email" class="form-control form-control-muted border-0" wire:model="email"
                            id="inputEmail4">
                    </div>
                </div>

                <hr>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">Facebook</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="facebook"
                            id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">LinkedIn</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="linkedin"
                            id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Twitter</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="twitter"
                            id="inputZip">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress">Site web</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="website"
                        id="inputAddress" placeholder="www.exempele.com">
                </div>

                <div class="input-group mb-3 bg-secondary">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" wire:model="image"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Cliquer pour choisir une image</label>
                    </div>
                    @error('photo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                @if ($image)
                    <div class="w-100 overflow-hidden mb-3">
                        Photo Preview:
                        <img src="{{ $image->temporaryUrl() }}" width="100%">
                    </div>
                @endif

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-success" wire:click="createProfile"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-success" wire:click="$toggle('createNfcModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Delete Modal --}}
    <x-jet-dialog-modal maxWidth="sm" wire:model="deleteNfcModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <div class="">
                <h1 class="text-center text-danger"><i class="fa fa-exclamation-circle fa-2x"></i></h1>
                <p class="text-center text-sm">Vous êtes sur le point de supprimer un profil NFC</p>
            </div>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
            <div class="h-100 w-100 text-center">
                <button type="button" class="btn btn-danger" wire:click="deleteProfile"
                    wire:loading.attr="disabled">Confirmer</button>
                <button class="btn btn-default" wire:click="$toggle('deleteNfcModal')"
                    wire:loading.attr="disabled">Annuler</button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

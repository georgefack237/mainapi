<div>

    <!-- Page content -->
    <div class="container-fluid mt-4">
        <div class="row align-items-center mt-3 py-4">
            <div class="col-lg-6 col-7">
                <h4 class="h1 d-inline-block mb-0">Gérer les cartes</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="">
                    <!-- Card header -->
                    <div class="">
                        <div class="row">
                            <div class="col-lg-7 col-8">
                                <div class="form-group position-relative d-block mr-lg-4 mb-0">
                                    <input wire:model="search" class="form-control form-control-sm form-control-muted bg-lighter"
                                        placeholder="Recherche..." type="text"><i class="fas fa-search text-muted position-absolute" style="right: 10px;top:25%;"></i>
                                </div>
                            </div>
                            <div class="col-lg-3 col-4 text-right">
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
                                <a href="#" wire:click="showCreateNfc" class="btn btn-sm btn-outline-success"><i
                                        class="fa fa-plus mr-1"></i> Nouveau profile</a>
                            </div>
                        </div>
                    </div>
                    {{-- <h2>{{$profiles->count()}}</h2> --}}
                    @foreach ($agents as $item)
                        <div class="nfc-profile-item my-2 shadow-sm px-3 py-2 rounded border-left {{$item->master==true?'mb-4 border-info':'border-warning'}}"
                            wire:click="showDemo({{ $item->id }})">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="media align-items-center">
                                        <a href="{{ route('nfc.show', $item->id) }}" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder"
                                                src="{{ asset('storage/img/nfc/profile/' . $item->image) }}">
                                        </a>
                                        <a href="{{ route('nfc.show', $item->id) }}" class="media-body text-default">
                                            <span class="name mb-0 text-sm font-weight-bold">{{ $item->firstname }} {{$item->lastname}}</span>
                                            <small class="name mb-0 text-xs text-muted d-block">{{$item->master==true?'Directeur Marketinf':'Agent Commercial'}}</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex media align-items-center">
                                    <small class="mb-0 nfc-link-text" id="{{ $item->id }}">
                                        {{ route('nfc.link', $item->slug) }} </small><i
                                        class="fa fa-clipboard mx-auto copy" onclick="toClipboard(this)"
                                        data-id="{{ $item->id }}"></i>
                                </div>
                                <div class="col-lg-2 d-none d-lg-flex media align-items-center justify-content-center border-left">
                                    <div class="mb-0 text-sm">
                                        <a href="{{ route('admin.client.agent', $item->id) }}"
                                            class="btn btn-sm btn-success shadow-none">Ouvrir</a>
                                    </div>
                                    <a href="#" wire:click="showDeleteNfc"
                                        class="fa fa-trash text-danger mx-auto"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Card footer -->
                    <div class="">
                        <div class="col-md-6 ml-auto">
                            {{-- {{ $agents->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Phone Mockup section --}}
            <div class="col-lg-3 d-none d-lg-block">
                <div class="profile-demo">
                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">

                                {{-- NFC Profile demo start --}}

                                @if ($demo)
                                    <div class="name-card">
                                        <div class="profile-icon mb-4 animated fadeInDown">
                                            <div class="circle">
                                                <img src="{{ asset('storage/img/nfc/profile/' . $demo->image) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="name text-center animated fadeInUp">
                                            <h3>{{ $demo->firstname }}</h3>
                                            <h5>{{ $demo->lastname }}</h5>
                                        </div>
                                        <div class="divider my-1 animated fadeInUp"></div>
                                        <p class="text-muted text-center animated fadeInUp">{{ $demo->title }}</p>
                                    </div>

                                    <div class="container">

                                        <div class="contact-block mt-2 animated fadeInUp">
                                            <div class="single">
                                                <div class="corner">
                                                    <i class="fas fa-map-marker-alt icon-left"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <span>{{ $demo->address }}</span>
                                                </div>
                                                <!-- <i class="fas fa-map-marker-alt ml-auto"></i> -->
                                            </div>
                                            <div class="single with-icon-right mt-2">
                                                <div class="corner">
                                                    <i class="fas fa-mobile-alt icon-left"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <span>{{ $demo->phone1 }}
                                                        @if ($demo->phone2)
                                                            <br>{{ $demo->phone2 }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <a href="tel:{{ $demo->phone1 }}" class=" ml-auto icon-right">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            </div>
                                            <div class="single with-icon-right mt-2">
                                                <div class="corner">
                                                    <i class="fas fa-globe icon-left"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <span>
                                                        @if ($demo->website)
                                                            {{ $demo->website }}
                                                            <br>
                                                        @endif
                                                        {{ $demo->email }}
                                                    </span>
                                                </div>
                                                <a href="mailto:{{ $demo->email }}" class=" ml-auto icon-right">
                                                    <i class="fa fa-paper-plane"></i>
                                                </a>
                                            </div>
                                            <div class="socials-block mt-2 py-3 px-3">
                                                @if ($demo->facebook || $demo->linkedin || $demo->twitter)
                                                    <h4 class="text-center">Réseaux sociaux</h4>
                                                @endif
                                                <div class="d-flex justify-content-center">
                                                    @if ($demo->facebook)
                                                        <a href="{{ $demo->facebook }}"
                                                            class="btn rounded-circle btn-primary bg-facebook">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    @endif

                                                    @if ($demo->linkedin)
                                                        <a href="{{ $demo->linkedin }}"
                                                            class="btn rounded-circle btn-info bg-in">
                                                            <i class="fab fa-linkedin-in"></i>
                                                        </a>
                                                    @endif

                                                    @if ($demo->twitter)
                                                        <a href="{{ $demo->twitter }}"
                                                            class="btn rounded-circle btn-primary bg-twitter">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="scroll"></div> --}}
                                        </div>
                                    </div>

                                    <div class="bottom-action">
                                        <a href="{{ route('nfc.save', $demo->id) }}" class="animated fadeInUp">
                                            <div class="save px-4">
                                                <i class="fa fa-arrow-downmr-2"></i><span
                                                    class="">Enregistrer</span>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center align-items-center h-100 px-4">
                                        <span class="text-center">Cliquer sur un profil pour afficher l'apperçu sur
                                            cette écran</span>
                                    </div>
                                @endif
                                {{-- NFC Profile demo end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Limit Exhausted --}}
    <div class="modal fade" id="modalExhausted" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalExhaustedLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa fa-circle-exclamation fa-5x text-warning mt-3"></i>
                <h4 class="text-uppercase text-warning font-weight-bold mt-3">Votre limite de profile est épuisé</h4>
                <p class="text-sm text-muted mx-5">Veillez contacter votre fournisseur NFC pour augmenter votre limite de profile.</p>
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


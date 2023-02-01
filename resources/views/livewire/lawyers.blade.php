<div class="container">

    <div id="profile">
        <!-- Page content -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="">
                        <!-- Card header -->
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <h3>Avocats</h3>
                            </div>

                            <div class="col-lg-6 text-right">
                                <a href="#" wire:click="newMail" class="btn btn-sm btn-success mr-2"><i
                                        class="fa fa-plus mr-2"></i>Nouvelle diffusion</a>
                                <a href="#" wire:click="showCreateNfc" class="btn btn-sm btn-success"><i
                                        class="fa fa-plus mr-2"></i>Ajouter</a>
                            </div>


                        </div>

                        @if ($profiling)
                            @foreach ($profiling as $item)
                                <div class="nfc-profile-item my-2 shadow-sm px-3 py-2 rounded bg-white"
                                    wire:click="showDemo({{ $item->id }})">
                                    <div class="row">
                                        <div class="col-7">

                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder"
                                                        src="{{ asset('storage/img/nfc/profile/' . $item->image) }}">
                                                </a>
                                                <div class="media-body">
                                                    <span
                                                        class="name mb-0 text-sm font-weight-medium">{{ $item->first_name}} {{$item->last_name }}</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-5 media align-items-center">
                                            <small class="mb-0 nfc-link-text" id="{{ $item->id }}">
                                                {{ route('showlawyer', $item->matricule_key_hash) }} </small><i
                                                class="fa fa-clipboard mx-2 copy" id="copy" onclick="toClipboard(this)" data-id="{{ $item->id }}"></i>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                {{-- Phone Mockup section --}}
                <div class="col-lg-4">

                    {{-- NFC Profile demo start --}}

                    @if ($demo)
                    <div class="bg-white mt-5 p-4 rounded">
                        <h2>{{ $demo->first_name}} {{$demo->last_name }}</h2>
                        <span class="d-block text-green"><small>{{ $demo->title}}</small></span>
                        <span class="d-block text-green"><small>{{ $demo->matricule}}</small></span>
                        <span class="d-block text-green"><small>Date d'inscription: {{ date("j M Y",  strtotime($demo->created_at)) }}</small></span>
                        <span class="d-block">{{ $demo->address}}</span>
                        <span class="d-block">{{ $demo->phone}}</span>
                        <span class="d-block">{{ $demo->Mail}}</span>
                        <div class="qr mt-3" id="qr">
                            {!! QrCode::size(285)->generate(route('showlawyer', $demo->matricule_key_hash)) !!}
                        </div>
                        {{-- <button class="btn btn-block btn-success mt-3" id="download-qr">Télécharger QR</button> --}}
                        <button class="btn btn-block btn-success mt-3" onclick="downloadQR()">Télécharger QR</button>
                    </div>
                    @else
                        <div class="d-flex justify-content-center align-items-center h-100 mt-5 px-4 border rounded">
                            <span class="text-center font-weight-bold">Cliquer sur un profil pour afficher le code QR</span>
                        </div>
                    @endif
                    {{-- NFC Profile demo end --}}

                </div>
            </div>
        </div>

        <!-- Create profile modal -->

    </div>

    <x-jet-dialog-modal maxWidth="lg" wire:model="createNfcModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>


                <div class="form-row">

                    <div class="form-group col-md-6">
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
                        <label for="inputPassword4">Fonction</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="title"
                            id="inputPassword4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Matricule</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="matricule"
                            id="inputEmail4">
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
                        <input type="phone" class="form-control form-control-muted border-0" wire:model="phone"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Adresse mail</label>
                        <input type="email" class="form-control form-control-muted border-0" wire:model="email"
                            id="inputEmail4">
                    </div>
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
                        <img src="{{ $image->temporaryUrl() }}" width="40%">
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




    <x-jet-dialog-modal maxWidth="lg" wire:model="newMailModal">
        <x-slot name="title">
            Nouvelles diffusion
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="badge-success py-2 px-3 mb-3 rounded">
                    <p class="text-sm m-0">Ce mail sera envoyé aux <span class="font-weight-bold">{{$recipients->count()-1}} avocat</span> présent dans votre base de donné</p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-muted border-0" placeholder="Sujet" wire:model="subject">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-muted border-0" placeholder="Titre (optionnel)" wire:model="mailTitle">
                </div>

                <div class="custom-file mb-3">
                    <label class="" for="image">
                        <span type="button" class="btn btn-outline-primary rounded"><i class="bi bi-image mr-2"></i> Ajouter une image</span>
                    </label>
                    <input type="file" wire:model='mail_image' class="custom-file-input d-none" id="image" required>
                </div>

                <div class="form-group">
                    <textarea class="form-control form-control-muted border-0" placeholder="Contenu" wire:model="content" cols="30" rows="10"></textarea>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-success" wire:click="sendMail"
                            wire:loading.attr="disabled">
                            <i wire:loading.remove wire:target='sendMail' class="fa fa-paper-plane mr-2"></i>
                                <i wire:loading wire:target='sendMail'
                                    class="fa fa-spinner mr-2 animate__animated animate__rotateIn animate__infinite"></i>
                                <span wire:loading.remove wire:target='sendMail'>Envoyer</span>
                                <span wire:loading wire:target='sendMail'>Envoi en cours...</span>
                        </button>
                        {{-- <button type="button" class="btn btn-outline-success" wire:click="$toggle('newMailModal')"
                            wire:loading.attr="disabled">Annuler</button> --}}
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>

</div>

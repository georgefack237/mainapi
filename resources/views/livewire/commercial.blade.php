<div>
    <div class="bg-secondary">
        <div class="container">
            <div class="row align-items-center py-4">
                <div class="col-10 d-flex">
                    <span class="avatar avatar-md rounded-circle mr-3">
                        <img src="{{ asset('storage/img/nfc/profile/' . $profile->image) }}" alt="">
                    </span>
                    <div>
                        <h4 class="h1 d-inline-block mb-0">{{ $profile->firstname }}</h4>
                        <span class="d-block font-weight-600 text-muted">{{ $profile->companyname }}</span>
                    </div>
                </div>
                <div class="col-2 text-right">
                    <a href="/commercial/login" class="btn btn-flat btn-rounded rounded-pill">
                        <i class="fa fa-arrow-right-from-bracket fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Activités</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Contacts</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="mb-3 pb-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">
                                    <span class="font-weight-bold">Nom:</span>
                                    {{ $profile->firstname }} {{ $profile->lastname }}
                                </li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Titre:</span>
                                    {{ $profile->title }}
                                </li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Adresse:</span>
                                    {{ $profile->address }}</li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Téléphone:</span>
                                    {{ $profile->phone1 }}</li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Adresse
                                        mail:</span>
                                    {{ $profile->email }}</li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Site
                                        web:</span>
                                    {{ $profile->website }}</li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Lien
                                        Facebook:</span> <a href="{{ $profile->facebook }}">{{ $profile->facebook }}</a>
                                </li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Lien
                                        LinkedIn:</span> <a href="{{ $profile->linkedin }}">{{ $profile->linkedin }}</a>
                                </li>
                                <li class="list-group-item bg-transparent"><span class="font-weight-bold">Lien
                                        Twitter:</span> <a href="{{ $profile->twitter }}">{{ $profile->twitter }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="actions d-flex">
                            <button type="button" class="btn btn-success" wire:click="showUpdateNfc"><i
                                    class="fa fa-edit"></i>
                                Modifier</button>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="cards-demo">
                            <div class="card card-front">
                                <div class="card-inner bg-white" id="inner-front">
                                    <img class="mt-4" src="{{ @asset('img/icons/nfc-icon.png') }}" alt="">
                                    <div class="card-holder d-flex justify-content-center align-items-center">
                                        <i class="ni ni-circle-08 mr-3"></i>
                                        <div>
                                            <h3 class="name">{{ $profile->firstname }}
                                                <span class="d-block mt-3">{{ $profile->lastname }}</span>
                                            </h3>
                                            <h3 class="title mt-3">{{ $profile->title }}</h3></span>
                                        </div>
                                    </div>
                                    <div class="qr-code-front" id="qr-code">
                                        {!! QrCode::size(250)->generate($vCard) !!}
                                    </div>
                                </div>
                                {{-- <div class="logo-container"></div> --}}
                            </div>
                            <div class="card card-back">
                                <div class="card-inner">
                                    {{-- <div class="qr-code-back">
                                        {!! QrCode::size(300)->generate($vCard) !!}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="w-100 overflow-scroll">
                    <div class="nfc-profile-item py-1 px-3 my-2 border-bottom border-top">
                        <div class="row">
                            <div class="col-2">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 font-weight-bold text-muted text-sm">Date</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 media align-items-center border-left">
                                <span class="mb-0 font-weight-bold text-muted text-sm">Localisation</span>
                            </div>
                            <div class="col-4 media align-items-center border-left">
                                <small class="mb-0 font-weight-bold text-muted text-sm">Platform</small>
                            </div>
                            <div class="col-3 media align-items-center border-left">
                                <span class="mb-0 font-weight-bold text-muted text-sm">Agent</span>
                            </div>
                        </div>
                    </div>
                    @if ($activities)
                        @foreach ($activities as $activity)
                            <div class="nfc-profile-item py-2 px-3 my-2 border-bottom">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span
                                                    class="name mb-0 text-sm font-weight-bold">{{ $activity->created_at->format('D d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 media align-items-center">
                                        <small class="mb-0">{{ $activity->country_name }},
                                            {{ $activity->region_name }},
                                            {{ $activity->city_name }}</small>
                                    </div>
                                    <div class="col-4 media align-items-center">
                                        <small class="mb-0 nfc-link-text-2">{{ $activity->user_agent }}</small>
                                    </div>
                                    <div class="col-3 media align-items-center">
                                        <small class="mb-0">{{ $activity->nfcprofile->firstname }}
                                            {{ $activity->nfcprofile->lastname }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center">
                            <h1 class="muted">Aucune activité n'a été enregistré pour le moment</h1>
                        </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="w-100 overflow-scroll">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Numéro</th>
                                <th scope="col">Date d'entré</th>
                                <th scope="col">Enregistrer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($contacts)
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->title }} {{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->created_at }}</td>
                                        <td><a href="{{ route('phoneSave', $contact->id) }}" class="fa fa-arrow-down text-success mx-auto"></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <h1 class="muted">Aucune activité n'a été enregistré pour le moment</h1>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Update profile modal --}}

        <x-jet-dialog-modal maxWidth="lg" wire:model="updateNfcModal">
            <x-slot name="title">

            </x-slot>

            <x-slot name="content">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nom</label>
                            <input type="text" class="form-control form-control-muted border-0" wire:model="firstName"
                                id="inputEmail4" value="{{ $profile->firstname }}">
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

                    <div class="d-flex align-item-center justify-content-center">
                        <div class="">
                            <button type="button" class="btn btn-success" wire:click="updateProfile"
                                wire:loading.attr="disabled">Enregistrer</button>
                            <button type="button" class="btn btn-outline-success" wire:click="$toggle('updateNfcModal')"
                                wire:loading.attr="disabled">Annuler</button>
                        </div>
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>

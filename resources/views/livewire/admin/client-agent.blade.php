<div>

    <div class="container-fluid mt-3">
        <div class="row align-items-center py-4">
            <div class="col-lg-6">
                <h4 class="h1 d-inline-block mt-2 mb-0">{{ $profile->firstname }} {{ $profile->lastname }}</h4>
            </div>
        </div>
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
                            <ul class="list-group list-group-flush text-sm">
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col">Nom:</span>
                                        <span class="col-9">{{ $profile->firstname }} {{ $profile->lastname }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Titre:</span>
                                        <span class="col-9">{{ $profile->title }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Adresse:</span>
                                        <span class="col-9">{{ $profile->address }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Téléphone:</span>
                                        <span class="col-9">{{ $profile->phone1 }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Adresse mail:</span>
                                        <span class="col-9">{{ $profile->email }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Site web:</span>
                                        <span class="col-9"><a
                                                href="{{ $profile->facebook }}">{{ $profile->website }}</a></span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Lien Facebook:</span>
                                        <span class="col-9"><a
                                                href="{{ $profile->facebook }}">{{ $profile->facebook }}</a></span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Lien LinkedIn:</span>
                                        <span class="col-9"><a
                                                href="{{ $profile->linkedin }}">{{ $profile->linkedin }}</a></span>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="row">
                                        <span class="font-weight-bold col-3">Lien Twitter:</span>
                                        <span class="col-9"><a
                                                href="{{ $profile->twitter }}">{{ $profile->twitter }}</a></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="actions d-flex">
                            <button type="button" class="btn btn-success" wire:click="showUpdateNfc"><i
                                    class="fa fa-edit"></i>
                                Modifier</button>
                            <div class="btn-group ml-auto" role="group" aria-label="Basic example">
                                <button class="btn btn-secondary" id="download-qr"><i
                                        class="fa fa-download mr-2"></i>Download
                                    QR Code</button>
                                <a href="{{ route('nfc.save', $profile->id) }}" class="btn btn-secondary"><i
                                        class="fa fa-download mr-2"></i>Download VCF</a>
                                <button type="button" class="btn btn-secondary" onclick="window.print()"><i
                                        class="fa fa-print mr-2"></i>Print</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                <div class="">
                    <div class="nfc-profile-item py-1 px-3 my-2 border-bottom border-top">
                        <div class="row">
                            <div class="col-3">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 font-weight-bold text-muted text-sm">Date</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 media align-items-center border-left">
                                <span class="mb-0 font-weight-bold text-muted text-sm">Localisation</span>
                            </div>
                            <div class="col-5 media align-items-center border-left">
                                <small class="mb-0 font-weight-bold text-muted text-sm">Platform</small>
                            </div>
                        </div>
                    </div>
                    @if ($activities)
                        @foreach ($activities as $activity)
                            <div class="nfc-profile-item py-2 px-3 my-2 border-bottom">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span
                                                    class="name mb-0 text-sm font-weight-bold">{{ $activity->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 media align-items-center">
                                        <small class="mb-0">{{ $activity->country_name }},
                                            {{ $activity->region_name }},
                                            {{ $activity->city_name }}</small>
                                    </div>
                                    <div class="col-5 media align-items-center">
                                        <small class="mb-0 nfc-link-text-2">{{ $activity->user_agent }}</small>
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
                <div class="">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Numéro</th>
                                <th scope="col">Date d'entré</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($contacts)
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>
                                            <span
                                                class="name mb-0 text-sm font-weight-bold">{{ $contact->name }}</span>
                                            <small
                                                class="name mb-0 text-xs text-muted d-block">{{ $contact->title }}</small>
                                        </td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->created_at }}</td>
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
                        <label for="inputPassword4">Téléphone 2</label>
                        <input type="phone" class="form-control form-control-muted border-0" wire:model="phone2"
                            id="inputPassword4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Adresse mail</label>
                        <input type="email" class="form-control form-control-muted border-0" wire:model="email"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Adresse mail 2</label>
                        <input type="email" class="form-control form-control-muted border-0" wire:model="email2"
                            id="inputPassword4">
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

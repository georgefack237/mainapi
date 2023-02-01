<div>
    <div class="header bg-white py-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="align-items-center mt-4 py-3">

                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 h1">Contacts</h2>
                    </div>
                    
                    <div class="row justify-content-between align-items-center">
                        
                        <div class="col-lg-4 form-group position-relative mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i
                                class="fas fa-search text-primary position-absolute" style="right: 25px;top:25%;"></i>
                        </div>


                        <div class="col-lg-6 mt-3 mt-lg-0 d-flex justify-content-between justify-content-lg-end">

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group mb-2">
                                        {{-- <span>Date de:</span> --}}
                                        <input type="date" class="form-control form-control-muted form-control-sm border-0"
                                            wire:model="fromDate">
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group mb-2">
                                        {{-- <span>à:</span> --}}
                                        <input type="date" class="form-control form-control-muted form-control-sm border-0"
                                            wire:model="toDate">
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="bg-dander col-lg-2 text-right">
                            <div class="badge badge-lg badge-primary m-0">{{$contacts->count()}} contacts</div>
                        </div>
                    </div>


                    <form id="save-form" method="POST" action="{{ route('batchSave') }}">
                        @csrf
                        <input type="hidden" name="date" value="{{ $whereDate }}">
                    </form>


                </div>


            </div>
        </div>
    </div>






    <div class="container-fluid mb-5 mt-3" style="border-radius: 20px;">
        <div class="nfc-profile-item py-1 px-3 my-2 rounded d-none d-lg-block">
            <div class="row">
                <div class="col-8 col-lg-4">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 font-weight-bold text-muted text-sm">Nom</span>
                        </div>
                    </div>
                </div>
                <div class="col-3 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Contact</span>
                </div>
                <div class="col-3 col-lg-2 media d-none d-lg-inline">
                    <small class="mb-0 font-weight-bold text-muted text-sm">Note</small>
                </div>
                <div class="col-1 col-lg-2 media d-none d-lg-inline">
                    <small class="mb-0 font-weight-bold text-muted text-sm">Source</small>
                </div>
                <div class="col-1 text-center border-left d-none d-lg-block">
                    <small class="mb-0 font-weight-bold text-muted text-sm mr-3"><i class="bi bi-toggles"></i></small>
                </div>
            </div>
        </div>
        @foreach ($contacts as $item)
            <div class="py-2 px-3 mb-2 rounded bg-secondary">
                <div class="d-flex ali d-lg-block rounded">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="text-dark" href="#note-{{ $item->id }}" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="note-{{ $item->id }}">
                                <div class="media align-items-center">
                                    <div class="mr-3 my-auto">
                                        @if ($item->has_cycle)
                                            <span class="btn btn-sm badge-primary rounded-circle"><i
                                                    class="fa fa-user text-primary"></i></span>
                                        @else
                                            <span class="btn btn-sm badge-warning rounded-circle"><i
                                                    class="fa fa-user text-warning"></i></span>
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                        <small class="name mb-0 text-xs text-muted d-block">{{ $item->title }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 align-items-center d-none d-lg-block">
                            <small class="mb-0 d-block font-weight-500 text-sm">{{ $item->phone }}</small>
                            @if ($item->email)
                                <small class="mb-0 d-block font-weight-600 text-xs"><i
                                        class="fa fa-envelope mr-2 text-primary"></i>{{ $item->email }}</small>
                            @endif
                        </div>
                        <div class="col-2 media d-none d-lg-inline">
                            @if ($item->note)
                                <p class="mb-0 text" style="line-height: 1;"><small data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ $item->note }}">{{ Str::limit($item->note, 40) }}</small></p>
                            @else
                                <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill shadow-none"
                                    wire:click='newNote({{ $item->id }})'>
                                    <i class="fa fa-plus mr-2"></i>Ajouter une note</a>
                            @endif
                        </div>
                        <div class="col-2 media d-none d-lg-inline">
                            @if ($item->is_manual)
                                <small class="mb-0">Manuel</small>
                            @else
                                <small class="mb-0 text-xs">NFC/QR Code</small>
                            @endif
                        </div>
                        <div class="col-1 media align-items-center justify-content-center border-left">
                            <span class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-primary shadow-none" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <div class="px-3 py-2">
                                        <h6 class="text-xs text-muted m-0">Action</h6>
                                    </div>
                                    <a class="dropdown-item" href="tel:{{ $item->phone }}">
                                        <i class="fa fa-phone text-primary mr-3"></i>Appeler</a>
                                    <a class="dropdown-item" href="mailto:{{ $item->email }}">
                                        <i class="fa fa-paper-plane text-primary mr-3"></i>Envoyer un mail</a>
                                    <a class="dropdown-item" href="#"
                                        wire:click="newCycle({{ $item->id }})"><i
                                            class="bi bi-bag-plus text-warning mr-3"></i>Nouveau cycle</a>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto my-auto">
                        <span class="btn btn-sm badge-success d-lg-none rounded-circle"><a
                                href="{{ route('phoneSave', $item->id) }}"
                                class="fa fa-arrow-down text-success"></a></span>
                    </div>
                </div>

                {{-- Collapse content --}}
                <div class="collapse mt-1" id="note-{{ $item->id }}">
                    <div class="align-items-center d-inline d-lg-none text-sm ml-5">
                        <small class="mb-0 mr-2 font-weight-bold"><i
                                class="fa fa-phone mr-2 text-primary"></i>{{ $item->phone }}</small>
                        @if ($item->email)
                            <small class="mb-0 font-weight-bold"><i
                                    class="fa fa-envelope mr-2 text-primary"></i>{{ $item->email }}</small>
                        @endif
                    </div>
                    <div class="text-sm ml-5 d-block d-lg-none">
                        <small class="">Agent en charge:</small>
                        <small class="">{{ $item->nfcprofile->firstname }}
                            {{ $item->nfcprofile->lastname }}</small>
                    </div>
                    @if ($item->lastNote)
                        <div class="py-1 px-3 rounded bg-lighter mt-3 mb-2">
                            <div class="d-flex justify-content-between pb-1">
                                <div class="text-primary">
                                    <span class="text-xs font-weight-700">
                                        <i href="#" class="fa fa-message mr-2"></i>Note:</span>
                                </div>
                            </div>
                            <div class="mb-2 mt-2">
                                {{-- <h5 class="mt-1 mb-0">{{ $item->lastNote }}</h5> --}}
                                <p class="text-xs">{{ $item->lastNote }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- ADD NOTE MODAL --}}
    <x-jet-dialog-modal maxWidth="sm" wire:model="newNoteModal">
        <x-slot name="title">
            Ajouter une note
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    {{-- <label for="inputPassword4">Ajoutez votre note</label> --}}
                    <textarea class="form-control form-control-muted border-0" cols="10" rows="3" wire:model="note"
                        id="inputPassword4"></textarea>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-primary" wire:click="addNote"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-primary" wire:click="$toggle('newNoteModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>

    {{-- NEW CYCLE MODAL --}}
    <x-jet-dialog-modal maxWidth="sm" wire:model="newCycleModal">
        <x-slot name="title">
            Sélectionnez un produit
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    <select class="custom-select form-control text-xs form-control-muted border-0"
                        wire:model="productId">
                        <option value="" selected>Tous les produits/services</option>
                        @foreach ($products as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-primary" wire:click="createCycle"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-primary" wire:click="$toggle('newCycleModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>

    {{-- NEW CONTACT MODAL --}}
    <x-jet-dialog-modal maxWidth="sm" wire:model="newContactModal">
        <x-slot name="title">
            Ajouter un contact
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group col-12">
                    <input type="text" class="form-control form-control-muted border-0"
                        style="background: #edf0ff;" placeholder="Nom" wire:model="name">
                    <i class="fas fa-user text-primary position-absolute" style="right: 25px;top:30%;"></i>
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control form-control-muted border-0"
                        style="background: #edf0ff;" placeholder="Fonction et Entreprise" wire:model="title">
                    <i class="fas fa-user-tie text-primary position-absolute" style="right: 25px;top:30%;"></i>
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control form-control-muted border-0 position-relative"
                        style="background: #edf0ff;" placeholder="Adresse mail" wire:model="email">
                    <i class="fas fa-envelope text-primary position-absolute" style="right: 25px;top:30%;"></i>
                </div>
                <div class="form-group col-12 mb-3">
                    <input type="text" class="form-control form-control-muted border-0 position-relative"
                        style="background: #edf0ff;" placeholder="Téléphone" wire:model="phone">
                    <i class="fas fa-phone text-primary position-absolute" style="right: 25px;top:30%;"></i>
                </div>
                <div class="ml-3 mb-5">
                    <span class="mr-3 text-muted">Sex:</span>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio1"
                            value="Masculin">
                        <label class="form-check-label" for="inlineRadio1">Masculin</label>
                    </div>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio2"
                            value="Feminin">
                        <label class="form-check-label" for="inlineRadio2">Feminin</label>
                    </div>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-primary" wire:click="addContact"
                            wire:loading.attr="disabled">Ajouter</button>
                        <button type="button" class="btn btn-outline-primary"
                            wire:click="$toggle('newContactModal')" wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>

    {{-- NEW CONTACT TOGGLER --}}
    <a href="#" class="menu-btn text-white d-flex justify-content-center align-items-center"
        wire:click="$toggle('newContactModal')">
        <i class="fa fa-user-plus"></i>
    </a>

    @push('scripts')
        <script>
            function thisDay() {
                document.getElementById("this-week").classList.remove("active");
                document.getElementById("this-month").classList.remove("active");
                document.getElementById("this-day").classList.add("active");
            }

            function thisWeek() {
                document.getElementById("this-month").classList.remove("active");
                document.getElementById("this-day").classList.remove("active");
                document.getElementById("this-week").classList.add("active");
            }

            function thisMonth() {
                document.getElementById("this-week").classList.remove("active");
                document.getElementById("this-day").classList.remove("active");
                document.getElementById("this-month").classList.add("active");
            }
        </script>
    @endpush
</div>

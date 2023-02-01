
<div>
    <div class="header bg-info py-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="align-items-center mt-4 py-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 text-white h1">Conversion</h2>
                        {{-- <div class="d-lg-none">
                            <button type="button" id="this-month" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isClient()'>
                                Clients
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isProspect()'>
                                Prospects
                            </button>
                        </div> --}}
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-4 form-group position-relative mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i class="fas fa-search text-info position-absolute" style="right: 25px;top:25%;"></i>
                        </div>
                        <div class="col-lg-5 mt-3 mt-lg-0 d-flex d-lg-inline text-lg-right justify-content-between justify-content-lg-end" role="group" aria-label="Basic example">
                            <button type="button" id="this-day" class="btn btn-sm btn-secondary shadow-none" onclick="thisDay()" wire:click='thisDay()'>
                                Aujourd'hui
                            </button>
                            <button type="button" id="this-week" class="btn btn-sm btn-secondary shadow-none" onclick="thisWeek()" wire:click='thisWeek()'>
                                Cette semaine
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-secondary shadow-none" onclick="thisMonth()" wire:click='thisMonth()'>
                                Ce mois
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-secondary shadow-none" onclick="thisYear()" wire:click='thisYear()'>
                                Cette année
                            </button>
                        </div>
                        {{-- <div class="col-lg-3 d-none d-lg-inline text-right">
                            <button type="button" id="this-month" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isClient()'>
                                Clients
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isProspect()'>
                                Prospects
                            </button>
                        </div> --}}
                    </div>
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
                <div class="col-2 media align-items-center justify-content-center d-none d-lg-block">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Status</span>
                </div>
                <div class="col-3 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Note</span>
                </div>
                <div class="col-4 col-lg-3 media d-none d-lg-inline">
                    <small class="mb-0 font-weight-bold text-muted text-sm">Agent En charge</small>
                </div>
            </div>
        </div>
        @foreach ($contacts as $item)
            <div class="py-2 px-3 mb-2 rounded bg-secondary">
                <div class="d-flex ali d-lg-block rounded">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="text-dark" href="#note-{{ $item->id }}" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="note-{{ $item->id }}">
                                <div class="media align-items-center">
                                    <div class="mr-3 my-auto">
                                        @if ($item->is_client == false)
                                            <span class="btn btn-sm badge-light rounded-circle">
                                                <i class="fa fa-hourglass-half text-light"></i>
                                            </span>
                                        @else
                                            <span class="btn btn-sm badge-info rounded-circle">
                                                <i class="fa fa-check text-info"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                        <small class="name mb-0 text-xs text-muted d-block">{{ $item->title }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-2 media align-items-center d-none d-lg-block">
                            @if ($item->is_client == false)
                                <span class="badge badge-light">Prospect</span>
                            @else
                                <span class="badge badge-info">Client</span>
                            @endif
                        </div>
                        <div class="col-lg-3 align-items-center d-none d-lg-block">
                            @if ($item->is_client == false)
                                <small class="mb-0 d-block font-weight-500 text-sm">En cours de conversion</small>
                                <small class="mb-0 d-block font-weight-600 text-xs text-muted">Nombre de contacts effectué <span class="badge badge-circle badge-light">{{ $item->appointments->count() }}</span></small>
                            @else
                                <small class="mb-0 d-block font-weight-500 text-sm">Client depuis le {{ $item->converted_at }}</small>
                                <small class="mb-0 d-block font-weight-600 text-xs text-warning">Nombre d'achat effectué <span class="badge badge-circle badge-warning text-danger">{{ $item->purchases->count() }}</span></small>
                            @endif
                        </div>
                        <div class="col-3 d-none d-lg-flex align-items-center justify-content-between">
                            <small class="mb-0">{{ $item->nfcprofile->firstname }} {{ $item->nfcprofile->lastname }}</small>
                            <span class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-primary shadow-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="tel:{{ $item->phone }}"><i class="fas fa-phone text-primary mr-3"></i>Appeler</a>
                                        <a class="dropdown-item" href="mailto:{{ $item->email }}"><i class="fas fa-paper-plane text-info mr-3"></i>Envoyer un mail</a>
                                        <a class="dropdown-item" href="#" wire:click="showApointmentModal({{ $item->id }})"><i class="bi bi-calendar-plus text-warning mr-3"></i>Enregistrer un RDV</a>
                                        <a class="dropdown-item" href="#" wire:click="showSaleModal({{ $item->id }})"><i class="bi bi-cart-plus-fill text-warning mr-3"></i>Enregistrer un achat</a>
                                    </div>
                                </span>
                        </div>
                    </div>
                    <div class="ml-auto my-auto">
                        <div class="d-lg-none">
                            @if ($item->is_client == false)
                                <span class="badge badge-light">Prospect</span>
                            @else
                                {{-- <span class="badge badge-info">Client</span> --}}
                                <span class="dropdown ml-auto">
                                    <a class="badge badge-info shadow-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Client
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="tel:{{ $item->phone }}"><i class="fas fa-phone text-primary mr-3"></i>Appeler</a>
                                        <a class="dropdown-item" href="mailto:{{ $item->email }}"><i class="fas fa-paper-plane text-info mr-3"></i>Envoyer un mail</a>
                                        <a class="dropdown-item" href="#"><i class="bi bi-calendar-plus text-warning mr-3"></i>Enregistrer un RDV</a>
                                    </div>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Collapse content --}}
                <div class="collapse mt-1" id="note-{{ $item->id }}">
                    <div class="align-items-center d-lg-none text-sm ml-5">
                        <small class="mb-0 mr-2 font-weight-bold d-block">Client depuis le {{ $item->converted_at }}</small>
                        <small class="mb-0 mr-2 font-weight-bold">Nombre de contacts effectué</small>
                    </div>
                    <div class="text-sm ml-5 d-block d-lg-none">
                        <small class="">Agent en charge:</small>
                        <small class="">{{ $item->nfcprofile->firstname }} {{ $item->nfcprofile->lastname }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Record sale modal -->

    <x-jet-dialog-modal maxWidth="sm" wire:model="saleModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    {{-- <input type="text" value="{{Auth::user()->name}}" wire:model="userId"> --}}
                    <label for="inputEmail4">Montant</label>
                    <input type="number" class="form-control form-control-muted border-0" wire:model="amount"
                        id="inputEmail4">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Description</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="description"
                        id="inputPassword4">
                </div>
                {{-- <div class="form-group">
                    <label for="inputPassword4">Siet web</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="contactId"
                        id="inputPassword4">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Secteur d'activité</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="profileId"
                        id="inputPassword4">
                </div> --}}

                <div class="form-group">
                    <select class="custom-select form-control form-control-muted" wire:model="product">
                        <option selected>Produit...</option>
                        @foreach ($products as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-primary" wire:click="recordSale"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-primary" wire:click="$toggle('saleModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Record appointment modal -->

    <x-jet-dialog-modal maxWidth="sm" wire:model="appointmentModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    {{-- <input type="text" value="{{Auth::user()->name}}" wire:model="userId"> --}}
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Description</label>
                    <textarea cols="30" rows="4" class="form-control form-control-muted border-0" wire:model="title"
                        id="inputPassword4"></textarea>
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Date</label>
                    <input type="datetime-local" class="form-control form-control-muted border-0" wire:model="date"
                        id="inputPassword4">
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-primary" wire:click="recordAppointment"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-primary" wire:click="$toggle('appointmentModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>


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

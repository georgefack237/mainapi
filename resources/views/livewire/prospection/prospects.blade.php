<div>
    {{-- Page header --}}
    <div class="header py-4 bg-white">
        <div class="container-fluid">
            <div class="header-body">
                <div class="align-items-center py-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 h1">Prospects</h2>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-9 form-group position-relative mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i
                                class="fas fa-search text-primary position-absolute" style="right: 25px;top:25%;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Page header end --}}

    <div class="container-fluid mb-5 mt-3">
        <div class="row">
            <div class="col-lg-9">

                {{-- List header --}}
                <div class="py-1 px-3 mt-2 mb-3 rounded bg-secondary d-none d-lg-block">
                    <div class="row">
                        <div class="col-8 col-lg-4">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 font-weight-bold text-muted text-sm">Nom</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 media align-items-center">
                            <span class="mb-0 font-weight-bold text-muted text-sm">Produits/Services</span>
                        </div>
                        <div class="col-2 media align-items-center">
                            <span class="mb-0 font-weight-bold text-muted text-sm">Prospect</span>
                        </div>
                        <div class="col-4 col-lg-2 media d-none d-lg-flex align-items-center justify-content-between">
                            <small class="mb-0 font-weight-bold text-muted text-sm"><i class="bi bi-calendar-check"></i></small>
                            <small class="mb-0 font-weight-bold text-muted text-sm mr-3"><i class="bi bi-toggles"></i></small>
                        </div>
                    </div>
                </div>
                {{-- List header end --}}

                {{-- List satrt --}}
                @foreach ($leads as $item)
                    <div class="py-2 px-3 mb-2 rounded bg-secondary shadow-lg--hover">
                        <div class="d-flex ali d-lg-block rounded">
                            <div class="row">
                                <div class="col-lg-4">
                                    <a class="text-muted" href="#note-{{ $item->id }}" data-toggle="collapse"
                                        role="button" aria-expanded="false" aria-controls="note-{{ $item->id }}">
                                        <div class="media align-items-center">
                                            <div class="mr-3 my-auto">
                                                <span class="btn btn-sm badge-info rounded-circle">
                                                    <i class="fa fa-hourglass-half text-info"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text-sm font-weight-bold">{{ $item->contact_name }}</span>
                                                {{-- <small class="name mb-0 text-xs text-muted d-block">{{ $item->title }}</small> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4 media align-items-center d-none d-lg-block">
                                    <span class="badge badge-info">{{ $item->product->name }}</span>
                                </div>
                                <div class="col-lg-2 align-items-center d-none d-lg-block">
                                    <small
                                        class="mb-0 d-block font-weight-500 text-sm text-capitalize">{{ $item->status }}</small>
                                </div>
                                <div class="col-2 d-none d-lg-flex align-items-center justify-content-between">
                                    <small class="mb-0">{{ $item->appointments->count() }}</small>
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
                                            <a class="dropdown-item" href="tel:{{ $item->contact->phone }}"><i
                                                    class="fas fa-phone text-primary mr-3"></i>Appeler</a>
                                            <a class="dropdown-item" href="mailto:{{ $item->contact->email }}"><i
                                                    class="fas fa-paper-plane text-info mr-3"></i>Envoyer un mail</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="showNewApointmentModal({{ $item->id }})"><i
                                                    class="bi bi-calendar-plus text-warning mr-3"></i>Enregistrer un
                                                RDV</a>
                                            <div class="dropdown-divider"></div>
                                            <div class="px-3 py-2">
                                                <h6 class="text-xs text-muted m-0">Status du prospect</h6>
                                            </div>
                                            <a class="dropdown-item" href="#"
                                                wire:click='makeProspect({{ $item->id }})'><i
                                                    class="fa fa-fire text-warning mr-3"></i>Tiede</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click='makeWarmProspect({{ $item->id }})'><i
                                                    class="fas fa-fire text-danger mr-3"></i>Chaud</a>
                                            <div class="dropdown-divider"></div>
                                            <div class="px-3 py-2">
                                                <h6 class="text-xs text-muted m-0">Convertir en</h6>
                                            </div>
                                            <a class="dropdown-item" href="#"
                                                wire:click='makeOpportunity({{ $item->id }})'><i
                                                    class="fa fa-user-plus text-primary mr-3"></i>Opportunité</a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="ml-auto my-auto">
                                <div class="d-lg-none">
                                    @if ($item->contact->is_manual == false)
                                        <span class="badge badge-light">Prospect</span>
                                    @else
                                        <span class="dropdown ml-auto">
                                            <a class="badge badge-info shadow-none" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Client
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#"><i
                                                        class="bi bi-calendar-plus text-warning mr-3"></i>Enregistrer
                                                    un RDV</a>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Collapse content --}}
                        <div class="collapse mt-1" id="note-{{ $item->id }}">
                            <div class="text-sm ml-5 py-2 d-block border-top d-flex">
                                <small class="font-weight-700">{{ $item->contact->title }}</small>
                                <small class="font-weight-700 ml-auto">Agent en charge:</small>
                                <small class="font-weight-700">{{ $item->profile->firstname }}
                                    {{ $item->profile->lastname }}</small>
                            </div>
                            <div class="text-xs ml-5">
                                @foreach ($item->appointments as $appoint)
                                    <div class="bg-lighter rounded my-2 py-3 px-3">
                                        <div class="d-flex">
                                            <small
                                                class="text-capitalize font-weight-bold bg-white rounded-pill px-2 py-1">Le
                                                {{ $appoint->created_at->format('d M Y') }}</small>
                                            <a href="#" wire:click="showAppointmentModal({{ $appoint->id }})"
                                                class="text-underline ml-auto"><i
                                                    class="fa fa-pencil mr-1"></i>Modifier</a>
                                        </div>
                                        <span class="d-block text-capitalize mt-2"><strong
                                                class="text-primary">Rendez-vous:
                                            </strong>{{ $appoint->type }}</span>
                                        <span class="d-block text-capitalize"><strong class="text-primary">Observation
                                                ({{ $appoint->observation }})
                                                : </strong>{{ $appoint->note }}</span>
                                        <span class="d-block text-capitalize"><strong class="text-primary">Coût
                                                d'aquisition: </strong>XAF {{ $appoint->cost }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- List end --}}
            </div>

            {{-- Filters Section --}}
            <div class="col-lg-3">
                <div class="filters mt--7 bg-white rounded overflow-hidden shadow-lg">
                    <div class="d-flex align-items-center bg-primary px-3 py-2 mb-3">
                        <h4 class="h3 text-white mb-0">Filtrer par</h4>
                        <span class="ml-auto text-white text-xs" wire:click='resetFilter()'><i
                                class="fa fa-arrows-rotate mr-2"></i><a href="#"
                                class="text-white">Reinitialiser</a></span>
                    </div>

                    <div class="px-2">
                        <span class="text-muted text-xs font-weight-700 d-block mb-2">Prospects</span>
                        <div class="d-flex">
                            <button type="button" id="this-month"
                                class="btn btn-sm btn-primary text-white mr-1 shadow-none" wire:click='allLeads()'>
                                Tous
                            </button>
                            <button type="button" id="this-month"
                                class="btn btn-sm btn-primary text-white mr-1 shadow-none"
                                wire:click='warm()'>
                                Tiedes
                            </button>
                            <button type="button" id="this-month"
                                class="btn btn-sm btn-primary text-white m-0 shadow-none"
                                wire:click='hot()'>
                                Chauds
                            </button>
                        </div>

                        <div class="">
                            <div class="form-group mb-2 mt-2">
                                <label class="text-muted text-xs font-weight-700" for="inputPassword4">Agent</label>
                                <select class="custom-select form-control form-control-muted border-0"
                                    wire:model="agentId">
                                    <option value="" selected>Tous les agents</option>
                                    @foreach ($agents as $item)
                                        <option value="{{ $item->id }}">{{ $item->firstname }}
                                            {{ $item->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted text-xs font-weight-700"
                                    for="inputPassword4">Produits</label>
                                <select class="custom-select form-control form-control-muted border-0"
                                    wire:model="productId">
                                    <option value="" selected>Tous les produits/services</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted text-xs font-weight-700"
                                    for="inputPassword4">Observations</label>
                                <select class="custom-select form-control form-control-muted border-0"
                                    wire:model="observation">
                                    <option value="" selected>Toutes les observations</option>
                                    <option value="question">Question</option>
                                    <option value="objection">Objection</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted text-xs font-weight-700" for="inputPassword4">Date
                                    de:</label>
                                <input type="date" class="form-control form-control-muted border-0"
                                    wire:model="fromDate">
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-muted text-xs font-weight-700" for="inputPassword4">à:</label>
                                <input type="date" class="form-control form-control-muted border-0"
                                    wire:model="toDate">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="rounded bg-primary shadow-lg mt-2 px-4 py-2">
                    <h2 class="text-white h3 mb-0">{{ $leads->count() }} Prospect(s)</h2>
                </div>
            </div>
            {{-- Filters Section end --}}

        </div>
    </div>

    {{-- Appointment Modal --}}
    <x-jet-dialog-modal maxWidth="sm" wire:model="appointmentModal">
        <x-slot name="title">
            {{ $modalTitle }}
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    <label class="text-sm" for="inputPassword4">Date</label>
                    <input type="datetime-local" class="form-control form-control-muted border-0" wire:model="date"
                        id="inputPassword4" @if ($showDate == false) disabled @endif>
                </div>
                <div class="form-group">
                    <select class="custom-select form-control form-control-muted border-0" wire:model="Type">
                        <option value="" selected>Type de rendez-vous...</option>
                        <option value="téléphonique">téléphonique</option>
                        <option value="présentiel">présentiel</option>
                        <option value="visio">visio</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-muted border-0" wire:model="title"
                        id="inputPassword4" placeholder="Titre...">
                </div>
                <div class="form-group">
                    <select class="custom-select form-control form-control-muted border-0" wire:model="Observation">
                        <option value="" selected>Observation...</option>
                        <option value="question">Question</option>
                        <option value="objection">Objection</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control form-control-muted border-0" id="" cols="30" rows="5"
                        wire:model="note" placeholder="Note..."></textarea>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control form-control-muted border-0" wire:model="cost"
                        id="inputPassword4" placeholder="Coût">
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        @if ($showDate == false)
                            <button type="button" class="btn btn-primary" wire:click="updateAppointment()"
                                wire:loading.attr="disabled">Enregistrer</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="recordAppointment()"
                                wire:loading.attr="disabled">Enregistrer</button>
                        @endif
                        <button type="button" class="btn btn-outline-primary"
                            wire:click="$toggle('appointmentModal')" wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>
</div>

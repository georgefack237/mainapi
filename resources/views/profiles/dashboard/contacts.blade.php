<div>
    <div class="header bg-primary py-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="align-items-center mt-4 py-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 text-white h1">Contacts</h2>
                        <div>
                            <a href="#" class="btn btn-sm btn-outline-secondary text-white shadow-none d-sl-inline d-lg-none ml-4"
                                onclick="event.preventDefault();
                                                                 document.getElementById('save-form').submit();"><i
                                    class="fa fa-arrow-down mr-2"></i>Enregistrer tout</a>

                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-5 form-group position-relative mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i class="fas fa-search text-primary position-absolute" style="right: 25px;top:25%;"></i>
                        </div>
                        <div class="col-lg-5 mt-3 mt-lg-0 d-flex justify-content-between justify-content-lg-end" role="group" aria-label="Basic example">
                            <button type="button" id="this-day" class="btn btn-sm btn-secondary badge-primary shadow-none" onclick="thisDay()" wire:click='thisDay()'>
                                Aujourd'hui
                            </button>
                            <button type="button" id="this-week" class="btn btn-sm btn-secondary badge-primary shadow-none" onclick="thisWeek()" wire:click='thisWeek()'>
                                Cette semaine
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-secondary badge-primary shadow-none" onclick="thisMonth()" wire:click='thisMonth()'>
                                Ce mois
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-secondary badge-primary shadow-none" onclick="thisYear()" wire:click='thisYear()'>
                                Cette année
                            </button>
                        </div>
                        <div class="col-lg-2 text-right">
                        <a href="#" class="btn btn-sm btn-outline-secondary text-white shadow-none d-none d-lg-inline ml-4" onclick="event.preventDefault();
                                                                 document.getElementById('save-form').submit();"><i class="fa fa-arrow-down mr-2"></i>Enregistrer tout</a>
                        </div>
                    </div>
                    <form id="save-form" method="POST" action="{{ route('batchSave') }}">
                        @csrf
                        <input type="hidden" name="date" value="{{$whereDate}}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-5">
        <div class="mt-3">
            <div class="nfc-profile-item py-1 my-2 px-3 rounded d-none d-lg-block">
                <div class="row">
                    <div class="col-8 col-lg-7">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 font-weight-bold text-muted text-sm">Nom</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-3 media align-items-center">
                        <span class="mb-0 font-weight-bold text-muted text-sm">Numéro</span>
                    </div>
                    <div class="col-1 media align-items-center justify-content-center border-left">
                        <span class="mb-0 font-weight-bold text-muted text-sm">Enregistrer</span>
                    </div>
                </div>
            </div>
            @foreach ($contacts as $item)
                <div class="py-2 px-3 mb-2 rounded bg-secondary">
                    <div class="d-flex ali d-lg-block rounded">
                        <div class="row">
                            <div class="col-lg-7">
                                <a class="text-dark" href="#note-{{ $item->id }}" data-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="note-{{ $item->id }}">
                                    <div class="media align-items-center">
                                        <div class="mr-3 my-auto">
                                            <span class="btn btn-sm badge-primary rounded-circle"><i
                                                    class="fa fa-user text-primary"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                            <small
                                                class="name mb-0 text-xs text-muted d-block">{{ $item->title }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 align-items-center">
                                <small class="mb-0 d-none d-lg-block" id="{{ $item->phone }}">{{ $item->phone }}</small>
                                @if ($item->email)
                                    <small class="mb-0 d-none d-lg-block font-weight-bold"><i class="fa fa-envelope mr-2 text-primary"></i>{{ $item->email }}</small>
                                @endif
                            </div>
                            <div class="col-1 media align-items-center justify-content-center border-left">
                                {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                                <a href="{{ route('phoneSave', $item->id) }}"
                                    class="fa fa-arrow-down text-success mx-auto  d-none d-lg-block"></a>
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
                        <div class="align-items-center text-sm ml-5">
                            <small class="mb-0 mr-2"><i
                                    class="fa fa-phone mr-2 text-primary"></i>{{ $item->phone }}</small>
                            @if ($item->email)
                                <small class="mb-0"><i
                                        class="fa fa-envelope mr-2 text-primary"></i>{{ $item->email }}</small>
                            @endif
                        </div>
                        @if ($item->lastNote)
                            <div class="py-1 px-3 rounded bg-lighter mt-3 mb-2">
                                <div class="d-flex justify-content-between pb-1 border-bottom border-light">
                                    <div class="text-primary">
                                        <span class="text-xs font-weight-700">
                                            <i href="#" class="fa fa-message mr-2"></i>Note Recente:</span>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="#" class="rounded-circle text-xs text-dark"
                                            wire:click="showAddNote({{ $item->id }})">
                                            <span class="fa fa-plus text-info mr-2"></span>Nouvelle
                                            note
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-2 mt-2">
                                    {{-- <h5 class="mt-1 mb-0">{{ $item->lastNote }}</h5> --}}
                                    <p class="text-xs">{{ $item->lastNote }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('profile.contacts.notes', $item->id) }}"
                                    class="btn btn-sm badge-light text-primary mb-2 mt-1">Voir les notes</a>
                            </div>
                        @else
                            <div class="border-top mt-2">
                                <a href="#" class="text-xs text-dark" wire:click="showAddNote({{ $item->id }})">
                                    <span href="#" class="fa fa-plus text-info mr-2"></span>Nouvelle note
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-jet-dialog-modal maxWidth="lg" wire:model="addNoteModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <div class="text-center mb-4">
                <h4 class="h2 text-muted">Ajouter une note</h4>
            </div>
            <form>
                <input type="hidden" wire:model="contactId">
                <div class="form-group">
                    <label for="inputAddress">Titre</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="title"
                        id="inputAddress">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Contenu</label>
                    <textarea type="text" class="form-control form-control-muted border-0" wire:model="body" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Date</label>
                    <input type="date" class="form-control form-control-muted border-0" wire:model="date"
                        id="inputAddress">
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-success" wire:click="addNote"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-success" wire:click="$toggle('addNoteModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>
</div>

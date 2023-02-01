<div>
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between">
            <h1 class="mb-4"> Notes & Rendez-vous</h1>
            <div>
                {{-- <a href="#" class="btn btn-sm btn-success shadow-none d-none d-lg-inline ml-4" wire:click="showAddNote({{ $item->id }})">
                    <i class="fa fa-plus mr-2"></i>Enregistrer tout
                </a> --}}

            </div>
        </div>
        <div class="mt-3">
            <div class="d-flex align-items-center py-2 px-3 mb-2 bg-secondary d-lg-block rounded">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="media align-items-center">
                            <div class="mr-3 my-auto">
                                <span class="btn btn-lg badge-success rounded-circle"><i
                                        class="fa fa-user fa-2x text-success"></i></span>
                            </div>
                            <div class="media-body">
                                <span class="name mb-0 text-sm font-weight-bold">{{ $contact->name }}</span>
                                <small class="name mb-0 text-xs text-muted d-block">{{ $contact->title }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-lg-flex align-items-center d-none">
                            <span class="fa fa-phone fa-2x mr-2 ml-auto"></span>
                            <span class="display-3 mb-0" id="{{ $contact->phone }}">{{ $contact->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-lg-flex justify-content-between mt-4">
            {{-- <div class="form-group position-relative mb-0">
                <input wire:model="search" class="form-control form-control-sm form-control-muted bg-lighter"
                    placeholder="Recherche..." type="text"><i class="fas fa-search text-muted position-absolute"
                    style="right: 10px;top:25%;"></i>
            </div> --}}
            {{-- <div class="mt-3 mt-lg-0 d-flex justify-content-between" role="group" aria-label="Basic example">
                <button type="button" id="this-day" class="btn btn-sm btn-secondary badge-info shadow-none"
                    onclick="thisDay()" wire:click='thisDay()'>
                    Aujourd'hui
                </button>
                <button type="button" id="this-week" class="btn btn-sm btn-secondary badge-info shadow-none"
                    onclick="thisWeek()" wire:click='thisWeek()'>
                    Cette semaine
                </button>
                <button type="button" id="this-month" class="btn btn-sm btn-secondary badge-info shadow-none"
                    onclick="thisMonth()" wire:click='thisMonth()'>
                    Ce mois
                </button>
                <button type="button" id="this-month" class="btn btn-sm btn-secondary badge-info shadow-none"
                    onclick="thisYear()" wire:click='thisYear()'>
                    Cette année
                </button>
            </div> --}}
            {{-- <a href="#" class="btn btn-sm btn-success shadow-none d-none d-lg-inline ml-4" wire:click="showAddNote({{ $item->id }})">
                <i class="fa fa-plus mr-2"></i>Enregistrer tout
            </a> --}}
        </div>
        {{-- <hr class="d-block d-lg-none mb-0"> --}}
        <div class="position relative">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Notes d'entretiens</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">Rendez-vous</button>
                </li>
            </ul>
            <div class="flex position-absolute top-50 end-0 translate-middle">
                <a href="#" class="btn btn-sm badge-success d-lg-none rounded-circle" wire:click="showAddNote({{ $contact->id }})">
                    <span class="fa fa-plus"></span>
                </a>
            </div>
        </div>
        <div class="tab-content mt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="">
                    @if ($notes)
                        @foreach ($notes as $note)
                            <div class="py-1 px-3 position-relative rounded bg-lighter mt-3 mb-3">
                                <i class="position-absolute top-50 start-100 translate-middle mt-1 fa fa-caret-right fa-2x text-lighter"></i>
                                <div class="mb-2 mt-2">
                                    <h5 class="mt-1 mb-0">{{ $note->title }}</h5>
                                    <p class="text-xs">{{ $note->body }}</p>
                                </div>
                                <div class="text-right">

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <h1 class="text-muted mt-4">Aucune notes n'a été enregistré pour le moment</h1>
                        </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="">
                    @if ($rdv)
                        @foreach ($rdv as $item)
                            <div class="py-1 px-3 position-relative rounded bg-lighter mt-3 mb-3">
                                <i class="position-absolute top-50 start-100 translate-middle mt-1 fa fa-caret-right fa-2x text-lighter"></i>
                                <div class="mb-2 mt-2">
                                    <h5 class="mt-1 mb-0">{{ $item->title }}</h5>
                                    <p class="text-xs">{{ $item->body }}</p>
                                </div>
                                <div class="text-right">

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <h1 class="text-muted mt-4">Aucune notes n'a été enregistré pour le moment</h1>
                        </div>
                    @endif
                </div>
            </div>
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

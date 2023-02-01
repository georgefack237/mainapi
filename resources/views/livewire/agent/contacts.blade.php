<div>
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between">
            <h1 class="mb-4">Contacts</h1>
            <div>
                <a href="#" class="btn btn-sm btn-secondary badge-success shadow-none d-sl-inline d-lg-none ml-4"
                    onclick="event.preventDefault();
                                                     document.getElementById('save-form').submit();"><i
                        class="fa fa-arrow-down mr-2"></i>Enregistrer tout</a>

            </div>
        </div>
        <div class="d-lg-flex justify-content-between mt-4">
            <div class="form-group position-relative mb-0">
                <input wire:model="search" class="form-control form-control-sm form-control-muted bg-lighter"
                    placeholder="Recherche..." type="text"><i class="fas fa-search text-muted position-absolute"
                    style="right: 10px;top:25%;"></i>
            </div>
            <div class="mt-3 mt-lg-0 d-flex justify-content-between" role="group" aria-label="Basic example">
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
            </div>
            <a href="#" class="btn btn-sm btn-success shadow-none d-none d-lg-inline ml-4"
                onclick="event.preventDefault();
                                                     document.getElementById('save-form').submit();"><i
                    class="fa fa-arrow-down mr-2"></i>Enregistrer tout</a>
        </div>
        <form id="save-form" method="POST" action="{{ route('batchSave') }}">
            @csrf
            <input type="hidden" name="date" value="{{ $whereDate }}">
        </form>
        <hr class="d-block d-lg-none mb-0">
        {{-- <hr> --}}
        <div class="mt-3">
            <div class="nfc-profile-item py-1 my-2 px-3 rounded d-none d-lg-block" style="background:#eef5fd;">
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
                        <span class="mb-0 font-weight-bold text-muted text-sm">Actions</span>
                    </div>
                </div>
            </div>
            @foreach ($contacts as $item)
                <div class="nfc-profile-item py-2 px-3 d-flex ali d-lg-block rounded"
                    @if ($loop->even) style="background:#eef5fd;" @endif>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                    <small class="name mb-0 text-xs text-muted d-block">{{ $item->title }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 align-items-center">
                            <small class="mb-0 d-block" id="{{ $item->phone }}">{{ $item->phone }}</small>
                            {{-- <span class="btn btn-sm badge-success d-block d-lg-none"><a href="{{ route('phoneSave', $item->id) }}" class="fa fa-arrow-down text-success mr-2"></a> Enregistrer</span> --}}
                        </div>
                        <div class="col-1 media align-items-center justify-content-center border-left">
                            {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                            <a href="{{ route('phoneSave', $item->id) }}"
                                class="fa fa-arrow-down text-success mx-auto  d-none d-lg-block"></a>
                        </div>
                    </div>
                    <div class="ml-auto my-auto">
                        <span class="btn btn-sm badge-success d-lg-none rounded-circle"><a
                                href="{{ route('phoneSave', $item->id) }}" class="fa fa-arrow-down text-success"></a></span>
                    </div>
                </div>
                <div class="d-flex justify-content-between py-1 px-3 rounded bg-secondary my-1">
                    <a class="text-info" data-toggle="collapse" href="#note-{{ $item->id }}"
                        role="button" aria-expanded="false" aria-controls="note-{{ $item->id }}">
                        <span class="text-xs font-weight-700">Note Recente:</span>
                        <span class="text-xs">Lorem Ipsum Note Title</span>

                    </a>
                    <div class="ml-auto">
                        <span class="mr-0 d-lg-none rounded-circle"><a
                            href="#" class="fa fa-pen text-info" wire:click="showAddNote"></a></span>
                    </div>
                </div>
                <div class="collapse" id="note-{{ $item->id }}">
                    <div class="card card-body shadow-none">
                        Some placeholder content for the collapse component. This panel is hidden by default but revealed
                        when the user activates the relevant trigger.
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-jet-dialog-modal maxWidth="lg" wire:model="addNoteModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>

                <div class="form-group">
                    <label for="inputAddress">Titre</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="title"
                        id="inputAddress" placeholder="www.exempele.com">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Contenu</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="body"
                        id="inputAddress" placeholder="www.exempele.com">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Date</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="date"
                        id="inputAddress" placeholder="www.exempele.com">
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

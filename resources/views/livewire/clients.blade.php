<div class="mt-3">
    {{-- <a href="#" class="btn btn-sm btn-success mb-3" wire:click="showCreate">Nouvau</a> --}}
    <div class="row mb-3">
        <div class="col-lg-5 col-8">
            <div class="form-group position-relative d-block mb-0">
                <input wire:model="search" class="form-control form-control-sm form-control-muted bg-lighter"
                    placeholder="Recherche..." type="text"><i class="fas fa-search text-muted position-absolute" style="right: 10px;top:25%;"></i>
            </div>
        </div>
        <div class="col-lg-2 col-4 text-right">
            <div class="form-group">
                <select wire:model.lazy="perPage" class="form-control form-control-sm form-control-muted bg-lighter"
                    id="exampleFormControlSelect1">
                    @for ($i = 5; $i <= 25; $i += 5)
                        <option value="{{ $i }}">{{ $i }} par page</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-lg-5 text-right d-none d-lg-block">
            <div class="mt-3 mt-lg-0 d-flex align-items-center border-left pl-4" role="group" aria-label="Basic example">
                <span class="text-sm mr-2">Filtrer par :</span>
                <button type="button" id="this-day" class="btn btn-sm btn-secondary badge-info font-weight-light shadow-none" onclick="thisDay()" wire:click='thisDay()'>
                    Stardard
                </button>
                <button type="button" id="this-week" class="btn btn-sm btn-secondary badge-warning font-weight-light shadow-none" onclick="thisWeek()" wire:click='thisWeek()'>
                    Entreprise
                </button>
                <button type="button" id="this-month" class="btn btn-sm btn-secondary badge-primary font-weight-light shadow-none" onclick="thisMonth()" wire:click='thisMonth()'>
                    Entreprise Plus
                </button>
                <a href="#" wire:click="showCreate" class="btn btn-sm btn-info ml-auto shadow-none"><i class="fa fa-plus mr-1"></i> Nouveau</a>
            </div>
        </div>
    </div>
    @foreach ($clients as $item)
        <div class="nfc-profile-item bg-secondary py-2 px-3 mb-2 rounded">
            <div class="row">
                <div class="col-4 d-flex align-items-center">
                    <div class="media">
                        <div class="media-body d-flex align-content-center">
                            <div class="rounded-circle {{$item->package_id == 1 ? 'bg-info' : 'bg-primary' }} mr-3 my-auto" style="height: 8px; width: 8px;"></div>
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="{{ asset('storage/img/nfc/profile/default.jpg') }}">
                            </a>
                            <div>
                                <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                <small class="name mb-0 text-xs text-muted d-block">{{ $item->specialization }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 align-items-center">
                    <span class="name mb-0 text-sm font-weight-bold">{{ $item->website }}</span>
                    <small class="name mb-0 text-xs text-muted d-block">{{ $item->email }}</small>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <span class="mb-0 text-sm">{{ $item->country }}</span>
                    {{-- <small class="name mb-0 text-muted d-block">{{ $item->address }}</small> --}}
                </div>
                <div class="col-2 media d-flex align-items-center">
                    <span class="mb-0 text-capitalize badge {{$item->package->color}} rounded">{{ $item->package->name }}</span>
                </div>
                <div class="col-1 media align-items-center justify-content-center border-left">
                    {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                    <a href="{{ route('admin.client', $item->id) }}" class="btn btn-info btn-sm rounded mx-auto shadow-none"><i
                            class="fa fa-eye mr-1"></i>Voir</a>
                </div>
            </div>
        </div>
    @endforeach
    <div class="">
        <div class="col-md-6 ml-auto">
            {{ $clients->links() }}
        </div>
    </div>

    <!-- Create profile modal -->

    <x-jet-dialog-modal maxWidth="sm" wire:model="createModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    {{-- <input type="text" value="{{Auth::user()->name}}" wire:model="userId"> --}}
                    <label for="inputEmail4">Nom</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="name"
                        id="inputEmail4">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Adress mail</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="email"
                        id="inputPassword4">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Siet web</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="website"
                        id="inputPassword4">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Secteur d'activité</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="specialization"
                        id="inputPassword4">
                </div>

                <div class="form-group">
                    <label for="inputEmail4">Pay</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="country"
                        id="inputEmail4">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-10">
                        <select class="custom-select form-control form-control-muted" wire:model="package">
                            <option selected>Package...</option>
                            @foreach ($packages as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control form-control-muted border-0" placeholder="Limit" wire:model="createLimit"
                            id="inputEmail4">
                    </div>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-success" wire:click="create"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-success" wire:click="$toggle('createModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>
</div>

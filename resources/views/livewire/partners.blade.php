<div class="mt-3">
    <a href="#" class="btn btn-sm btn-success mb-3" wire:click="showCreate">Nouvau</a>
    @foreach ($partners as $item)
        <div class="nfc-profile-item bg-secondary shadow-lg py-2 px-3 mb-3 rounded">
            <div class="row">
                <div class="col-3 d-flex align-items-center">
                    <div class="media">
                        <div class="media-body d-flex align-content-center">
                            <div class="rounded-circle bg-success mr-3 my-auto" style="height: 8px; width: 8px;"></div>
                            <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                            {{-- <small class="name mb-0 text-sm text-muted d-block">{{ $item->email }}</small> --}}
                        </div>
                    </div>
                </div>
                <div class="col-2 align-items-center">
                    <span class="name mb-0 text-sm font-weight-bold">{{ $item->phone }}</span>
                    <small class="name mb-0 text-muted d-block">{{ $item->email }}</small>
                </div>
                <div class="col-4 align-items-center">
                    <span class="mb-0 text-sm font-weight-bold">{{ $item->country }}, {{ $item->city }}</span>
                    <small class="name mb-0 text-muted d-block">{{ $item->address }}</small>
                </div>
                <div class="col-2 media d-flex align-items-center">
                    <span class="mb-0 badge badge-danger rounded">Limite:{{ $item->create_limit }}</span>
                </div>
                <div class="col-1 media align-items-center justify-content-center border-left">
                    {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                    <a href="#" class="btn btn-info btn-sm rounded-pill mx-auto shadow-none"><i class="fa fa-eye mr-1"></i>Voir</a>
                </div>
            </div>
        </div>
    @endforeach

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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Téléphone</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="phone"
                            id="inputPassword4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Adress mail</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="email"
                            id="inputPassword4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Pay</label>
                        <input type="text" class="form-control form-control-muted border-0"
                            wire:model="country" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Ville</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="city"
                            id="inputPassword4">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="address"
                            id="inputAddress">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Limit</label>
                        <input type="text" class="form-control form-control-muted border-0" wire:model="createLimit"
                            id="inputEmail4">
                    </div>
                </div>

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-success" wire:click="createItem"
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

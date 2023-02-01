<div class="mt-3">
    <a href="#" class="btn btn-sm btn-success mb-3" wire:click="showCreate">Nouvau</a>
    <div class="bg-lighter py-3 px-3 mt-3 mb-4 rounded">
        <h2 class="h3 mb-3">Administrateurs</h2>
        <div class="row">
            @foreach ($admins as $item)
                <div class="col-lg-4">
                    <div class="nfc-profile-item bg-secondary shadow-lg py-3 px-4 rounded">
                        <div class="media">
                            <div class="media-body d-flex align-content-center">
                                <a href="#" class="avatar rounded-circle mr-3">
                                    <img alt="Image placeholder" src="{{ asset('storage/img/nfc/profile/default.jpg') }}">
                                </a>
                                <div>
                                    <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                    <small class="name mb-0 text-sm text-muted d-block">{{ $item->email }}</small>
                                </div>
                                <div class="col-1 media align-items-center justify-content-center ml-4">
                                    {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                                    <a href="#"
                                        class="fa fa-pen btn btn-info btn-sm rounded-pill mx-auto shadow-none"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <h2 class="h3 mb-3">Agents</h2>
    <div class="row">
        @foreach ($agents as $item)
            <div class="col-lg-4">
                <div class="nfc-profile-item bg-secondary shadow-lg py-3 px-4 mb-3 rounded">
                    <div class="media">
                        <div class="media-body d-flex align-content-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="{{ asset('storage/img/nfc/profile/default.jpg') }}">
                            </a>
                            <div>
                                <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                <small class="name mb-0 text-sm text-muted d-block">{{ $item->email }}</small>
                            </div>
                            <div class="col-1 media align-items-center justify-content-center ml-4">
                                {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                                <a href="#"
                                    class="fa fa-pen btn btn-info btn-sm rounded-pill mx-auto shadow-none"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Create profile modal -->

    <x-jet-dialog-modal maxWidth="sm" wire:model="createModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    {{-- <input type="text" value="{{Auth::user()->name}}" wire:model="userId"> --}}
                    <label for="inputEmail4 text-sm">Nom</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="name"
                        id="inputEmail4">
                </div>
                <div class="form-group">
                    <label for="inputEmail4 text-sm">Adresse mail</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="email"
                        id="inputEmail4">
                </div>
                <div class="form-group">
                    <select class="custom-select form-control form-control-muted" wire:model="role">
                        <option selected>Role...</option>
                        <option value="Admin">Admin</option>
                        <option value="Agent">Agents</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputEmail4 text-sm">Mot de pass</label>
                    <input type="password" class="form-control form-control-muted border-0" wire:model="password"
                        id="inputEmail4">
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

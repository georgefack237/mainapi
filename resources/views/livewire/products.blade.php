<div>
    <div>
        <div class="header py-4 bg-white">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="align-items-center mt-4 py-3">
                        <div class="d-flex justify-content-between">
                            <h2 class="mb-4 h1">Produits</h2>
                            <div class="">
                                <a href="#" class="btn btn-sm btn-primary shadow-none"
                                    wire:click='newProductModal()'>
                                    <i class="fa fa-plus mr-2"></i>
                                    Ajouter produit
                                </a>
                                {{-- <button type="button" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isProspect()'>
                                Prospects
                            </button> --}}
                            </div>
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
                <div class="col-8 col-lg-3">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 font-weight-bold text-muted text-sm">Produit</span>
                        </div>
                    </div>
                </div>
                <div class="col-2 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">prix</span>
                </div>
                <div class="col-4 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Description</span>
                </div>
                <div class="col-4 col-lg-3 media d-none d-lg-inline">
                    <small class="mb-0 font-weight-bold text-muted text-sm">Quantité vendu</small>
                </div>
            </div>
        </div>
        @foreach ($products as $item)
            <div class="py-2 px-3 mb-2 rounded bg-body shadow-lg--hover">
                <div class="d-flex ali d-lg-block rounded">
                    <div class="row">
                        <div class="col-lg-3">
                            <a class="text-dark" href="#note-{{ $item->id }}" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="note-{{ $item->id }}">
                                <div class="media align-items-center">
                                    <div class="mr-3 my-auto">
                                        <span class="badge badge-lg badge-primary badge-circle">
                                            <i class="bi bi-basket3 text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                        {{-- <small class="name mb-0 text-xs text-muted d-block">{{ $item->description }}</small> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 align-items-center d-none d-lg-flex">
                            <span class="badge badge-primary">XAF {{ $item->price }}</span>
                        </div>
                        <div class="col-lg-4 align-items-center d-none d-lg-flex">
                            <small class="name mb-0 text-xs text-muted d-block">{{ $item->description }}</small>
                        </div>
                        <div class="col-3 d-none d-lg-block align-items-center justify-content-between">
                            <small class="mb-0 d-block font-weight-700 text-sm">{{ $item->sales->count() }} produits vendus</small>
                        </div>
                    </div>
                    <div class="ml-auto my-auto">
                        <div class="d-lg-none">
                            <span class="badge badge-info">XAF {{ $item->price }}</span>
                        </div>
                    </div>
                </div>

                {{-- Collapse content --}}
                <div class="collapse mt-1" id="note-{{ $item->id }}">
                    <div class="align-items-center d-lg-none text-sm ml-5">
                        <small class="mb-0 mr-2 font-weight-bold d-block">Initié le
                            {{-- {{ $item->created_at->format('D d M Y') }}</small> --}}
                    </div>
                    <div class="text-sm ml-5 d-block d-lg-none">
                        <small class="">Client:</small>
                        {{-- <small class="">{{ $item->contact->name }}</small> --}}
                    </div>
                    <div class="text-sm ml-5 d-block d-lg-none">
                        <small class="">Initiateur:</small>
                        {{-- <small class="">{{ $item->profile->firstname }} {{ $item->profile->lastname }}</small> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- New product modal -->

    <x-jet-dialog-modal maxWidth="sm" wire:model="productModal">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <form>
                <div class="form-group">
                    <label for="inputEmail4">Nom du produit</label>
                    <input type="text" class="form-control form-control-muted border-0" wire:model="name"
                        id="inputEmail4">
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Prix</label>
                    <input type="number" class="form-control form-control-muted border-0" wire:model="price"
                        id="inputEmail4">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Description</label>
                    <textarea class="form-control form-control-muted border-0" cols="10" rows="3" wire:model="description"
                        id="inputPassword4"></textarea>
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

                <div class="d-flex align-item-center justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-primary" wire:click="addProduct"
                            wire:loading.attr="disabled">Enregistrer</button>
                        <button type="button" class="btn btn-outline-primary" wire:click="$toggle('productModal')"
                            wire:loading.attr="disabled">Annuler</button>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="d-none bg-white">
        </x-slot>
    </x-jet-dialog-modal>
</div>

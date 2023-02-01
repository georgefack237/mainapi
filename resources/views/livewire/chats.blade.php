<div>
    <div class="row m-0">
        <div class="col-lg-3 border-right h-100vh overflow-hidden">
            <div class="">
                <div class="mt-5">
                    <h2 class="mb-4 h1 text-black-50">Chats</h2>
                    <div class="form-group mt-3 position-relative">
                        <input type="search" class="form-control form-control-muted border-0" placeholder="Recherche" wire:model='search'>
                        <i class="fa fa-search text-black text-opacity-25 position-absolute right-3 bottom-3"></i>
                    </div>
                    <div class="mt-3">
                        <div class="h-100vh scrollbar-inner">
                            <div class="mb-5">
                                @foreach ($profiles as $item)
                                    <div class="bg-body my-2 px-3 py-2 rounded"
                                        wire:click="showInfo({{ $item->id }})">
                                        <div class="media align-items-center">
                                            <a href="{{ route('nfc.show', $item->id) }}"
                                                class="avatar avatar-sm rounded-circle mr-3">
                                                <img alt="Image placeholder"
                                                    src="{{ asset('storage/img/nfc/profile/' . $item->image) }}">
                                            </a>
                                            <a href="#" class="media-body text-muted">
                                                <span class="name mb-0 text-sm font-weight-bold">{{ $item->firstname }}
                                                    {{ $item->lastname }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 bg-{{ $bg }}">
            @if ($writeMail == false)
                <div class="h-100vh d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h1 class="display-1 text-light animate__animated animate__bounce">
                            <i class="bi bi-chat-text"></i>
                        </h1>
                        {{-- <h2 class="display-3 text-muted">Aucune historique</h2> --}}
                        <p class="text-muted">Cliquer sur un chat pour afficher</p>
                    </div>
                </div>
            @else
                <div class="container-fluid" style="border-radius: 20px;">
                    <div class="pt-5 pb-4 border-bottom">
                        <h4 class="h3 text-muted">Envoyer à:</h4>
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <button type="button" id="this-month"
                                    class="btn btn-sm btn-info text-white shadow-none" wire:click='leads'>
                                    Leads
                                </button>
                                <button type="button" id="this-month"
                                    class="btn btn-sm btn-info text-white shadow-none" wire:click='prospects'>
                                    Prospects
                                </button>
                                <button type="button" id="this-month"
                                    class="btn btn-sm btn-info text-white shadow-none" wire:click='opportunities'>
                                    Opportunités
                                </button>
                                <button type="button" id="this-month"
                                    class="btn btn-sm btn-info text-white shadow-none" wire:click='clients'>
                                    Clients
                                </button>
                            </div>
                            <div class="ml-3">
                                <div class="d-flex align-items-center">
                                    <select
                                        class="custom-select form-control form-control-sm text-xs form-control-muted border-0"
                                        wire:model="productId">
                                        <option value="" selected>Tous les produits/services</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="ml-3">
                                        <span class="badge badge-primary text-lowercase">{{ $recipients->count() }}
                                            éléments</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <form class="mt-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-muted border-0"
                                        placeholder="Sujet du mail" wire:model="subject">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-muted border-0" id="editor1" rows="15" cols="80"
                                wire:model="content"></textarea>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary" wire:click="sendMail"
                                wire:loading.attr="disabled"><i class="fa fa-paper-plane mr-2"></i> Envoyer</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('newMail', function(e) {
            CKEDITOR.replace('editor1');
        })
    </script>
@endpush

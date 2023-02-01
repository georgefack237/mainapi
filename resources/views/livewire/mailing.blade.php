<div>
    <div class="">
        <div class="header py-4">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="align-items-center mt-4 py-3">
                        <div class="d-flex justify-content-between">
                            <h2 class="mb-4 h1">Newsletter</h2>
                            <div class="">
                                @if ($writeMail == true)
                                    <a href="#" class="btn btn-sm btn-outline-primary shadow-none"
                                        wire:click="$toggle('writeMail')">
                                        <i class="fa fa-xmark mr-2"></i>
                                        Fermer
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="loader p-1 bg-success" style="width: 75%"></div> --}}

        {{-- MAIN SCREEN - MAILS HISTORY --}}
        @if ($writeMail == false && $showMail == false)

            {{-- SHOW IF MAILS HISTORY --}}
            @if ($mails)
                <div class="container-fluid">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-group position-relative mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i
                                class="fas fa-search text-primary position-absolute" style="right: 25px;top:25%;"></i>
                        </div>
                        <div class="mr-3">
                            <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                wire:click='is_leads'>
                                Leads
                            </button>
                            <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                wire:click='is_prospects'>
                                Prospects
                            </button>
                            <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                wire:click='is_opportunities'>
                                Opportunités
                            </button>
                            <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                wire:click='is_clients'>
                                Clients
                            </button>
                        </div>
                    </div>
                    @foreach ($mails as $item)
                        <div class="py-2 px-3 mb-2 rounded bg-body shadow-lg--hover"
                            wire:click="getMail({{ $item->id }})">
                            <div class="d-flex ali d-lg-block rounded">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <a class="text-dark" href="#note-{{ $item->id }}" data-toggle="collapse"
                                            role="button" aria-expanded="false"
                                            aria-controls="note-{{ $item->id }}">
                                            <div class="media align-items-center">
                                                <div class="mr-3 my-auto">
                                                    <span class="badge badge-lg badge-secondary badge-circle">
                                                        <i class="bi bi-envelope-check text-info"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span
                                                        class="name mb-0 text-sm font-weight-bold">{{ $item->recipient }}</span>
                                                    {{-- <small class="name mb-0 text-xs text-muted d-block">{{ $item->description }}</small> --}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 align-items-center d-none d-lg-flex">
                                        <span class="text-muted text-sm">{{ $item->subject }}</span>
                                    </div>
                                    <div class="col-2 d-none d-lg-block align-items-center justify-content-between">
                                        <small class="mb-0 d-block font-weight-700 text-xs">Envoyé le:
                                            {{ $item->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                                <div class="ml-auto my-auto">
                                    <div class="d-lg-none">
                                        <span class="badge badge-info">XAF {{ $item->amount }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Collapse content --}}
                            {{-- <div class="collapse mt-1" id="note-{{ $item->id }}">
                                <div class="align-items-center d-lg-none text-sm ml-5">
                                    <small class="mb-0 mr-2 font-weight-bold d-block">Initié le
                                        {{ $item->created_at->format('D d M Y') }}</small>
                                </div>
                                <div class="text-sm ml-5 d-block d-lg-none">
                                    <small class="">Client:</small>
                                    <small class="">{{ $item->contact->name }}</small>
                                </div>
                                <div class="text-sm ml-5 d-block d-lg-none">
                                    <small class="">Initiateur:</small>
                                    <small class="">{{ $item->profile->firstname }}
                                        {{ $item->profile->lastname }}</small>
                                </div>
                            </div> --}}
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- SHOW IF NO MAILS HISTORY --}}
            @if ($mails->count() == 0)
                <div class="d-flex align-items-center justify-content-center py-7">
                    <div class="text-center">
                        <h1 class="display-1 text-light animate__animated animate__bounce">
                            <i class="bi bi-envelope-open"></i>
                        </h1>
                        <h2 class="display-3 text-muted">Aucune historique</h2>
                        <p class="text-muted">Vous avez pas encore envoyé de mail. Cliquez sur le botton de nouvelle
                            diffusion au coin à droit</p>
                    </div>
                </div>
            @endif
        @endif

        {{-- SHOW IF SHOW MAILS TRUE --}}
        @if ($showMail == true)
            <div class="h-100vh bg-white shadow overflow-hidden mt--4 animate__animated animate__fadeIn"
                style="border-radius: 20px;">
                <div class="container-fluid py-3">
                    <div class="row border-bottom pb-2">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill shadow-none"
                                wire:click="$toggle('showMail')">
                                <i class="fa fa-arrow-left mr-2"></i>Retour</a>
                            <span class="text-muted ml-3">Sujet: {{ $mail->subject }}</span>
                        </div>
                        <div class="col-md-6 text-lg-right">
                            <span class="text-xs font-weight-bold">Envoyer à: {{ $mail->recipient_email }},</span>
                            <span class="text-xs font-weight-bold ml-2">Le
                                {{ $mail->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2 class="mb-3 display-4">{{ $mail->title }}</h2>
                        <div class="content">
                            <p class="text-sm text-justify">{{ $mail->greeting . ' ' . $mail->recipient }}</p>
                            {!! $mail->content !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- SEND MAILS FORM --}}
        @if ($writeMail == true)
            <div class="bg-white shadow overflow-hidden mt--4 animate__animated animate__fadeIn"
                style="border-radius: 20px;">
                {{-- <div wire:loading>
                    <div class="progress rounded-0 mb-0">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div> --}}
                <div class="container-fluid">
                    <div class="pt-4 pb-4">
                        <h4 class="h3 text-muted">Envoyer à:</h4>
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                    wire:click='leads'>
                                    Leads
                                </button>
                                <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                    wire:click='prospects'>
                                    Prospects
                                </button>
                                <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                    wire:click='opportunities'>
                                    Opportunités
                                </button>
                                <button type="button" class="btn btn-sm btn-info text-white shadow-none"
                                    wire:click='clients'>
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
                </div>
                <div class="container-fluid">
                    <form class="mt-4">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-muted border-0"
                                        placeholder="Sujet du mail" wire:model="subject">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-muted border-0"
                                        placeholder="Titre (optionel)" wire:model="title">
                                </div>
                            </div>
                        </div>
                        <div class="custom-file mb-3">
                            <label class="" for="image">
                                <span type="button" class="btn btn-outline-primary rounded"><i class="bi bi-image mr-2"></i> Ajouter une cover</span>
                            </label>
                            <input type="file" wire:model='image' class="custom-file-input d-none" id="image" required>
                        </div>
                        <div wire:ignore class="form-group">
                            <textarea class="form-control form-control-muted border-0" name="content" id="content" rows="15" cols="80"
                                wire:model="content"></textarea>
                        </div>
                        <div class="mt-3 mb-5">
                            <button type="button" class="btn btn-primary" wire:click="sendMail"
                                wire:loading.attr="disabled">
                                <i wire:loading.remove wire:target='sendMail' class="fa fa-paper-plane mr-2"></i>
                                <i wire:loading wire:target='sendMail'
                                    class="fa fa-spinner mr-2 animate__animated animate__rotateIn animate__infinite"></i>
                                <span wire:loading.remove wire:target='sendMail'>Envoyer</span>
                                <span wire:loading wire:target='sendMail'>Envoi en cours...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    {{-- NEW DIFFUSION --}}
    @if ($writeMail == false)
        <a href="#" class="menu-btn text-white d-flex justify-content-center align-items-center"
            wire:click='newMail'>
            <i class="bi bi-envelope-plus-fill"></i>
        </a>
    @endif
</div>

@push('scripts')
    <script>
        window.addEventListener('newMail', function(e) {
            // CKEDITOR.replace('content');
            const editor = CKEDITOR.replace('content');
            editor.on('change', function(event){
                console.log(event.editor.getData())
                @this.set('content', event.editor.getData());
            })
        })

    </script>
@endpush


<div>
    <div class="header py-4 bg-white">
        <div class="container-fluid">
            <div class="header-body">
                <div class="align-items-center mt-4 py-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 h1">Ventes</h2>
                        {{-- <div class="d-lg-none">
                            <button type="button" id="this-month" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isClient()'>
                                Clients
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-outline-secondary text-white shadow-none" wire:click='isProspect()'>
                                Prospects
                            </button>
                        </div> --}}
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-4 form-group position-relative mb-0">
                            <input wire:model="search" class="form-control form-control-sm form-control-muted border-0"
                                placeholder="Recherche..." type="text"><i class="fas fa-search text-info position-absolute" style="right: 25px;top:25%;"></i>
                        </div>
                        <div class="col-lg-5 mt-3 mt-lg-0 d-flex d-lg-inline text-lg-right justify-content-between justify-content-lg-end" role="group" aria-label="Basic example">
                            <button type="button" id="this-day" class="btn btn-sm btn-secondary shadow-none" onclick="thisDay()" wire:click='thisDay()'>
                                Aujourd'hui
                            </button>
                            <button type="button" id="this-week" class="btn btn-sm btn-secondary shadow-none" onclick="thisWeek()" wire:click='thisWeek()'>
                                Cette semaine
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-secondary shadow-none" onclick="thisMonth()" wire:click='thisMonth()'>
                                Ce mois
                            </button>
                            <button type="button" id="this-month" class="btn btn-sm btn-secondary shadow-none" onclick="thisYear()" wire:click='thisYear()'>
                                Cette ann??e
                            </button>
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
                <div class="col-8 col-lg-4">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 font-weight-bold text-muted text-sm">Produit</span>
                        </div>
                    </div>
                </div>
                <div class="col-2 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Montant</span>
                </div>
                <div class="col-3 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Client</span>
                </div>
                <div class="col-4 col-lg-3 media d-none d-lg-inline">
                    <small class="mb-0 font-weight-bold text-muted text-sm">Initiateur</small>
                </div>
            </div>
        </div>
        @foreach ($sales as $item)
            <div class="py-2 px-3 mb-2 rounded bg-body shadow-lg--hover">
                <div class="d-flex ali d-lg-block rounded">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="text-dark" href="#note-{{ $item->id }}" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="note-{{ $item->id }}">
                                <div class="media align-items-center">
                                    <div class="mr-3 my-auto">
                                        @if ($item->is_client == false)
                                            <span class="badge badge-lg badge-secondary badge-circle">
                                                <i class="bi bi-cart-plus text-info"></i>
                                            </span>
                                        @else
                                            <span class="btn btn-sm badge-info rounded-circle">
                                                <i class="fa fa-check text-info"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm font-weight-bold">{{ $item->product->name }}</span>
                                        <small class="name mb-0 text-xs text-muted d-block">{{ $item->description }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 align-items-center d-none d-lg-flex">
                            <span class="badge badge-info">XAF {{ $item->amount }}</span>
                        </div>
                        <div class="col-lg-3 align-items-center d-none d-lg-flex">
                            <small class="mb-0 d-block font-weight-500 text-sm">{{ $item->contact->name }}</small>
                            {{-- <small class="mb-0 d-block font-weight-500 text-sm">{{ $item->created_at->format('D d M Y') }}</small> --}}
                        </div>
                        <div class="col-3 d-none d-lg-block align-items-center justify-content-between">
                            <small class="mb-0">{{ $item->profile->firstname }} {{ $item->profile->lastname }}</small>
                            <small class="mb-0 d-block font-weight-700 text-xs">Initi?? le: {{ $item->created_at->format('D d M Y') }}</small>
                        </div>
                    </div>
                    <div class="ml-auto my-auto">
                        <div class="d-lg-none">
                            <span class="badge badge-info">XAF {{ $item->amount }}</span>
                        </div>
                    </div>
                </div>

                {{-- Collapse content --}}
                <div class="collapse mt-1" id="note-{{ $item->id }}">
                    <div class="align-items-center d-lg-none text-sm ml-5">
                        <small class="mb-0 mr-2 font-weight-bold d-block">Initi?? le {{ $item->created_at->format('D d M Y') }}</small>
                    </div>
                    <div class="text-sm ml-5 d-block d-lg-none">
                        <small class="">Client:</small>
                        <small class="">{{ $item->contact->name }}</small>
                    </div>
                    <div class="text-sm ml-5 d-block d-lg-none">
                        <small class="">Initiateur:</small>
                        <small class="">{{ $item->profile->firstname }} {{ $item->profile->lastname }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    @push('scripts')
        <script>
            function thisDay() {
                document.getElementById("this-week").classList.remove("active");
                document.getElementById("this-month").classList.remove("active");
                document.getElementById("this-day").classList.add("active");
            }

            function thisWeek() {
                document.getElementById("this-month").classList.remove("active");
                document.getElementById("this-day").classList.remove("active");
                document.getElementById("this-week").classList.add("active");
            }

            function thisMonth() {
                document.getElementById("this-week").classList.remove("active");
                document.getElementById("this-day").classList.remove("active");
                document.getElementById("this-month").classList.add("active");
            }
        </script>
    @endpush
</div>

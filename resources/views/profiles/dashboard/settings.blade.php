<div class="mx-3" style="border-radius: 20px;">
    <div class="container-fluid mt-3">
        <div class="d-flex align-items-center mt-4 py-3">
            <div class="">
                <h4 class="h1 d-inline-block mt-2 mb-0">Contacts</h4>
            </div>
            <div class="ml-auto d-none d-lg-inline">
                <div class="form-group position-relative d-inline-block mr-4 mb-0" style="width: 200px;">
                    <input wire:model="search" class="form-control form-control-sm form-control-muted bg-secondary"
                        placeholder="Recherche..." type="text"><i class="fas fa-search text-muted position-absolute" style="right: 10px;top:25%;"></i>
                </div>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="this-day" class="btn btn-sm btn-outline-primary shadow-none" onclick="thisDay()" wire:click='thisDay()'>
                        Aujourd'hui
                    </button>
                    <button type="button" id="this-week" class="btn btn-sm btn-outline-primary shadow-none" onclick="thisWeek()" wire:click='thisWeek()'>
                        Cette semaine
                    </button>
                    <button type="button" id="this-month" class="btn btn-sm btn-outline-primary shadow-none" onclick="thisMonth()" wire:click='thisMonth()'>
                        Ce mois
                    </button>
                    <button type="button" id="this-month" class="btn btn-sm btn-outline-primary shadow-none" onclick="thisYear()" wire:click='thisYear()'>
                        Cette année
                    </button>
                </div>
                <a href="#" class="btn btn-sm btn-success shadow-none ml-4" onclick="event.preventDefault();
                                                         document.getElementById('save-form').submit();"><i class="fa fa-arrow-down mr-2"></i>Enregistrer tout</a>
                {{-- <a href="#" class="btn btn-sm btn-success shadow-none ml-4" wire:click='saveConatctBatch()'><i class="fa fa-arrow-down mr-2"></i>Enregistrer tout</a> --}}
            </div>
            <form id="save-form" method="POST" action="{{ route('batchSave') }}">
                @csrf
                <input type="hidden" name="date" value="{{$whereDate}}">
            </form>
        </div>
        <div class="nfc-profile-item py-1 px-3 my-2 rounded" style="background:#eef5fd;">
            <div class="row">
                <div class="col-8 col-lg-4">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 font-weight-bold text-muted text-sm">Nom</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 media align-items-center">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Numéro</span>
                </div>
                <div class="col-4 col-lg-3 media align-items-center d-none d-lg-inline">
                    <small class="mb-0 font-weight-bold text-muted text-sm">Agent</small>
                </div>
                <div class="col-1 media align-items-center justify-content-center border-left d-none d-lg-block">
                    <span class="mb-0 font-weight-bold text-muted text-sm">Actions</span>
                </div>
            </div>
        </div>
        @foreach ($contacts as $item)
            <div class="nfc-profile-item py-2 px-3 rounded" @if($loop->even) style="background:#eef5fd;" @endif>
                <div class="row">
                    <div class="col-8 col-lg-4">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                <small class="name mb-0 text-sm text-muted d-block">{{ $item->title }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-3 align-items-center">
                        <small class="mb-0 d-block" id="{{ $item->phone }}">{{ $item->phone }}</small>
                        <span class="btn btn-sm badge-success d-block d-lg-none"><a href="{{ route('phoneSave', $item->id) }}" class="fa fa-arrow-down text-success mr-2"></a> Enregistrer</span>
                    </div>
                    <div class="col-4 media align-items-center d-none d-lg-inline">
                        <small class="mb-0">{{ $item->nfcprofile->firstname }} {{ $item->nfcprofile->lastname }}</small>
                    </div>
                    <div class="col-1 media align-items-center justify-content-center border-left">
                        {{-- <a href="#" wire:click="showDeleteNfc" class="fa fa-paper-plane text-blue mx-auto"></a> --}}
                        <a href="{{ route('phoneSave', $item->id) }}" class="fa fa-arrow-down text-success mx-auto  d-none d-lg-block"></a>
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

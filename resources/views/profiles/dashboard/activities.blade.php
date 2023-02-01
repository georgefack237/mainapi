<div>
    <div class="d-flex mb-5">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-9">
                    <div class="align-items-center mt-4 py-3">
                        <div class="d-flex justify-content-between">
                            <h1 class="mb-4">Activités</h1>
                        </div>
                        <div class="d-lg-flex justify-content-between mt-4">
                            <div class="form-group position-relative mb-0">
                                <input wire:model="search"
                                    class="form-control form-control-sm form-control-muted bg-lighter"
                                    placeholder="Recherche..." type="text"><i
                                    class="fas fa-search text-muted position-absolute" style="right: 10px;top:25%;"></i>
                            </div>
                            <div class="mt-3 mt-lg-0 d-flex justify-content-between" role="group"
                                aria-label="Basic example">
                                <button type="button" id="this-day"
                                    class="btn btn-sm btn-secondary badge-info shadow-none" onclick="thisDay()"
                                    wire:click='thisDay()'>
                                    Aujourd'hui
                                </button>
                                <button type="button" id="this-week"
                                    class="btn btn-sm btn-secondary badge-info shadow-none" onclick="thisWeek()"
                                    wire:click='thisWeek()'>
                                    Cette semaine
                                </button>
                                <button type="button" id="this-month"
                                    class="btn btn-sm btn-secondary badge-info shadow-none" onclick="thisMonth()"
                                    wire:click='thisMonth()'>
                                    Ce mois
                                </button>
                                <button type="button" id="this-month"
                                    class="btn btn-sm btn-secondary badge-info shadow-none" onclick="thisYear()"
                                    wire:click='thisYear()'>
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
                    </div>

                    <div class="nfc-profile-item py-1 px-3 my-2 border-bottom border-top d-none d-lg-block">
                        <div class="row">
                            <div class="col-2">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 font-weight-bold text-muted text-sm">Date</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 media align-items-center border-left">
                                <span class="mb-0 font-weight-bold text-muted text-sm">Localisation</span>
                            </div>
                            <div class="col-4 media align-items-center border-left">
                                <small class="mb-0 font-weight-bold text-muted text-sm">Platform</small>
                            </div>
                        </div>
                    </div>
                    @if ($activities)
                        @foreach ($activities as $activity)
                            <div class="nfc-profile-item py-2 px-3 my-2 border-bottom">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span
                                                    class="name mb-0 text-sm font-weight-bold">{{ $activity->created_at->format('D d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 media align-items-center">
                                        <small class="mb-0">{{ $activity->country_name }},
                                            {{ $activity->city_name }}</small>
                                    </div>
                                    <div class="col-lg-6 media align-items-center">
                                        <small class="mb-0 nfc-link-text-2">{{ $activity->user_agent }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center">
                            <h1 class="muted">Aucune activité n'a été enregistré pour le moment</h1>
                        </div>
                    @endif
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="border-left container shadow-none px-4 mt-5" style="height:100%;">
                        <h4 class="h2">Archives</h4>
                        @if ($archives)
                            @foreach ($archives as $dates => $months)
                                <h4 class="shadow-none" wire:click='findArchive()'>En {{ $dates }}</h4>
                                <div>
                                    @foreach ($months as $item)
                                        <ul class="list-unstyled">
                                            <li class="list-item">
                                                <a href="#" class="btn btn-sm list-group-item-success">
                                                    <i class="fa-solid fa-minus mr-2 text-success"></i>
                                                    {{ $item->month }}
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

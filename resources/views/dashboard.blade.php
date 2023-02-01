<x-app-layout>
    <div class="header bg-lighter pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h1 d-inline-block mb-0 mt-4">Dashboard</h6>
                    </div>
                    {{-- <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral">New</a>
                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                    </div> --}}
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Fournisseur</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $provider->name }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div
                                            class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fa fa-store"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Package</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $package->name }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fa fa-sharp fa-box-open"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Valide Jusqu'au</h5>
                                        <span
                                            class="h2 font-weight-bold mb-0">{{ Auth::user()->created_at->addYear()->format('d M Y') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Max. Profiles</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ Auth::user()->profile_limit }}</span>
                                        {{-- <span class="text-sm text-muted mb-0">({{ $profiles->count() }} profiles utilisés)</span> --}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-8">
                <div class="card bg-default">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Courbe D'Activité</h6>
                                <h5 class="h3 text-white mb-0">Contacts Enregistrés</h5>
                            </div>
                            {{-- <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart"
                                        data-target="#chart-sales-dark"
                                        data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'
                                        data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark"
                                        data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}'
                                        data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            {!! $aChart->container() !!}
                            {!! $aChart->script() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Apport</h6>
                                <h5 class="h3 mb-0">Par Agent</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($profiles as $item)
                            @if ($item->master == false)
                                <div class="d-flex align-items-center rounded-pill px-3 py-3 mb-3 bg-lighter">
                                    <div class="media align-items-center">
                                        <a href="{{ route('nfc.show', $item->id) }}" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder"
                                                src="{{ asset('storage/img/nfc/profile/' . $item->image) }}">
                                        </a>
                                        <a href="{{ route('nfc.show', $item->id) }}" class="media-body text-default">
                                            <span class="name mb-0 text-sm font-weight-bold">{{ $item->firstname }}
                                                {{ $item->lastname }}</span>
                                            <small
                                                class="name mb-0 text-xs text-muted d-block">{{ $item->master == true ? 'Directeur Marketinf' : 'Agent Commercial' }}</small>
                                        </a>

                                    </div>
                                    <div class="ml-auto">
                                        <span class="btn btn-primary rounded-circle h-16">{{ $item->pageviews->count() }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h4 class="h3 text-muted mb-0">Activitées Récentes</h4>
                            </div>
                            <div class="col text-right">
                                <a href="/client/activites" class="btn btn-sm btn-info shadow-none">Voir tout</a>
                            </div>
                        </div>
                    </div>
                    @if ($activities)
                        @foreach ($activities as $activity)
                            <div class="nfc-profile-item py-2 px-3 my-2 border-bottom shadow--hover">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span
                                                    class="name mb-0 text-sm font-weight-bold">{{ $activity->created_at->format('D d M') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 media align-items-center">
                                        <small class="mb-0">{{ $activity->country_name }},
                                            {{ $activity->city_name }}</small>
                                    </div>
                                    <div class="col-lg-4 media align-items-center">
                                        <small class="mb-0 nfc-link-text-2">{{ $activity->user_agent }}</small>
                                    </div>
                                    <div class="col-lg-4 media align-items-center">
                                        <small class="mb-0">{{ $activity->nfcprofile->firstname }}
                                            {{ $activity->nfcprofile->lastname }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center">
                            <h1 class="muted">Aucune recente activité</h1>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h4 class="h3 text-muted mb-0">Contacts Récents</h4>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary shadow-none">Voir tout</a>
                            </div>
                        </div>
                    </div>
                    @foreach ($contacts as $item)
                        <div class="nfc-profile-item py-2 px-3 mx-2 d-flex rounded"
                            @if ($loop->even) style="background:#eef5fd;" @endif>
                            <div class="row">
                                <div class="col-12">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span
                                                class="name mb-0 text-sm font-weight-bold">{{ $item->name }}</span>
                                            <small
                                                class="name mb-0 text-xs text-muted d-block">{{ $item->title }}</small>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 align-items-center">
                                    <small class="mb-0 d-block font-weight-700"
                                        id="{{ $item->phone }}">{{ $item->phone }}</small>
                                </div> --}}
                            </div>
                            <div class="ml-auto my-auto d-inline">
                                <span class="btn btn-sm badge-success rounded-circle"><a
                                        href="{{ route('phoneSave', $item->id) }}"
                                        class="fa fa-arrow-down text-success"></a></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>

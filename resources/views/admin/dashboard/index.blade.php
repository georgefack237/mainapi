<x-admin-layout>

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
                    @foreach ($packages as $item)
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title h3 text-uppercase text-muted mb-0">{{ $item->name }}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $item->users->count() }}</span>
                                        <span class="text-muted text-sm ml-2">Clients Abonnés</span>
                                    </div>
                                    <div class="col-auto">
                                        <div
                                            class="icon icon-shape {{ $item->color }} text-white rounded-circle shadow">
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
                    @endforeach

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats bg-gradient-success">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title h3 text-uppercase text-white mb-0">Total</h5>
                                        <span class="h2 text-white font-weight-bold mb-0">{{ $clients->count() }}</span>
                                        <span class="text-white-50 text-sm ml-2">Clients En tout</span>
                                        {{-- <span class="text-sm text-muted mb-0">({{ $profiles->count() }} profiles utilisés)</span> --}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
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

</x-admin-layout>

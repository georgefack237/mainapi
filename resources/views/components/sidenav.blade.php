<div class="navbar-inner">
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">

        <ul class="navbar-nav">
            @auth
                <div class="card mx-3 bg-transparent shadow-none">
                    <li class="nav-item dropdown mt-4">
                        <a class="pr-0" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex align-items-center text-center border p-2 bg-lighter"
                                style="border-radius: 20px;">
                                <span class="avatar avatar-md rounded-circle">
                                    <img
                                        src="{{ asset('storage/img/nfc/profile/' . Auth::user()->profile_photo_path) }}">
                                </span>
                                <div class="media-body d-none d-lg-block">
                                    <span class="mb-0 text-dark font-weight-bold" style="font-size: 12px;">
                                        {{ Auth::user()->name }}
                                    </span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">
                                    {{ __('Manage Account') }}
                                </h6>
                            </div>

                            <a href="{{ route('profile.show') }}" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>
                                    {{ __('Profile') }}
                                </span>
                            </a>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a href="{{ route('api-tokens.index') }}" class="dropdown-item">
                                    <span>
                                        {{ __('API Tokens') }}
                                    </span>
                                </a>
                            @endif

                            <div class="dropdown-divider"></div>

                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </div>
                    </li>
                </div>
            @endauth
        </ul>
        <!-- Nav items -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ 'dashboard' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/dashboard') }}">
                    <i class="ni ni-tv-2 text-success"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ 'client/nfcprofiles' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/nfcprofiles') }}">
                    <i class="bi bi-people-fill text-success"></i>
                    <span class="nav-link-text">Profiles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('client.contacts') ? 'active' : '' }}"
                    href="{{ url('/client/contacts') }}">
                    <i class="bi bi-person-badge text-success"></i>
                    <span class="nav-link-text">Contacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('client.appointments') ? 'active' : '' }}"
                    href="{{ url('/client/appointments') }}">
                    <i class="bi bi-clipboard-data text-success"></i>
                    <span class="nav-link-text">Agenda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('client.alerts') ? 'active' : '' }}"
                    href="{{ url('/client/alerts') }}">
                    <i class="bi bi-bell text-success"></i>
                    <span class="nav-link-text">Alertes</span>
                    @if ($alertsCount)
                        <span class="badge badge-pill bg-danger ml-auto">{{$alertsCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ 'client/chats' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/chats') }}">
                    <i class="bi bi-chat-text text-success"></i>
                    <span class="nav-link-text">Chats</span>
                    <span class="badge badge-pill bg-warning ml-auto">43</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ 'client/mailing' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/mailing') }}">
                    <i class="bi bi-envelope text-success"></i>
                    <span class="nav-link-text">Newsletter</span>
                    {{-- <span class="badge badge-pill bg-warning ml-auto">43</span> --}}
                </a>
            </li>
        </ul>

        {{-- Nav Group --}}
        <ul class="navbar-nav mt-4">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('client.prospection.*') ? 'active' : '' }}"
                    href="#conversion" data-toggle="collapse"
                    role="button" aria-expanded="false" aria-controls="conversion">
                    <i class="bi bi-arrow-left-right"></i>
                    <span class="nav-link-text">Cycle de vente (KPI)</span>
                </a>
            </li>
            {{-- Collapse content --}}
            <div class="collapse mt-1 mb-2 px-5 {{ request()->routeIs('client.prospection.*') ? 'show' : '' }}" id="conversion">
                <ul class="navbar-nav bg-white rounded py-2">
                    {{-- <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/appointments' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/appointments') }}">
                            <i class="bi bi-calendar-date"></i>
                            <span class="nav-link-text">Rendez-vous</span>
                        </a>
                    </li> --}}
                    <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/prospection/leads' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/prospection/leads') }}">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="nav-link-text">Leads</span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/prospection/prospects' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/prospection/prospects') }}">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="nav-link-text">Prospects</span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/prospection/opportunities' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/prospection/opportunities') }}">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="nav-link-text">Opportunités</span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/prospection/clients' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/prospection/clients') }}">
                            <i class="bi bi-bag-check-fill"></i>
                            <span class="nav-link-text">Clients</span>
                        </a>
                    </li>
                    {{-- <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/conversion' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/conversion') }}">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="nav-link-text">Propects</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </ul>

        {{-- Nav Group --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('client.market.*') ? 'active' : '' }}"
                    href="#market" data-toggle="collapse"
                    role="button" aria-expanded="false" aria-controls="market">
                    <i class="bi bi-bank"></i>
                    <span class="nav-link-text">Chiffre d'affaire</span>
                </a>
            </li>
            {{-- Collapse content --}}
            <div class="collapse mt-1 mb-2 px-5 {{ request()->routeIs('client.market.*') ? 'show' : '' }}" id="market">
                <ul class="navbar-nav bg-white rounded py-2">
                    <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/products' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/products') }}">
                            <i class="bi bi-basket3"></i>
                            <span class="nav-link-text">Produits</span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a class="nav-link text-xs rounded-lg {{ 'client/sales' == request()->path() ? 'text-primary badge-primary' : 'text-muted' }}"
                            href="{{ url('/client/sales') }}">
                            <i class="bi bi-cart-check"></i>
                            <span class="nav-link-text">Ventes</span>
                        </a>
                    </li>
                </ul>
            </div>
        </ul>



        {{-- Nav Group --}}
        {{-- <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Taux de conversion</span>
        </h6>
        <ul class="navbar-nav mb-3">
            <li class="nav-item">
                <a class="nav-link {{ 'client/appointments' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/appointments') }}">
                    <i class="bi bi-calendar-date text-success"></i>
                    <span class="nav-link-text">Rendez-vous</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ 'client/conversion' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/conversion') }}">
                    <i class="bi bi-person-lines-fill text-success"></i>
                    <span class="nav-link-text">Conversion</span>
                </a>
            </li>
        </ul> --}}

        {{-- Nav Group --}}
        {{-- <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Chiffre d'affaire</span>
        </h6> --}}
        {{-- <ul class="navbar-nav mb-3">
            <li class="nav-item">
                <a class="nav-link {{ 'client/products' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/products') }}">
                    <i class="bi bi-basket3 text-success"></i>
                    <span class="nav-link-text">Produits</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ 'client/sales' == request()->path() ? 'active' : '' }}"
                    href="{{ url('/client/sales') }}">
                    <i class="bi bi-cart-check text-success"></i>
                    <span class="nav-link-text">Ventes</span>
                </a>
            </li>
        </ul> --}}

    </div>
</div>

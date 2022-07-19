<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <div class="py-0 text-center">
            <img src="{{ asset('argon') }}/img/brand/logo.png" width="140px" height="110px" alt="..." class="d-flex m-auto ">
        </div>
        <!-- User -->
        {{-- <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul> --}}
        <!-- Collapse -->
        <div class="collapse navbar-collapse pt-0 pb-0" id="sidenav-collapse-main">
            <!-- Collapse header -->
            {{-- <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div> --}}
            <!-- Form -->
            {{-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form> --}}
            <!-- Navigation -->
            <ul class="navbar-nav pt-0 pb-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                        <i class="ni ni-tv-2" style="color: #2a3880;"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('quotation') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                        <i class="ni ni-single-copy-04" style="color: #2a3880;"></i> {{ __('Quotation') }}
                    </a>
                </li>
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 4 )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('invoice') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                <i class="fas fa-file-invoice" style="color: #2a3880;"></i> {{ __('Invoices') }}
                            </a>
                        </li>
                    @endif
            </ul>
            <ul class="navbar-nav">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="nav-item">
                        <a class="nav-link active" style="text-decoration: none; color: #2a3880; font-weight: bold;" href="#navbar-purchases" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                            <i class="ni ni-money-coins" style="color: #2a3880;"></i>
                            <span class="nav-link-text" style="color: #2a3880;">{{ __('Purchases') }}</span>
                        </a>
        
                        <div class="collapse" id="navbar-purchases">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/po_in" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-left" style="color: #2a3880;"></i>
                                        {{ __('Purchase In') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/po-out" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Purchase Out') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->role_id == 1) 
                    <li class="nav-item">
                        <a class="nav-link" href="/user" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                            <i class="ni ni-badge" style="color: #2a3880;" ></i>
                            {{ __('User Management') }}
                        </a>
                    </li>
                @endif
            </ul>
            {{-- <hr class="my-3">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-circle-08" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('User Settings') }}</span>
                    </a>
    
                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    <i class="ni ni-single-02 text-info"></i>
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('profile.edit-password') }}">
                                    <i class="fa fa-lock" style="color: black"></i>
                                    {{ __('Change Password') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul> --}}
           
            <!-- Divider -->
            {{-- <hr class="my-3"> --}}
            <!-- Heading -->
            {{-- <h6 class="navbar-heading text-muted">CMS Management</h6> --}}
            <!-- Navigation -->
            {{-- <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-cms" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-cms">
                        <i class="fa fa-th" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('CMS Management') }}</span>
                    </a>
    
                    <div class="collapse show" id="navbar-cms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/roles/index">
                                    <i class="ni ni-badge text-warning" ></i>
                                    {{ __('Role Management') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('user.index') }}">
                                    <i class="fas fa-users "></i>
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>

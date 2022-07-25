<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: #2a3880;">x</span>
        </button> --}}
        <!-- Brand -->
        <div class="py-0 text-center">
            <img src="{{ asset('argon') }}/img/brand/logo.png" width="140px" height="110px" alt="..." class="d-flex m-auto ">
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse pt-0 pb-0" id="sidenav-collapse-main"  style="text-decoration: none; color: #2a3880; font-weight: bold;">
            <ul class="navbar-nav pt-0 pb-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                        <i class="ni ni-tv-2" style="color: #2a3880;"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-quotations" style="text-decoration: none; color: #2a3880; font-weight: bold;" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-quotations">
                            <i class="fas fa-file-invoice" style="color: #2a3880;"></i> {{ __('Quotation') }}
                        </a>
                        <div class="collapse" id="navbar-quotations">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('quotation') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Quotation') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('old-quotation') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Old Quotation') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </li>
            </ul>
            <ul class="navbar-nav">            
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 4 )
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-invoices" style="text-decoration: none; color: #2a3880; font-weight: bold;" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-invoices">
                            <i class="fas fa-file-invoice" style="color: #2a3880;"></i> {{ __('Invoices') }}
                        </a>
                        <div class="collapse" id="navbar-invoices">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('invoice-po') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('PO In Invoice') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('invoice') }}" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Quotation Invoice') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="nav-item">
                        <a class="nav-link" style="text-decoration: none; color: #2a3880; font-weight: bold;" href="#navbar-purchases" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-purchases">
                            <i class="ni ni-money-coins" style="color: #2a3880;"></i>
                            <span class="nav-link-text" style="color: #2a3880;">{{ __('Purchases') }}</span>
                        </a>
        
                        <div class="collapse" id="navbar-purchases">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/po_in" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Purchase In') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/po-out" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Purchase Out') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/old/po-out" style="text-decoration: none; color: #2a3880; font-weight: bold;">
                                        <i class="ni ni-bold-right" style="color: #2a3880;"></i>
                                        {{ __('Old Purchase Out') }}
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
        </div>
    </div>
</nav>

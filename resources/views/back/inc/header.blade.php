<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">

                <a href="{{ route('admin.dashboard') }}" class="logo collapsedlogo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/favicon.ico') }}" alt="" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/sms.png') }}" alt="" height="30">
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo collapsedlogo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/favicon.ico') }}" alt="" height="58">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/sms.png') }}" alt="" height="50">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>




        </div>
        @include('back.pages.partials.switch')
        <div class="dropdown d-inline-block">
            @php
                $totalBalance = App\TotalBalance::where('user_id', auth()->id())->first();
            @endphp
            Account Balance: <a href="{{ route('admin.account.detail') }}"><span style="color:#50a5f1;font-weight:bold">
                    ${{ number_format(@$totalBalance->total_amount, 2) }}</span></a>
            <button type="button" class="header-item waves-effect" id="page-header-user-dropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ asset('back/assets/images/user.png') }}"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ml-1">{{ Auth::user()->name }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <a href="/admin/single-sms" class="btn" id="open-modal-btnn">
                <span style="font-size:20px;color:#50a5f1;margin-left:20px"><i class="fas fa-sms fa-lg"></i></span>

            </a>
            <button class="btn" id="open-modal-btn">
                <span style="font-size:20px;color:#50a5f1;"><i class="fas fa-phone"></i></span>

            </button>
           
            <div class="dropdown-menu dropdown-menu-right">

                <a class="dropdown-item" href="{{ route('admin.profile.show') }}"><i
                        class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                <!-- item<a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    -->
                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
           
        </div>



    </div>

    </div>

</header>

<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
    <div class="kt-header__top">
        <div class="kt-container">

            <!-- begin:: Brand -->
            <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                <div class="kt-header__brand-logo">
                    <a href="{{ route('home') }}">
                        <img alt="Logo" src="{{ url('storage/'.$CONF->logo) }}" />
                    </a>
                </div>
            </div>

            <!-- end:: Brand -->

            <!-- begin:: Header Topbar -->
            <div class="kt-header__topbar">

                <!--begin: Notifications -->
                <div class="kt-header__topbar-item">
                    <div class="kt-header__topbar-wrapper" data-offset="10px,10px">
                        <span class="kt-header__topbar-icon kt-header__topbar-icon-custom kt-header__topbar-icon--warning"> <i class="fa fa-phone"></i> &nbsp;&nbsp; {{ $CONF->phone }}</span><br>
                    </div>
                </div>

                <!--end: Notifications -->

                <!--begin: Notifications -->
                <div class="kt-header__topbar-item">
                    <div class="kt-header__topbar-wrapper" data-offset="10px,10px">
                        <span class="kt-header__topbar-icon kt-header__topbar-icon-custom kt-header__topbar-icon--info"> <i class="fa fa-envelope"></i> &nbsp;&nbsp; {{ $CONF->email }}</span><br>
                    </div>
                </div>

                <!--end: Notifications -->

                @if(!empty(\Auth::user()->id))
                    <!--begin: Notifications -->
                    <div class="kt-header__topbar-item dropdown">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
                                        <span class="kt-header__topbar-icon kt-header__topbar-icon--success">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect id="bound" x="0" y="0" width="24" height="24" />
                                                    <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" id="Combined-Shape" fill="#000000" />
                                                    <circle id="Oval" fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                                </g>
                                            </svg>

                                            <!--<i class="flaticon2-bell-alarm-symbol"></i>-->
                                        </span>
                            <span class="kt-hidden kt-badge kt-badge--danger"></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                            <form>

                                <!--begin: Head -->
                                <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
                                    <h3 class="kt-head__title">
                                        Notifikasi
                                        &nbsp;
                                        <span class="btn btn-label-primary btn-sm btn-bold btn-font-md"> {{ \Auth::user()->unreadNotifications->count() ? \Auth::user()->unreadNotifications->count().' Pesan' : '' }}</span>
                                    </h3>
                                </div>

                                <!--end: Head -->
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                            @foreach(\Auth::user()->latestNotifications as $notification)
                                            <a href="javascript:;" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-image-file kt-font-success"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        {{ $notification->subject }}
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        {{ \Carbon\Carbon::parse($notification->created_at)->format('Y/m/d H:i') }}
                                                    </div>
                                                </div>
                                            </a>
                                            @endforeach
                                            {{--<a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-box-1 kt-font-brand"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New customer is registered
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        3 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-chart2 kt-font-danger"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        Application has been approved
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        3 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-image-file kt-font-warning"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New file has been uploaded
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        5 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-bar-chart kt-font-info"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New user feedback received
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        8 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-pie-chart-2 kt-font-success"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        System reboot has been successfully completed
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        12 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-favourite kt-font-danger"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New order has been placed
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        15 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item kt-notification__item--read">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-safe kt-font-primary"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        Company meeting canceled
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        19 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-psd kt-font-success"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New report has been received
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        23 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon-download-1 kt-font-danger"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        Finance report has been generated
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        25 hrs ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon-security kt-font-warning"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New customer comment recieved
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        2 days ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-pie-chart kt-font-success"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        New customer is registered
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        3 days ago
                                                    </div>
                                                </div>
                                            </a>--}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--end: Notifications -->

                    <!--begin: User bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
                            <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                            <span class="kt-hidden kt-header__topbar-username">Nick</span>
                            <img class="kt-hidden-" alt="Pic" src="{{ url('storage/'.\Auth::user()->photo) }}" />
                            <span class="kt-header__topbar-icon kt-header__topbar-icon--brand kt-hidden"><b>S</b></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden-" alt="Pic" src="{{ url('storage/'.\Auth::user()->photo) }}" />

                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                </div>
                                <div class="kt-user-card__name">
                                    Hallo, {{ \Auth::user()->name }}
                                </div>
                            </div>

                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a href="javascript:;" data-toggle="modal" data-target="#modal_profile" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Akun
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Ubah data akun
                                        </div>
                                    </div>
                                </a>
                                <div class="kt-notification__custom">
                                    <a href="{{ route('logout') }}" class="btn btn-label-brand btn-sm btn-bold">Keluar</a>
                                </div>
                            </div>

                            <!--end: Navigation -->
                        </div>
                    </div>

                    <!--end: User bar -->
                @else
                    <!--begin: Login -->
                    <a href="{{ route('login') }}">
                        <div class="kt-header__topbar-item">
                            <div class="kt-header__topbar-wrapper" data-offset="10px,10px">
                                <span class="kt-header__topbar-icon kt-header__topbar-icon-custom kt-header__topbar-icon--success"> <i class="fa fa-lock"></i> &nbsp;&nbsp; Masuk</span><br>
                            </div>
                        </div>
                    </a>
                    <!--end: Login -->
                @endif
            </div>

            <!-- end:: Header Topbar -->
        </div>
    </div>
    <div class="kt-header__bottom">
        <div class="kt-container">

            <!-- begin: Header Menu -->
            <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
            <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                    <ul class="kt-menu__nav ">
                        <li class="kt-menu__item  {{ $sidebar == 'reservation' ? 'kt-menu__item--open kt-menu__item--here' : '' }} kt-menu__item--submenu kt-menu__item--rel">
                            <a href="{{ route('home') }}" class="kt-menu__link"><span class="kt-menu__link-text">Reservasi</span></a>
                        </li>
                        @if(!empty(\Auth::user()->id))
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel">
                            <a href="{{ route('logout') }}" class="kt-menu__link"><span class="kt-menu__link-text">Keluar</span></a>
                        </li>
                        @else
                        <li class="kt-menu__item {{ $sidebar == 'pic-register' ? 'kt-menu__item--open kt-menu__item--here' : '' }} kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="{{ route('register') }}" class="kt-menu__link"><span class="kt-menu__link-text">Pendaftaran</span></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- end: Header Menu -->
        </div>
    </div>
</div>

<!-- end:: Header -->

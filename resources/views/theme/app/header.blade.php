<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo mx-5">
                    <a href="{{route('web.dashboard')}}" class="logo">
                        <span>
                            <img src="{{ asset('images/img/logo_piztob.jpeg') }}" alt="" class="rounded-circle bg-roun" height="50" width="80">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
            @guest
            <div class="d-flex align-items-center">
                <div class="navbar-brand-box ml-auto">                    
                    <a href="{{ route('auth.index') }}" class="btn btn-ghost-warning rounded-circle">
                        <span class="d-flex align-items-center">
                            <span class="text-start ms-xl-2">
                                <i class="bx bx-user text-white fs-22 align-middle me-1"></i>
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-white text-capitalize">Login</span>
                            </span>
                        </span>
                    </a>
                </div>
            @else
                @can('User')
                <div class="d-flex align-items-center">
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="top-cart">
                        <button type="button" onclick="tombol_cart();"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-shopping-bag fs-22'></i>
                            <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info top-cart-number"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
                            aria-labelledby="page-header-cart-dropdown">
                            <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge badge-soft-warning fs-13"><span
                                                class="cartitem-badge top-cart-number"></span>
                                            items</span>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 300px;">
                                <div class="p-2 top-cart-items">

                                </div>
                            </div>
                            <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border"
                                id="checkout-elem">
                                <div class="d-flex justify-content-between align-items-center pb-3">
                                    <h5 class="m-0 text-muted">Total:</h5>
                                    <div class="px-2">
                                        <h5 class="m-0 top-checkout-price" id="cart-item-total"></h5>
                                    </div>
                                </div>

                                <a href="{{ route('web.cart.index') }}" class="btn btn-success text-center w-100">
                                    Lihat Keranjang
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <a type="button" href="javascript:;" onclick="tombol_notif();" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="bx bx-bell fs-22"></i>
                             <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger" id="top-notification-number"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0 " style="width: 25rem" aria-labelledby="page-header-notifications-dropdown">
                             <div class="dropdown-head bg-success bg-pattern rounded-top">
                                  <div class="p-3">
                                       <div class="row align-items-center">
                                            <div class="col">
                                                 <h6 class="m-0 fs-16 fw-semibold text-white">Notifications</h6>
                                            </div>
                                            <div class="col-auto dropdown-tabs">
                                                 <span class="badge badge-soft-light fs-13"><span id="jmlh-notif"></span> New!</span>
                                            </div>
                                       </div>
                                  </div>
                                  
                             </div>

                             <div class="tab-content" id="notificationItemsTabContent">
                                  <div class="tab-pane fade show active" id="all-noti-tab" role="tabpanel">
                                       <div data-simplebar style="max-height: 300px" class="">                                            
                                            <div class="text-reset text-wrap dropdown-item position-relative" style="margin-left: -10px"  id="notification_items">
                                                 
                                            </div>                                            
                                       </div>
                                  </div>                                
                             </div>
                        </div>
                   </div>
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="top-cart">
                        
                        <button type="button" class="btn btn-ghost-warning rounded-circle" id="page-header-user-dropdown" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <span class="text-start ms-xl-2">
                                    <i class="bx bx-user text-white fs-22 align-middle me-1"></i>
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-white text-capitalize">{{ Auth::User()->fullname }}</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Welcome {{ Auth::User()->fullname }}!</h6>
                            <a class="dropdown-item" href="{{ route('web.profile') }}"><i
                                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Profile</span></a>
                            <a class="dropdown-item" href="{{ route('web.order.index') }}"><i
                                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">History</span></a>
                            <a class="dropdown-item" href="{{ route('web.coupon.index') }}"><i
                                    class="mdi mdi-ticket-percent-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Coupon</span></a>
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('web.logout') }}"><i
                                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
                @elsecan('Admin')
                <div class="d-flex align-items-center">
                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <a type="button" href="javascript:;" onclick="tombol_notif();" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="bx bx-bell fs-22"></i>
                             <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger" id="top-notification-number"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0 " style="width: 25rem" aria-labelledby="page-header-notifications-dropdown">
                             <div class="dropdown-head bg-success bg-pattern rounded-top">
                                  <div class="p-3">
                                       <div class="row align-items-center">
                                            <div class="col">
                                                 <h6 class="m-0 fs-16 fw-semibold text-white">Notifications</h6>
                                            </div>
                                            <div class="col-auto dropdown-tabs">
                                                 <span class="badge badge-soft-light fs-13"><span id="jmlh-notif"></span> New!</span>
                                            </div>
                                       </div>
                                  </div>
                                  
                             </div>

                             <div class="tab-content" id="notificationItemsTabContent">
                                  <div class="tab-pane fade show active" id="all-noti-tab" role="tabpanel">
                                       <div data-simplebar style="max-height: 300px" class="">                                            
                                            <div class="text-reset text-wrap dropdown-item position-relative" style="margin-left: -10px"  id="notification_items">
                                                 
                                            </div>                                            
                                       </div>
                                  </div>                                
                             </div>
                        </div>
                   </div>
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="top-cart">
                            
                        <button type="button" class="btn btn-ghost-warning rounded-circle" id="page-header-user-dropdown" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <span class="text-start ms-xl-2">
                                    <i class="bx bx-user text-white fs-22 align-middle me-1"></i>
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-white text-capitalize">{{ Auth::User()->fullname }}</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Welcome {{ Auth::User()->fullname }}!</h6>                        
                            <a class="dropdown-item" href="{{route('admin.logout')}}">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </a>
                        </div>
                    </div>

                </div>
                 
                @endcan
            @endguest
            </div>
        </div>
</header>
<div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
    <div class="d-flex flex-stack flex-grow-1">
        <div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
            <div id="kt_app_sidebar_toggle"
                class="app-sidebar-toggle btn btn-sm btn-icon bg-body btn-color-gray-500 btn-active-color-primary w-30px h-30px ms-n2 me-4 d-none d-lg-flex"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-outline ki-abstract-14 fs-3 mt-1"></i>
            </div>

            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none"
                id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>

            <a href="{{ route('admin.dashboard.index') }}" class="app-sidebar-logo">
                <img alt="HadirKu" src="{{ asset('assets/media/logos/default.svg') }}"
                    class="h-25px theme-light-show" />
                <img alt="HadirKu" src="{{ asset('assets/media/logos/default-dark.svg') }}"
                    class="h-25px theme-dark-show" />
            </a>
        </div>

        <div class="app-navbar flex-grow-1 justify-content-end" id="kt_app_header_navbar">
            <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
                <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
                    <div id="kt_header_search" class="header-search d-flex align-items-center w-lg-350px">
                        <span class="badge py-3 px-4 fs-7 badge-light-primary">
                            <i class="ki-outline ki-profile-circle text-primary me-2 fs-3"></i>
                            {{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                </div>
            </div>

            <div class="app-navbar-item ms-2 ms-lg-6" id="kt_header_user_menu_toggle">
                <div class="cursor-pointer symbol symbol-circle symbol-30px symbol-lg-45px"
                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                    data-kt-menu-placement="bottom-end">
                    <img src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile) : asset('assets/media/avatars/blank.png') }}"
                        style="object-fit: cover;" />
                </div>

                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <div class="symbol symbol-50px me-5">
                                <img src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile) : asset('assets/media/avatars/blank.png') }}"
                                    style="object-fit: cover;" />
                            </div>

                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">
                                    {{ Auth::user()->name }}
                                </div>

                                <a
                                    class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->username }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="separator my-2"></div>

                    <!-- <div class="menu-item px-5">
                        <a href="#" class="menu-link px-5">
                            Profile
                        </a>
                    </div> -->

                    <div class="menu-item px-5">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                        <a href="#" class="menu-link px-5"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign Out
                        </a>
                    </div>

                </div>
            </div>

            <div class="app-navbar-item ms-2 ms-lg-6 me-lg-6">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit"
                        class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px">
                        <i class="ki-outline ki-exit-right fs-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="app-header-separator"></div>
</div>
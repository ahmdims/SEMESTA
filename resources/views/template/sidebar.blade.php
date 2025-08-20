<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <div class="app-sidebar-wrapper">
        <div id="kt_app_sidebar_wrapper" class="hover-scroll-y my-5 my-lg-2 mx-4" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
            data-kt-scroll-offset="5px">

            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
                class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">

                @if(Auth::user()->role == 'guard')
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('attendance.scan') ? 'active' : '' }}"
                            href="{{ route('attendance.scan') }}">
                            <span class="menu-icon"><i class="ki-outline ki-file fs-2"></i></span>
                            <span class="menu-title">Scan Attendance</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('attendance.history') ? 'active' : '' }}"
                            href="{{ route('attendance.history') }}">
                            <span class="menu-icon"><i class="ki-outline ki-file fs-2"></i></span>
                            <span class="menu-title">History</span>
                        </a>
                    </div>
                @endif

                @if(Auth::user()->role == 'admin')
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('admin.locations.*') ? 'active' : '' }}"
                            href="{{ route('admin.locations.index') }}">
                            <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                            <span class="menu-title">Locations</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('admin.shifts.*') ? 'active' : '' }}"
                            href="{{ route('admin.shifts.index') }}">
                            <span class="menu-icon"><i class="ki-outline ki-file fs-2"></i></span>
                            <span class="menu-title">Shifts</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('admin.locations.*') ? 'active' : '' }}"
                            href="{{ route('admin.locations.index') }}">
                            <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                            <span class="menu-title">Attendance Recap</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('admin.locations.*') ? 'active' : '' }}"
                            href="{{ route('admin.locations.index') }}">
                            <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                            <span class="menu-title">Guard</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <a class="menu-link {{ Request::routeIs('admin.locations.*') ? 'active' : '' }}"
                            href="{{ route('admin.locations.index') }}">
                            <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                            <span class="menu-title">Admin</span>
                        </a>
                    </div>
                @endif

            </div>

        </div>
    </div>

</div>
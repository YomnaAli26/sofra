<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand text-center">
        <!--begin::Brand Link-->
        <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center justify-content-center">
            <!--begin::Brand Text-->
            <span class="brand-text fw-light text-center">{{ config('app.name') }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>

    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <!-- Cities -->
                <li class="nav-item">
                    <a href="{{ route('admin.cities.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-buildings"></i>
                        <p>Cities</p>
                    </a>
                </li>

                <!-- Areas -->
                <li class="nav-item">
                    <a href="{{ route('admin.areas.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-globe"></i>
                        <p>Areas</p>
                    </a>
                </li>


                <!-- Categories -->
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-tags"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <!-- Admins -->
                <li class="nav-item">
                    <a href="{{ route('admin.offers.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-lock" title="Contact Us Settings"></i>
                        <p>Offers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.commissions.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-lock" title="Contact Us Settings"></i>
                        <p>Restaurants Payments</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.restaurants.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-lock" title="Contact Us Settings"></i>
                        <p>Restaurants</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payment-methods.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-lock" title="Contact Us Settings"></i>
                        <p>Payment Methods</p>
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.admins.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon bi bi-person-lock" title="Contact Us Settings"></i>--}}
{{--                        <p>Admins</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.change-password') }}" class="nav-link">--}}
{{--                        <i class="nav-icon bi bi-shield-lock" title="Change Password"></i>--}}
{{--                        <p>Change Password</p>--}}
{{--                    </a>--}}
{{--                </li>--}}


                <!-- Clients -->
                <li class="nav-item">
                    <a href="{{ route('admin.clients.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Clients</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <!-- Roles -->
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.roles.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon bi bi-person-badge"></i>--}}
{{--                        <p>Roles</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <!-- Permissions -->
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.permissions.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon bi bi-shield-lock"></i>--}}
{{--                        <p>Permissions</p>--}}
{{--                    </a>--}}
{{--                </li>--}}



                <!-- Contact Us -->
                <li class="nav-item">
                    <a href="{{ route('admin.contact-us.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-envelope-fill" title="Contact Us Settings"></i>
                        <p>Contact Us</p>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand text-center">
        <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center justify-content-center">
            <span class="brand-text fw-light text-center">{{ config('app.name') }}</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                @can('view_dashboard')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>{{ __('sidebar.dashboard') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Cities -->
                @can('manage_cities')
                    <li class="nav-item">
                        <a href="{{ route('admin.cities.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-geo-alt"></i>
                            <p>{{ __('sidebar.cities') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Areas -->
                @can('manage_areas')
                    <li class="nav-item">
                        <a href="{{ route('admin.areas.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-map"></i>
                            <p>{{ __('sidebar.areas') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Categories -->
                @can('manage_categories')
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-tags"></i>
                            <p>{{ __('sidebar.categories') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Offers -->
                @can('manage_offers')
                    <li class="nav-item">
                        <a href="{{ route('admin.offers.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-gift"></i>
                            <p>{{ __('sidebar.offers') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Restaurants Payments -->
                @can('manage_commissions')
                    <li class="nav-item">
                        <a href="{{ route('admin.commissions.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-cash-stack"></i>
                            <p>{{ __('sidebar.restaurants_payments') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Restaurants -->
                @can('manage_restaurants')
                    <li class="nav-item">
                        <a href="{{ route('admin.restaurants.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-shop"></i>
                            <p>{{ __('sidebar.restaurants') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Payment Methods -->
                @can('manage_payment_methods')
                    <li class="nav-item">
                        <a href="{{ route('admin.payment-methods.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-credit-card"></i>
                            <p>{{ __('sidebar.payment_methods') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Users -->
                @can('manage_users')
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-person"></i>
                            <p>{{ __('sidebar.users') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Change Password -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.change-password.form') }}" class="nav-link">
                        <i class="nav-icon bi bi-shield-lock"></i>
                        <p>{{ __('sidebar.change_password') }}</p>
                    </a>
                </li>

                <!-- Clients -->
                @can('manage_clients')
                    <li class="nav-item">
                        <a href="{{ route('admin.clients.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-people"></i>
                            <p>{{ __('sidebar.clients') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Orders -->
                @can('view_orders')
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-cart"></i>
                            <p>{{ __('sidebar.orders') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Roles -->
                @can('manage_roles')
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>{{ __('sidebar.roles') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Contact Us -->
                @can('view_contacts')
                    <li class="nav-item">
                        <a href="{{ route('admin.contact-us.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-envelope"></i>
                            <p>{{ __('sidebar.contact_us') }}</p>
                        </a>
                    </li>
                @endcan

                <!-- Settings -->
                @can('update_settings')
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.edit') }}" class="nav-link">
                            <i class="nav-icon bi bi-gear"></i>
                            <p>{{ __('sidebar.settings') }}</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

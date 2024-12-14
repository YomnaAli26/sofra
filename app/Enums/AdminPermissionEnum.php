<?php

namespace App\Enums;

enum AdminPermissionEnum: string
{
    case MANAGE_USERS = 'manage_users';
    case MANAGE_ROLES = 'manage_roles';
    case VIEW_DASHBOARD = 'view_dashboard';
    case MANAGE_CITIES = 'manage_cities';
    case MANAGE_AREAS = 'manage_areas';
    case MANAGE_CATEGORIES = 'manage_categories';
    case MANAGE_OFFERS = 'manage_offers';
    case MANAGE_COMMISSIONS = 'manage_commissions';
    case MANAGE_PAYMENT_METHODS = 'manage_payment_methods';
    case VIEW_ORDERS = 'view_orders';
    case VIEW_CONTACTS = 'view_contacts';
    case MANAGE_RESTAURANTS = 'manage_restaurants';
    case MANAGE_CLIENTS = 'manage_clients';
    case UPDATE_SETTINGS = 'update_settings';
    public function routes(): array
    {
        return match ($this) {
            self::MANAGE_USERS => ['admin.users.index', 'admin.users.create', 'admin.users.store', 'admin.users.edit', 'admin.users.update'],
            self::MANAGE_ROLES => ['admin.roles.index', 'admin.roles.create', 'admin.roles.store', 'admin.roles.edit', 'admin.roles.update'],
            self::MANAGE_CITIES => ['admin.cities.index', 'admin.cities.create', 'admin.cities.store', 'admin.cities.edit', 'admin.cities.update', 'admin.cities.destroy'],
            self::MANAGE_AREAS => ['admin.areas.index', 'admin.areas.create', 'admin.areas.store', 'admin.areas.edit', 'admin.areas.update', 'admin.areas.destroy'],
            self::MANAGE_CATEGORIES => ['admin.categories.index', 'admin.categories.create', 'admin.categories.store', 'admin.categories.edit', 'admin.categories.update', 'admin.categories.destroy'],
            self::MANAGE_OFFERS => ['admin.offers.index', 'admin.offers.create', 'admin.offers.store', 'admin.offers.edit', 'admin.offers.update', 'admin.offers.destroy'],
            self::MANAGE_COMMISSIONS => ['admin.commissions.index', 'admin.commissions.create', 'admin.commissions.store', 'admin.commissions.edit', 'admin.commissions.update'],
            self::MANAGE_PAYMENT_METHODS => ['admin.payment-methods.index', 'admin.payment-methods.create', 'admin.payment-methods.store', 'admin.payment-methods.edit', 'admin.payment-methods.update'],
            self::VIEW_ORDERS => ['admin.orders.index', 'admin.orders.show', 'admin.orders.print'],
            self::VIEW_CONTACTS => ['admin.contacts.index', 'admin.contacts.show'],
            self::MANAGE_RESTAURANTS => ['admin.restaurants.index', 'admin.restaurants.create', 'admin.restaurants.store', 'admin.restaurants.edit', 'admin.restaurants.update', 'admin.restaurants.delete'],
            self::MANAGE_CLIENTS => ['admin.clients.index', 'admin.clients.create', 'admin.clients.store', 'admin.clients.edit', 'admin.clients.update'],
            self::UPDATE_SETTINGS => ['admin.settings.index', 'admin.settings.update'],
            self::VIEW_DASHBOARD => ['admin.dashboard'],
        };
    }
}

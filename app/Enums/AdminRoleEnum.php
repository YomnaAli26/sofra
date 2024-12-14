<?php

namespace App\Enums;

enum AdminRoleEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case SUPPORT = 'support';

    public function permissions(): array
    {
        return match ($this) {
          self::SUPER_ADMIN => [
              AdminPermissionEnum::MANAGE_USERS->value,
              AdminPermissionEnum::MANAGE_ROLES->value,
              AdminPermissionEnum::VIEW_DASHBOARD->value,
              AdminPermissionEnum::MANAGE_CITIES->value,
              AdminPermissionEnum::MANAGE_AREAS->value,
              AdminPermissionEnum::MANAGE_CATEGORIES->value,
              AdminPermissionEnum::MANAGE_OFFERS->value,
              AdminPermissionEnum::MANAGE_COMMISSIONS->value,
              AdminPermissionEnum::MANAGE_PAYMENT_METHODS->value,
              AdminPermissionEnum::VIEW_ORDERS->value,
              AdminPermissionEnum::VIEW_CONTACTS->value,
              AdminPermissionEnum::MANAGE_RESTAURANTS->value,
              AdminPermissionEnum::MANAGE_CLIENTS->value,
              AdminPermissionEnum::UPDATE_SETTINGS->value,
          ],
            self::ADMIN => [
                AdminPermissionEnum::VIEW_DASHBOARD->value,
                AdminPermissionEnum::MANAGE_CITIES->value,
                AdminPermissionEnum::MANAGE_AREAS->value,
                AdminPermissionEnum::MANAGE_CATEGORIES->value,
                AdminPermissionEnum::MANAGE_OFFERS->value,
                AdminPermissionEnum::MANAGE_COMMISSIONS->value,
                AdminPermissionEnum::MANAGE_PAYMENT_METHODS->value,
                AdminPermissionEnum::VIEW_ORDERS->value,
                AdminPermissionEnum::VIEW_CONTACTS->value,
                AdminPermissionEnum::MANAGE_RESTAURANTS->value,
                AdminPermissionEnum::MANAGE_CLIENTS->value,
            ],
            self::MANAGER => [
                AdminPermissionEnum::VIEW_DASHBOARD->value,
                AdminPermissionEnum::VIEW_ORDERS->value,
                AdminPermissionEnum::VIEW_CONTACTS->value,
                AdminPermissionEnum::MANAGE_CATEGORIES->value,
                AdminPermissionEnum::MANAGE_OFFERS->value,
                AdminPermissionEnum::MANAGE_RESTAURANTS->value,
            ],
            self::SUPPORT => [
                AdminPermissionEnum::VIEW_DASHBOARD->value,
                AdminPermissionEnum::VIEW_CONTACTS->value,
            ],
        };
    }
}

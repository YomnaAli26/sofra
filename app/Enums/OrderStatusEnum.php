<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED_FROM_CLIENT = 'rejected_from_client';
    case REJECTED_FROM_RESTAURANT = 'rejected_from_restaurant';
    case DELIVERED = 'delivered';

    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}


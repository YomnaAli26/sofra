<?php

namespace App\Enums;

enum OrderStatusEnum: string
{

    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case DELIVERED = 'delivered';

    case CANCELED = 'canceled';
}


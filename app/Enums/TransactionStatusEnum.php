<?php

namespace App\Enums;

enum TransactionStatusEnum: string
{

    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';
}


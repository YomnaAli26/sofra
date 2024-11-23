<?php

namespace App\Enums;

enum ContactStatusEnum: string
{
    case COMPLAINT  = 'complaint';
    case SUGGESTION  = 'suggestion';
    case INQUIRY  = 'inquiry';
}


<?php

namespace App\Enums;

enum ContactStatus: string
{
    case COMPLAINT  = 'complaint';
    case SUGGESTION  = 'suggestion';
    case INQUIRY  = 'inquiry';
}


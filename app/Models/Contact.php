<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Filterable;

    protected $fillable = [
        'name', 'email', 'phone',
        'message', 'status'
    ];

}

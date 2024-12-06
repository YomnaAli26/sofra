<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Services\ContactService;
use App\Services\OfferService;


class ContactController extends DashboardController
{
    public function __construct(ContactService $contactService)
    {
        parent::__construct($contactService);
        $this->indexView = 'contact-us.index';
        $this->partialFolder = 'contact-us';
        $this->usePagination = true;
        $this->successMessage = 'Process success';
    }

}

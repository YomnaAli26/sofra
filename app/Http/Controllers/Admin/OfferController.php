<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Services\OfferService;


class OfferController extends DashboardController
{
    public function __construct(OfferService $offerService)
    {
        parent::__construct($offerService);
        $this->indexView = 'offers.index';
        $this->relations = ['restaurant'];
        $this->partialFolder = 'offers';
        $this->usePagination = true;
        $this->successMessage = 'Process success';
    }

}

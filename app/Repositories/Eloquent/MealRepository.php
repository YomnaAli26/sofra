<?php

namespace App\Repositories\Eloquent;


use App\Models\Contact;
use App\Models\Meal;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\Interfaces\MealRepositoryInterface;

class MealRepository extends BaseRepository implements MealRepositoryInterface
{
    public function __construct(Meal $meal)
    {
        parent::__construct($meal);
    }

}

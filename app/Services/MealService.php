<?php

namespace App\Services;


use App\Repositories\Interfaces\MealRepositoryInterface;
use Illuminate\Support\Arr;


class MealService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public MealRepositoryInterface $mealRepository)
    {
        parent::__construct($mealRepository);
    }

    public function getRestaurantMeals()
    {
        return $this->mealRepository->withRelations(['restaurant'])
            ->getBy(['restaurant_id'=>auth('restaurant')->user()->id]);
    }


}

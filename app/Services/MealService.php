<?php

namespace App\Services;


use App\Repositories\Interfaces\MealRepositoryInterface;
use Illuminate\Support\Arr;


class MealService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public MealRepositoryInterface $mealRepository)
    {
    }

    public function getRestaurantMeals()
    {
        return $this->mealRepository->withRelations(['restaurant'])->getBy(['restaurant_id'=>auth('restaurant')->user()->id]);
    }

    public function createMeal($data)
    {
        $meal = $this->mealRepository->create(Arr::except($data,'image'));
        $meal->addMedia($data['image'])->toMediaCollection('meals');
        return $meal ;
    }

    public function showMeal($id)
    {
        return $this->mealRepository->find($id) ;
    }

    public function updateMeal($id,$data)
    {
        $meal = $this->mealRepository->update(Arr::except($data,'image'),$id);
        if (isset($data['image'])) {
            $meal->clearMediaCollection('meals');
            $meal->addMedia($data['image'])->toMediaCollection('meals');
        }
        return $meal ;
    }
    public function deleteMeal($id): void
    {
        $meal = $this->mealRepository->find($id);
        if ($meal) {
            $meal->clearMediaCollection('meals');
            $meal->delete();
        }
    }

}

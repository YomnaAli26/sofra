<?php

namespace App\Services;

use App\Mail\ForgotPassword;

use App\Repositories\Interfaces\RestaurantRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class RestaurantService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public RestaurantRepositoryInterface $restaurantRepository)
    {

    }
    public function register($data)
    {
        $registeredRestaurant = $this->restaurantRepository->create(Arr::except($data,['image']));
        if (isset($data['image']))
        {
            $registeredRestaurant->addMedia($data['image'])->toMediaCollection('restaurant');
        }
       return $registeredRestaurant;
    }

    /**
     * @throws ValidationException
     */
    public function login($data)
    {
        $client = $this->restaurantRepository->findBy(["email" => $data["email"]]);
       if (!Hash::check($data['password'],$client->password)) {
           throw ValidationException::withMessages([
              'email' =>  __('auth.failed'),
           ]);
       }
        return $client;
    }

    public function forgotPassword($email)
    {
        $restaurant = $this->restaurantRepository->findBy(["email" => $email]);
        $restaurant->generateCode();
        Mail::to($restaurant->email)-> send(new ForgotPassword($restaurant));
        return $restaurant;
    }
    public function resetPassword($data)
    {
        $restaurant = $this->restaurantRepository->findBy(["email" => $data['email']]);
        if ($data["code"] != $restaurant->code)
        {
            throw ValidationException::withMessages([
                'code' =>  __('auth.failed'),
            ]);

        }
        $restaurant->resetCode();
        $restaurant->update(["password" => $data['password']]);
        return $restaurant;
    }

    public function updateProfileData($data,$id)
    {
        return $this->restaurantRepository->update($data,$id);

    }
    public function showProfileData($id)
    {
        return $this->restaurantRepository->find($id);

    }

    public function showRestaurant($id)
    {
       return $this->restaurantRepository->find($id);
    }
    public function getRestaurants($perPage = 10)
    {

       return $this->restaurantRepository->withRelations(['area.city','category'])->filter()->paginate($perPage);
    }
    public function getRestaurantMeals($id)
    {
        $restaurant =$this->restaurantRepository->withRelations(['meals.restaurant'])
            ->find($id);
       return $restaurant->meals;
    }


}

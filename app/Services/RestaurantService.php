<?php

namespace App\Services;

use App\Mail\ForgotPassword;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;
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
        $client = $this->restaurantRepository->findBy("email", $data["email"]);
       if (!Hash::check($data['password'],$client->password)) {
           throw ValidationException::withMessages([
              'email' =>  __('auth.failed'),
           ]);
       }
        return $client;
    }

    public function forgotPassword($email)
    {
        $client = $this->restaurantRepository->findBy("email", $email);
        $client->generateCode();
        Mail::to($client->email)-> send(new ForgotPassword($client));
        return $client;
    }
    public function resetPassword($data)
    {
        $client = $this->restaurantRepository->findBy("email", $data['email']);
        if ($data["code"] != $client->code)
        {
            throw ValidationException::withMessages([
                'code' =>  __('auth.failed'),
            ]);

        }
        $client->resetCode();
        $client->update(["password" => $data['password']]);
        return $client;
    }
}

<?php

namespace App\Services;

use App\Mail\ForgotPassword;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ClientService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public ClientRepositoryInterface $clientRepository)
    {
        parent::__construct($clientRepository);
    }

    public function register($data)
    {
        return $this->clientRepository->create($data);
    }

    /**
     * @throws ValidationException
     */
    public function login($data)
    {
        $client = $this->clientRepository->findBy(["email" => $data["email"]]);
        if (!Hash::check($data['password'], $client->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
        return $client;
    }

    public function forgotPassword($email)
    {
        $client = $this->clientRepository->findBy(["email" => $email]);
        $client->generateCode();
        Mail::to($client->email)->send(new ForgotPassword($client));
        return $client;
    }

    public function resetPassword($data)
    {
        $client = $this->clientRepository->findBy(["email" => $data['email']]);
        if ($data["code"] != $client->code) {
            throw ValidationException::withMessages([
                'code' => __('auth.failed'),
            ]);

        }
        $client->resetCode();
        $client->update(["password" => $data['password']]);
        return $client;
    }

    public function updateProfileData($data, $id)
    {
        return $this->clientRepository->update($data, $id);

    }

    public function showProfileData($id)
    {
        return $this->clientRepository->find($id);

    }
}

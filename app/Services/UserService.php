<?php

namespace App\Services;

use App\Mail\ForgotPassword;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public UserRepositoryInterface $userRepository)
    {
        parent::__construct($userRepository);
    }

    /**
     * @throws \Exception
     */
    public function changePassword($data): true
    {
        $user = $this->userRepository->find(auth()->user()->id);
        if (!Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Current password is incorrect.',
            ]);
        }
        $boolUpdated = $this->userRepository->update(['password'=>$data['password']],auth()->user()->id);
        if (!$boolUpdated) {
            throw new \Exception('Failed to update password.');
        }
        return true;
    }

}

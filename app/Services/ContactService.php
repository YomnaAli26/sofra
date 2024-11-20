<?php

namespace App\Services;


use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public ContactRepositoryInterface $contactRepository)
    {

    }
    public function create(array $data)
    {
        return $this->contactRepository->create($data);
    }
}

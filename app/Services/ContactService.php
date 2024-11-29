<?php

namespace App\Services;


use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public ContactRepositoryInterface $contactRepository)
    {
        parent::__construct($contactRepository);

    }
    public function create(array $data)
    {
        return $this->contactRepository->create($data);
    }
}

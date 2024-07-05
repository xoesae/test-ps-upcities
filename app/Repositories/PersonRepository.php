<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\PersonDTO;
use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;

class PersonRepository implements PersonRepositoryInterface
{
    public function __construct(private readonly Person $person) {}

    public function create(PersonDTO $dto): Person
    {
        /** @var Person $person */
        $person = $this->person->newQuery()->create([
            'name' => $dto->name,
            'document_number' => $dto->documentNumber,
            'birth' => $dto->birth,
            'email' => $dto->email,
            'phone_number' => $dto->phoneNumber,
            'address_id' => $dto->addressId,
        ]);

        return $person;
    }
}

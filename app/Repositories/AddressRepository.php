<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\AddressDTO;
use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    public function __construct(private readonly Address $address) {}

    public function create(AddressDTO $dto): Address
    {
        /** @var Address $address */
        $address = $this->address->newQuery()->create([
            'street' => $dto->street,
            'city' => $dto->city,
            'state' => $dto->state->value,
        ]);

        return $address;
    }
}

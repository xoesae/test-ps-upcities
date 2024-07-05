<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\AddressDTO;
use App\Models\Address;

interface AddressRepositoryInterface
{
    public function create(AddressDTO $dto): Address;
}
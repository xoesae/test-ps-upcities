<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\AddressDTO;
use App\Models\Address;

interface AddressRepositoryInterface
{
    public function create(AddressDTO $dto): Address;
    public function update(int $id, AddressDTO $dto): int;
    public function delete(int $id): bool;
}
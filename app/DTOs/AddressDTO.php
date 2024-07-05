<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\State;

readonly class AddressDTO
{
    public function __construct(
        public string $street,
        public string $city,
        public State $state,
    ) {}
}
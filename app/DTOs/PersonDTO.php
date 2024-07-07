<?php

declare(strict_types=1);

namespace App\DTOs;

use DateTime;

readonly class PersonDTO
{
    public function __construct(
        public string $name,
        public string $documentNumber,
        public DateTime $birth,
        public string $email,
        public string $phoneNumber,
        public ?int $addressId = null,
    ) {}
}

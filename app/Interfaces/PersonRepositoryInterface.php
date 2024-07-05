<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\PersonDTO;
use App\Models\Person;

interface PersonRepositoryInterface
{
    public function create(PersonDTO $dto): Person;
}
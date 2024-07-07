<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\PersonDTO;
use App\Models\Person;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PersonRepositoryInterface
{
    public function create(PersonDTO $dto): Person;

    public function update(int $id, PersonDTO $dto): int;
    public function delete(int $id): bool;

    /**
     * @return LengthAwarePaginator<Person>
     */
    public function listAllPaginated(int $perPage = 10, ?int $page = null): LengthAwarePaginator;

    public function findById(int $id): Person;
}

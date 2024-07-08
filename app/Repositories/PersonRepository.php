<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\PersonDTO;
use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class PersonRepository implements PersonRepositoryInterface
{
    public function __construct(private Person $person)
    {
    }

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

    public function update(int $id, PersonDTO $dto): int
    {
        return $this->person->newQuery()
            ->where('id', $id)
            ->update([
                'name' => $dto->name,
                'document_number' => $dto->documentNumber,
                'birth' => $dto->birth,
                'email' => $dto->email,
                'phone_number' => $dto->phoneNumber,
            ]);
    }

    public function listAllPaginated(int $perPage = 10, ?int $page = null): LengthAwarePaginator
    {
        return $this->person->newQuery()
            ->select(['*'])
            ->with('address')
            ->orderBy('id', 'DESC')
            ->paginate(perPage: $perPage, page: $page);
    }

    public function findById(int $id): Person
    {
        return $this->person->newQuery()
            ->select(['*'])
            ->with('address')
            ->where('id', $id)
            ->firstOrFail();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->person->newQuery()
            ->where('id', $id)
            ->delete();
    }
}

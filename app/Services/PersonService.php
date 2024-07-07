<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\AddressDTO;
use App\DTOs\PersonDTO;
use App\Enums\State;
use App\Exceptions\PersonNotFoundException;
use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PersonService
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository,
        private readonly AddressRepositoryInterface $addressRepository
    )
    {}

    public function listAllPaginated(int $perPage, ?int $page): LengthAwarePaginator
    {
        return $this->personRepository->listAllPaginated($perPage, $page);
    }

    public function findById(int $id): Person
    {
        try {
            return $this->personRepository->findById($id);
        } catch(\Exception) {
            throw new PersonNotFoundException();
        }
    }

    public function create(array $data): Person
    {
        return DB::transaction(function () use ($data) {
            $address = $this->addressRepository->create(new AddressDTO(
                street: $data['address']['street'],
                city: $data['address']['city'],
                state: State::tryFrom($data['address']['state']),
            ));

            return $this->personRepository->create(new PersonDTO(
                name: $data['name'],
                documentNumber: $data['document_number'],
                birth: Carbon::parse($data['birth']),
                email: $data['email'],
                phoneNumber: $data['phone_number'],
                addressId: $address->id,
            ));
        });
    }

    public function update(int $id, array $data): bool
    {
        return DB::transaction(function () use ($id, $data) {
            $person = $this->findById($id);

            $this->personRepository->update($id, new PersonDTO(
                name: $data['name'],
                documentNumber: $data['document_number'],
                birth: Carbon::parse($data['birth']),
                email: $data['email'],
                phoneNumber: $data['phone_number']
            ));

            $this->addressRepository->update($person->address_id, new AddressDTO(
                street: $data['address']['street'],
                city: $data['address']['city'],
                state: State::tryFrom($data['address']['state']),
            ));

            return true;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $person = $this->findById($id);
            $this->personRepository->delete($id);
            $this->addressRepository->delete($person->address_id);

            return true;
        });
    }
}

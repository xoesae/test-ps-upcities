<?php

namespace Tests\Unit\Services;

use App\Exceptions\PersonNotFoundException;
use App\Models\Address;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class PersonServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_person_with_address(): void
    {
        /** @var PersonService $personService */
        $personService = App::make(PersonService::class);
        $factory = Person::factory()->make();

        $person = $personService->create([
            'name' => $factory->name,
            'document_number' => $factory->document_number,
            'birth' => $factory->birth,
            'email' => $factory->email,
            'phone_number' => $factory->phone_number,
            'address' => [
                'street' => $factory->address->street,
                'city' => $factory->address->city,
                'state' => $factory->address->state->value,
            ],
        ]);

        $this->assertDatabaseCount('people', 1);
        $this->assertDatabaseCount('addresses', 2);
        $this->assertDatabaseHas('people', [
            'name' => $factory->name,
            'document_number' => $factory->document_number,
            'birth' => $factory->birth,
            'email' => $factory->email,
            'phone_number' => $factory->phone_number,
        ]);
        $this->assertDatabaseHas('addresses', [
            'street' => $factory->address->street,
            'city' => $factory->address->city,
            'state' => $factory->address->state->value,
        ]);
        $this->assertInstanceOf(Person::class, $person);
    }

    public function test_update_a_person_with_address(): void
    {
        /** @var PersonService $personService */
        $personService = App::make(PersonService::class);
        $factory = Person::factory()->make();
        $person = Person::factory()->create();

        $personService->update($person->id, [
            'name' => $factory->name,
            'document_number' => $factory->document_number,
            'birth' => $factory->birth,
            'email' => $factory->email,
            'phone_number' => $factory->phone_number,
            'address' => [
                'street' => $factory->address->street,
                'city' => $factory->address->city,
                'state' => $factory->address->state->value,
            ],
        ]);

        $this->assertDatabaseCount('people', 1);
        $this->assertDatabaseCount('addresses', 2);
        $this->assertDatabaseHas('people', [
            'id' => $person->id,
            'name' => $factory->name,
            'document_number' => $factory->document_number,
            'birth' => $factory->birth,
            'email' => $factory->email,
            'phone_number' => $factory->phone_number,
            'address_id' => $person->address_id,
        ]);
        $this->assertDatabaseHas('addresses', [
            'id' => $person->address_id,
            'street' => $factory->address->street,
            'city' => $factory->address->city,
            'state' => $factory->address->state->value,
        ]);
    }

    public function test_delete_a_person_with_address(): void
    {
        /** @var PersonService $personService */
        $personService = App::make(PersonService::class);
        $person = Person::factory()->create();

        $deleted = $personService->delete($person->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseCount('people', 0);
        $this->assertDatabaseCount('addresses', 0);
    }

    /**
     * @throws PersonNotFoundException
     */
    public function test_find_person_by_id(): void
    {
        /** @var PersonService $personService */
        $personService = App::make(PersonService::class);
        $person = Person::factory()->create();

        $person = $personService->findById($person->id);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertTrue($person->relationLoaded('address'));
        $this->assertInstanceOf(Address::class, $person->address);
    }

    public function test_find_person_with_wrong_id(): void
    {
        /** @var PersonService $personService */
        $personService = App::make(PersonService::class);

        try {
            $personService->findById(1);
        } catch (PersonNotFoundException $exception) {
            $this->assertInstanceOf(PersonNotFoundException::class, $exception);
        }
    }

    public function test_list_all_people(): void
    {
        /** @var PersonService $personService */
        $personService = App::make(PersonService::class);
        Person::factory()->count(10)->create();
        $perPage = 5;

        $people = $personService->listAllPaginated($perPage, 2);

        $this->assertInstanceOf(LengthAwarePaginator::class, $people);
        $this->assertCount($perPage, $people->items());
    }
}

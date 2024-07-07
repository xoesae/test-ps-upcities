<?php

namespace Tests\Unit\Repositories;

use App\DTOs\PersonDTO;
use App\Interfaces\PersonRepositoryInterface;
use App\Models\Address;
use App\Models\Person;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class PersonRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_person(): void
    {
        /** @var PersonRepositoryInterface $repository */
        $repository = App::make(PersonRepositoryInterface::class);
        $factory = Person::factory()->make();
        $dto = new PersonDTO(
            $factory->name,
            $factory->document_number,
            $factory->birth,
            $factory->email,
            $factory->phone_number,
            $factory->address_id,
        );

        $person = $repository->create($dto);

        $this->assertDatabaseCount('people', 1);
        $this->assertDatabaseHas('people', [
            'name' => $person->name,
            'document_number' => $person->document_number,
            'birth' => $person->birth,
            'email' => $person->email,
            'phone_number' => $person->phone_number,
            'address_id' => $person->address_id,
        ]);
    }

    public function test_update_a_person(): void
    {
        /** @var PersonRepositoryInterface $repository */
        $repository = App::make(PersonRepositoryInterface::class);
        $factory = Person::factory()->make();
        $person = Person::factory()->create();
        $dto = new PersonDTO(
            $factory->name,
            $factory->document_number,
            $factory->birth,
            $factory->email,
            $factory->phone_number,
        );

        $count = $repository->update($person->id, $dto);

        $this->assertEquals(1, $count);
        $this->assertDatabaseCount('people', 1);
        $this->assertDatabaseHas('people', [
            'name' => $factory->name,
            'document_number' => $factory->document_number,
            'birth' => $factory->birth,
            'email' => $factory->email,
            'phone_number' => $factory->phone_number,
        ]);
    }

    public function test_delete_a_person(): void
    {
        /** @var PersonRepositoryInterface $repository */
        $repository = App::make(PersonRepositoryInterface::class);
        $person = Person::factory()->create();
    
        $deleted = $repository->delete($person->id);

        $this->assertEquals(true, $deleted);
        $this->assertDatabaseCount('people', 0);
    }

    public function test_show_a_person(): void
    {
        /** @var PersonRepositoryInterface $repository */
        $repository = App::make(PersonRepositoryInterface::class);
        $person = Person::factory()->create();
    
        $person = $repository->findById($person->id);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals(true, $person->relationLoaded('address'));
        $this->assertInstanceOf(Address::class, $person->address);
    }
    public function test_list_all_people_paginated(): void
    {
        /** @var PersonRepositoryInterface $repository */
        $repository = App::make(PersonRepositoryInterface::class);
        Person::factory()->count(10)->create();
        $perPage = 5;
    
        $people = $repository->listAllPaginated($perPage);

        $this->assertInstanceOf(LengthAwarePaginator::class, $people);
        $this->assertCount($perPage, $people->items());
    }
}

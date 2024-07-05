<?php

namespace Repositories;

use App\DTOs\PersonDTO;
use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;
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
}

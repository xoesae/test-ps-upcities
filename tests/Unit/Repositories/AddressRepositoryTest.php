<?php

namespace Repositories;

use App\DTOs\AddressDTO;
use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;
use App\Repositories\AddressRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AddressRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_address(): void
    {
        /** @var AddressRepositoryInterface $repository */
        $repository = App::make(AddressRepository::class);
        $factory = Address::factory()->make();
        $dto = new AddressDTO($factory->street, $factory->city, $factory->state);

        $address = $repository->create($dto);

        $this->assertDatabaseCount('addresses', 1);
        $this->assertDatabaseHas('addresses', [
            'street' => $address->street,
            'city' => $address->city,
            'state' => $address->state->value,
        ]);
    }
}

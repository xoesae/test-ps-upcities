<?php

namespace Tests\Unit\Repositories;

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

    public function test_update_a_address(): void
    {
        /** @var AddressRepositoryInterface $repository */
        $repository = App::make(AddressRepository::class);
        $factory = Address::factory()->make();
        $address = Address::factory()->create();
        $dto = new AddressDTO($factory->street, $factory->city, $factory->state);

        $count = $repository->update($address->id, $dto);

        $this->assertEquals(1, $count);
        $this->assertDatabaseCount('addresses', 1);
        $this->assertDatabaseHas('addresses', [
            'street' => $factory->street,
            'city' => $factory->city,
            'state' => $factory->state->value,
        ]);
    }

    public function test_delete_a_address(): void
    {
        /** @var AddressRepositoryInterface $repository */
        $repository = App::make(AddressRepository::class);
        $address = Address::factory()->create();

        $deleted = $repository->delete($address->id);

        $this->assertEquals(true, $deleted);
        $this->assertDatabaseCount('addresses', 0);
    }
}

<?php

namespace App\Models;

use App\Enums\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $street
 * @property string $city
 * @property state $state
 * @property int $id
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'city',
        'state',
    ];

    protected $casts = [
        'state' => State::class,
    ];

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}

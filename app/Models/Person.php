<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property string $document_number
 * @property DateTime $birth
 * @property string $email
 * @property string $phone_number
 * @property int $address_id
 */
class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = [
        'name',
        'document_number',
        'birth',
        'email',
        'phone_number',
        'address_id'
    ];

    protected $casts = [
        'birth' => 'datetime',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}

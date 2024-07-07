<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class PersonNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Não foi possível encontrar esta pessoa.", Response::HTTP_NOT_FOUND);
    }
}
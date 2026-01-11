<?php

declare(strict_types=1);

namespace App\User\Domain\Exceptions;

use App\Shared\Domain\Exception\AbstractDomainException;
use DomainException;

class IncorrectTokenException extends AbstractDomainException
{
    public function __construct(string $message = 'Incorrect confirmed token')
    {
        parent::__construct($message);
    }


    public function getDomainErrorCode(): string
    {
        return ErrorCode::USER_INCORRECT_TOKEN->value;
    }
}

<?php

declare(strict_types=1);

namespace App\User\Domain\Exceptions;

enum ErrorCode: string
{
    case USER_ALREADY_EXISTS = 'USER_ALREADY_EXISTS';
    case USER_INCORRECT_TOKEN = 'USER_INCORRECT_TOKEN';
}

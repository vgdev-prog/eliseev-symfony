<?php

declare(strict_types=1);

namespace App\User\Domain\Enum;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case WAIT = 'wait';
    case INACTIVE = 'inactive';
    case NEW = 'new';
}

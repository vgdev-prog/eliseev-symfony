<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Services;

use App\Shared\Domain\Contracts\TokenGeneratorInterface;
use Random\RandomException;

class TokenGenerator implements TokenGeneratorInterface
{
    /**
     * @throws RandomException
     */
    public function generate(): string
    {
        return bin2hex(random_bytes(32));
    }
}

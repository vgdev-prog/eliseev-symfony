<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

class ResetToken
{
    public function __construct(
        private string $token,
        private \DateTimeImmutable $expiresAt,
    )
    {
        if (!$this->token) {
            throw new \DomainException('Token cannot be empty.');
        }
    }

    public function isExpiredTo(\DateTimeImmutable $date): bool
    {
        return $this->expiresAt <= $date;
    }

    public function getToken():string
    {
        return $this->token;
    }
}

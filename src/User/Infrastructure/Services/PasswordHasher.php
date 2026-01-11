<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Services;

use App\User\Domain\Contract\PasswordHasherInterface;
use App\User\Domain\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class PasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    )
    {
    }

    public function hash(string $password): string
    {
        return $this->passwordHasherFactory->getPasswordHasher(User::class)->hash($password);
    }
}

<?php

declare(strict_types=1);

namespace App\User\Domain\Contract;

use App\User\Domain\Entity\User\User;
use App\User\Domain\ValueObject\Email;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function findByConfirmToken(string $token): ?User;

    public function hasByNetworkIdentity(string $network, string $identity): bool;

    public function getByEmail(Email $email):?User;

}

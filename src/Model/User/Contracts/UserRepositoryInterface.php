<?php

declare(strict_types=1);

namespace App\Model\User\Contracts;

use App\Model\User\Entity\User\User;
use App\Model\User\ValueObject\Email;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function findByConfirmToken(string $token): ?User;

    public function hasByNetworkIdentity(string $network, string $identity): bool;

    public function getByEmail(Email $email):?User;

}

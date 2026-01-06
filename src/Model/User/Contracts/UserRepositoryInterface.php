<?php

declare(strict_types=1);

namespace App\Model\User\Contracts;

use App\Model\User\Entity\User\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function save():void;
}

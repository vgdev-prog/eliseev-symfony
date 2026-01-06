<?php

declare(strict_types=1);

namespace App\Model\User\Contracts;

use App\Model\User\ValueObject\Email;

interface SignUpConfirmEmailSenderInterface
{
    public function send(Email $email, string $token): void;
}

<?php

declare(strict_types=1);

namespace App\User\Domain\Contract;

interface ResetTokenSenderInterface
{
public function send();
}

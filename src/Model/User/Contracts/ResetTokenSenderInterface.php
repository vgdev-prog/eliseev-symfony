<?php

declare(strict_types=1);

namespace App\Model\User\Contracts;

interface ResetTokenSenderInterface
{
public function send();
}

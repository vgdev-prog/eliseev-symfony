<?php

declare(strict_types=1);

namespace App\Model\User\Contracts;

interface TokenGeneratorInterface
{
    public function generate():string;
}

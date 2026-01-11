<?php

declare(strict_types=1);

namespace App\Shared\Domain\Contract;

interface FlusherInterface
{
    public function flush():void;
}

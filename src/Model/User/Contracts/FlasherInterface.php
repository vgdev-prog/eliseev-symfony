<?php

declare(strict_types=1);

namespace App\Model\User\Contracts;

interface FlasherInterface
{
    public function flush():void;
}

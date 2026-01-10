<?php

declare(strict_types=1);

namespace App\Model\User\Services;

use App\Model\User\Contracts\FlasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class Flusher implements FlasherInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}

<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Services;

use App\User\Domain\ValueObject\ResetToken;
use DateInterval;
use Ramsey\Uuid\Uuid;

class ResetTokenizer
{
    public function __construct(
        private DateInterval $interval,
    )
    {
    }

    public function generate(): ResetToken
    {
        return new ResetToken(
            Uuid::uuid4()->toString(),
            (new \DateTimeImmutable())->add($this->interval),
        );
    }

}

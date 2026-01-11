<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistance\Type;

use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Id;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class IdType extends StringType
{
    public const NAME = 'id';

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Id
    {
        if (!$value) return null;

        return Id::fromString($value);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) return null;

        if ($value instanceof Email) {
            return $value->getValue();
        }
        return $value;
    }

    public function getName():string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}

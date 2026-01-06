<?php

declare(strict_types=1);

namespace App\Model\User\ValueObject;

use PharIo\Manifest\InvalidEmailException;

class Email
{
    private $email;
    private function __construct(
         string $email,
    )
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException('Invalid email');
        }
        $this->email = mb_strtolower($email);
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function getValue(): string
    {
        return $this->email;
    }
    public function __toString(): string
    {
     return (string) $this->email;
    }
}

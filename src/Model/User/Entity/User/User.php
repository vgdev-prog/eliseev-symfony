<?php

namespace App\Model\User\Entity\User;


use App\Model\User\Enum\UserStatus;
use App\Model\User\ValueObject\Email;
use App\Model\User\ValueObject\Id;
use DateTimeInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface

{
    private Id $id;
    private Email $email;
    private string $password;
    private ?string $confirmToken;
    private DateTimeInterface $date;
    private UserStatus $status = UserStatus::WAIT;

    private function __construct(
        Id $id,
        \DateTimeImmutable $date,
    )
    {
        $this->id = $id;
        $this->date = $date;
    }

    public static function signUpByEmail(Id $id, \DateTimeImmutable $date, Email $email, string $hash, string $token): self
    {
        $user = new self($id,$date);

        $user->email = $email;
        $user->password = $hash;
        $user->confirmToken = $token;
        $user->status = UserStatus::WAIT;
        return $user;
    }

    public static function signUpByNetwork(
        Id                 $id,
        \DateTimeImmutable $date,
        string             $network,
        string             $identity,
    ): self
    {
        $user = new self();

        $user->network = $network;
        $user->identity = $identity;

        return $user;
    }


    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->getEmail();
    }

    public function getRoles(): array
    {
        return $this->getRoles();
    }

    public function isActive(): bool
    {
        return $this->status === UserStatus::ACTIVE;
    }

    public function isWait(): bool
    {
        return $this->status === UserStatus::WAIT;
    }

    public function confirmSignUp(): void
    {
        if ($this->isActive()) {
            throw new \DomainException("User already confirmed.");
        }
        $this->status = UserStatus::ACTIVE;
        $this->setConfirmToken(null);
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getConfirmToken(): ?string
    {
        return $this->confirmToken;
    }

    public function setConfirmToken(?string $token): void
    {
        $this->confirmToken = $token;
    }


}

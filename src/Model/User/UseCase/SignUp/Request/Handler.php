<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;

use App\Model\User\Contracts\PasswordHasherInterface;
use App\Model\User\Contracts\SignUpConfirmEmailSenderInterface;
use App\Model\User\Contracts\TokenGeneratorInterface;
use App\Model\User\Contracts\UserRepositoryInterface;
use App\Model\User\Entity\User\User;
use App\Model\User\Enum\UserStatus;
use App\Model\User\ValueObject\Email;
use App\Model\User\ValueObject\Id;
use DateTimeImmutable;
use DomainException;

readonly class Handler
{
    public function __construct(
        private UserRepositoryInterface           $userRepository,
        private PasswordHasherInterface           $hasher,
        private TokenGeneratorInterface           $tokenGenerator,
        private SignUpConfirmEmailSenderInterface $sender
    )
    {
    }

    public function handle(Command $command): void
    {
        $mail = Email::fromString($command->email);

        if ($this->userRepository->findOneBy(['email' => $mail])) {
            throw new DomainException('Email already exists');
        }

        $user = new User(
            Id::next(),
            Email::fromString($command->email),
            $this->hasher->hash($command->password),
            new DateTimeImmutable(),
            UserStatus::WAIT
        );
        $token = $this->tokenGenerator->generate();
        $this->userRepository->add($user);
        $this->userRepository->save();
        $this->sender->send($user->getEmail(), $token);

    }

}
